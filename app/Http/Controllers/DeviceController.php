<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

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
        return view('admin.register_devices', compact('devices', 'totalDevices', 'search'));
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
            'serial' => 'required|string|max:255|unique:devices,serial,'.$device->id,
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
}
