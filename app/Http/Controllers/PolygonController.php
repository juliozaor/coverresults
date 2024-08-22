<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Polygon;

class PolygonController extends Controller
{

    public function index(Request $request)
    {
       /*  $polygons = Polygon::all();
        return view('admin.polygons', compact('polygons')); */

        $search = $request->input('search', '');

        $query = Polygon::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('coordinates', 'LIKE', "%{$search}%");
        }

        $polygons = $query->paginate(10);
        $totalPolygons = $query->count();
        return view('admin.polygons', compact('polygons', 'totalPolygons', 'search'));


    }

    public function create()
    {
        return view('polygons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'coordinates' => 'required|json',
        ]);

       /*  $polygon = new Polygon();
        $polygon->name = $request->name;
        $polygon->coordinates = $request->coordinates;
        $polygon->save();

        return redirect()->route('polygons.index')->with('success', 'Polygon created successfully'); */

        $polygon = Polygon::create([
            'name' => $request->name,
            'coordinates' => $request->coordinates,
        ]);
        //return redirect()->route('polygons.index')->with('success', 'Polygon created successfully');
        return response()->json(['success' => true, 'polygon_id' => $polygon->id]);
        
    }

    public function show($id)
    {
        $polygon = Polygon::findOrFail($id);
        return view('polygons.show', compact('polygon'));
    }

    public function edit($id)
    {
        $polygon = Polygon::findOrFail($id);
        return view('polygons.edit', compact('polygon'));
    }

    public function update(Request $request, $id)
    {
       /*  $request->validate([
            'name' => 'required|string|max:255',
            'coordinates' => 'required|json',
        ]);

        $polygon = Polygon::findOrFail($id);
        $polygon->name = $request->name;
        $polygon->coordinates = $request->coordinates;
        $polygon->save();

        return redirect()->route('polygons.index')->with('success', 'Polygon updated successfully'); */
       
        $request->validate([
            'name' => 'required|string|max:255',
            'coordinates' => 'required|json',
        ]);

        $polygon = Polygon::findOrFail($id);
        $polygon->name = $request->name;
        $polygon->coordinates = $request->coordinates;
        $polygon->save();

        return response()->json(['success' => true, 'polygon_id' => $polygon->id]);
        
    }

    public function destroy($id)
    {
        $polygon = Polygon::findOrFail($id);
        $polygon->delete();

        return redirect()->route('polygons.index')->with('success', 'Polygon deleted successfully');
    }

   /*  public function storeMap(Request $request)
    {
        $request->validate([
            'coordinates' => 'required|array',
            'coordinates.*.lat' => 'required|numeric',
            'coordinates.*.lng' => 'required|numeric',
        ]);

        $polygon = Polygon::create([
            'coordinates' => json_encode($request->coordinates) // Guardar como JSON
        ]);

        return response()->json(['success' => true, 'polygon_id' => $polygon->id]);
    }

    public function destroyMap($id)
    { 
            $polygon = Polygon::findOrFail($id);
        $polygon->delete();

        return response()->json(['success' => true]);
    } */
    
}
