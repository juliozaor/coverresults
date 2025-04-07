<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationLog;

class LocationLogController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $query = LocationLog::with('suspect', 'device');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('suspect', function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('lastname', 'like', "%$search%");
            })->orWhereHas('device', function($q) use ($search) {
                $q->where('serial', 'like', "%$search%");
            });
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $query->whereBetween('date', [$startDate, $endDate]);
        }

        // Paginación
        $logs = $query->paginate(10);

        return view('location_logs.index', compact('logs'));
    }

    public function show($id)
    {
        // Cargar relaciones y devolver JSON
        $log = LocationLog::with('suspect', 'device')->findOrFail($id);
        return response()->json($log);
    }
}
