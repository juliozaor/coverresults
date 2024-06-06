<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function map()
    {
        return view('admin.map');
    }

    public function registerDevices()
    {
        return view('admin.register_devices');
    }

    public function deviceAssignment()
    {
        return view('admin.device_assignment');
    }
}
