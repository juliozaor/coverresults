<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\AlertLog;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\LocationLog;
use App\Models\Polygon;

class AdminController extends Controller
{
   
    public function map()
    {
        // Obtener todos los polígonos
        $polygons = Polygon::all()->map(function ($polygon) {
            $polygon->coordinates = json_decode($polygon->coordinates, true);
            return $polygon;
        });
    
        // Obtener todos los dispositivos junto con el sospechoso relacionado
        $devices = Device::with('suspect')->get()->map(function ($device) {
            if ($device->suspect && $device->suspect->photo) {
                // Si el sospechoso tiene una foto, usa la URL completa
                $device->photo_url = asset('public/' . $device->suspect->photo);
            } else {
                // Si no, usa la imagen por defecto
                $device->photo_url = asset('assets/dist/img/upload.svg');
            }
            return $device;
        });
    
        // Obtener el recuento de alertas
        $pulselessCount = Alert::sum('pulseless_count');
        $outOfLocationCount = Alert::sum('out_of_location_count');
        $batteryEmptyCount = Alert::sum('battery_empty_count');
    
        // Pasar los datos a la vista
        return view('admin.map', compact('polygons', 'devices', 'pulselessCount', 'outOfLocationCount', 'batteryEmptyCount'));
    }

    public function registerDevices()
    {
        return view('admin.register_devices');
    }

    public function deviceAssignment()
    {
        return view('admin.device_assignment');
    }


public function searchSuspects(Request $request)
{
    $query = $request->input('query');

    $suspects = Device::with('suspect')
        ->whereHas('suspect', function($q) use ($query) {
            $q->where('name', 'LIKE', "%$query%")
              ->orWhere('lastname', 'LIKE', "%$query%")
              ->orWhere('identification', 'LIKE', "%$query%");
        })
        ->get()
        ->map(function ($device) {
            if ($device->suspect && $device->suspect->photo) {
                $device->photo_url = asset('public/' . $device->suspect->photo);
            } else {
                $device->photo_url = asset('assets/dist/img/upload.svg');
            }
            return $device;
        });

    return response()->json($suspects);
}

public function deviceDetails($id)
{

    $device = Device::with('suspect')->findOrFail($id);

    // Obtener las ubicaciones de los últimos 7 días
    $locationLogs = LocationLog::where('device_id', $id)
        ->where('date', '>=', now()->subDays(7))
        ->get();

    // Consolidar las coordenadas
    $consolidatedLocations = [];
    foreach ($locationLogs as $log) {
        $consolidatedLocations = array_merge(
            $consolidatedLocations,
            $this->consolidateCoordinates($log->locations)
        );
    }

    // Ordenar los lugares consolidados por tiempo
    usort($consolidatedLocations, function($a, $b) {
        return strtotime($a['time']) - strtotime($b['time']);
    });

    // Obtener las alertas de los últimos 7 días
    $alerts = AlertLog::where('device_id', $id)
        ->where('created_at', '>=', now()->subDays(7))
        ->get();

    // Pasar los datos a la vista
    return view('admin.device_details', compact('device', 'consolidatedLocations', 'alerts'));


}

private function consolidateCoordinates($locations, $tolerance = 0.0001)
{
    $consolidated = [];

    foreach ($locations as $location) {
        $found = false;
        foreach ($consolidated as &$consolidatedLocation) {
            if (abs($consolidatedLocation['latitude'] - $location['latitude']) < $tolerance &&
                abs($consolidatedLocation['longitude'] - $location['longitude']) < $tolerance) {
                
                // Si la ubicación es similar, actualiza el tiempo si es posterior
                if (strtotime($location['time']) > strtotime($consolidatedLocation['time'])) {
                    $consolidatedLocation['time'] = $location['time'];
                }

                $found = true;
                break;
            }
        }

        if (!$found) {
            // Si no se encontró un punto similar, añade uno nuevo
            $consolidated[] = $location;
        }
    }

    return $consolidated;
}



}
