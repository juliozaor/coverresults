<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationLog;

class LocationLogController extends Controller
{
    public function index(Request $request)
    {
        $query = LocationLog::with('suspect', 'device');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('suspect', function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('lastname', 'like', "%$search%");
            })->orWhereHas('device', function($q) use ($search) {
                $q->where('serial', 'like', "%$search%");
            });
        }

        $logs = $query->paginate(10);
        return view('location_logs.index', compact('logs'));
    }

    public function show($id)
    {
        $log = LocationLog::with('suspect', 'device')->findOrFail($id);
        return response()->json($log);
    }
}
