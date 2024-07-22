<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function counts()
    {
        $pulseless = Alert::sum('pulseless_count');
        $outOfLocation = Alert::sum('out_of_location_count');
        $batteryEmpty = Alert::sum('battery_empty_count');

        return response()->json([
            'pulseless' => $pulseless,
            'out_of_location' => $outOfLocation,
            'battery_empty' => $batteryEmpty
        ]);
    }
}
