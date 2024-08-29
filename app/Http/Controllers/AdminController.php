<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;
use App\Models\Device;
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


}
