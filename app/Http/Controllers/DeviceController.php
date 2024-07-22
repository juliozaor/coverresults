<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\LocationLog;
use App\Models\Polygon;
use App\Models\Suspect;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $query = Device::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('serial', 'LIKE', "%{$search}%");
        }

        $devices = $query->paginate(10); // Cambia '10' al número de elementos por página que desees.
        $totalDevices = $query->count();
        $polygons = Polygon::all(); // Obtener todos los polígonos para la vista
        return view('admin.register_devices', compact('devices', 'totalDevices', 'search', 'polygons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial' => 'required|string|max:255|unique:devices,serial',
        ]);

        Device::create([
            'name' => $request->name,
            'serial' => $request->serial,
        ]);

        return redirect()->route('devices.index')->with('success', 'Device created successfully.');
    }

    public function update(Request $request, Device $device)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'serial' => 'required|string|max:255|unique:devices,serial,' . $device->id,
            'polygon_id' => 'nullable|exists:polygons,id',
            // Otros campos de validación si es necesario
        ]);

        $device->update($validatedData);

        return redirect()->back()->with('success', 'Device updated successfully.');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')->with('success', 'Device deleted successfully.');
    }

 
   public function updateLocation($serial, Request $request)
    {

        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'battery_level' => 'required|numeric'
        ]);

       
        $device = Device::where('serial', $serial)->firstOrFail();
        $device->latitude = $request->latitude;
        $device->longitude = $request->longitude;
        $device->battery_level = $request->battery_level;
        $device->save();



        $suspect = $device->suspect;
        if ($suspect) {
            $currentDate = now()->format('Y-m-d');
            $latitude = $request->latitude;
            $longitude = $request->longitude;
    
            $locationLog = LocationLog::firstOrCreate(
                ['device_id' => $device->id, 'date' => $currentDate],
                ['suspect_id' => $suspect->id, 'locations' => []]
            );
    
            $locations = $locationLog->locations;
            $locations[] = ['latitude' => $latitude, 'longitude' => $longitude];
            $locationLog->locations = $locations;
            $locationLog->save();
        }
    

        

        $polygon = $device->polygon;
        $alert = Alert::firstOrCreate(['device_id' => $device->id]);

        // Estado anterior de las alertas
        $wasOutOfLocation = $alert->currently_out_of_location;
        $wasBatteryEmpty = $alert->currently_battery_empty;

        // Verificar si el dispositivo está fuera del polígono
        if ($polygon && !$this->isInsidePolygon($device, $polygon)) {
            if (!$wasOutOfLocation) {
                // Incrementa solo si estaba dentro y ahora está fuera
                $alert->out_of_location_count++;
                $alert->currently_out_of_location = true;
            }
        } else {
            if ($wasOutOfLocation) {
                // Decrementa solo si estaba fuera y ahora está dentro
                $alert->out_of_location_count--;
                $alert->currently_out_of_location = false;
            }
        }

        // Verificar el nivel de batería
        if ($device->battery_level < 20) {
            if (!$wasBatteryEmpty) {
                // Incrementa solo si la batería estaba bien y ahora está baja
                $alert->battery_empty_count++;
                $alert->currently_battery_empty = true;
            }
        } else {
            if ($wasBatteryEmpty) {
                // Decrementa solo si la batería estaba baja y ahora está bien
                $alert->battery_empty_count--;
                $alert->currently_battery_empty = false;
            }
        }

        $alert->save();

        return response()->json(['message' => 'Location updated successfully'], 200);

    }

    private function isInsidePolygon($device, $polygon)
    {
        $point = [$device->latitude, $device->longitude];
        $vertices = array_map(function ($coordinate) {
            return [$coordinate['lat'], $coordinate['lng']];
        }, json_decode($polygon->coordinates, true));

        return $this->pointInPolygon($point, $vertices);
    }

    private function pointInPolygon($point, $vertices)
    {
        $x = $point[0];
        $y = $point[1];
        $inside = false;

        for ($i = 0, $j = count($vertices) - 1; $i < count($vertices); $j = $i++) {
            $xi = $vertices[$i][0];
            $yi = $vertices[$i][1];
            $xj = $vertices[$j][0];
            $yj = $vertices[$j][1];

            $intersect = (($yi > $y) != ($yj > $y)) &&
                ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);
            if ($intersect) $inside = !$inside;
        }

        return $inside;
    }

    public function getLocations()
    {
        
        $devices = Device::with('suspect:id,device_id,name,lastname,identification,date_dirth,address,photo')
        ->get(['id', 'name', 'latitude', 'longitude']);

// Preparar la respuesta incluyendo la URL de la foto
$devices = $devices->map(function($device) {
if ($device->suspect && $device->suspect->photo) {
$device->photo_url = asset('storage/' . $device->suspect->photo);
} else {
$device->photo_url = asset('assets/dist/img/upload.svg');
}
return $device;
});

// Devolver la respuesta como JSON
return response()->json($devices);
    }


    public function registerDevice(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'device_serial' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $suspect = auth('suspect')->user(); // Obtener el sospechoso autenticado

        // Buscar o crear el dispositivo
        $device = Device::firstOrCreate(
            ['serial' => $request->device_serial],
            ['name' => $request->device_serial, 'fcm_token' => $request->token]
        );

        // Asignar el dispositivo al sospechoso si no está ya asignado
        if ($suspect->device_id !== $device->id) {
            $suspect->device_id = $device->id;
            $suspect->save();
        }

        // Actualizar el token FCM del dispositivo
        $device->fcm_token = $request->token;
        $device->save();

        return response()->json(['message' => 'Device registered successfully']);

    }

}
