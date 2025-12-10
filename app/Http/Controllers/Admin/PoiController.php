<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PoiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pois = \App\Models\Poi::select('id', 'name', 'category', 'updated_at')->paginate(10);
        return view('admin.pois.index', compact('pois'));
    }

    public function create()
    {
        return view('admin.pois.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $poi = new \App\Models\Poi();
        $poi->name = $request->name;
        $poi->category = $request->category;
        // Save as Point Geometry
        $poi->geom = \DB::raw("ST_GeomFromText('POINT({$request->longitude} {$request->latitude})')");
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('pois', 'public');
            $poi->image = $path;
        }

        $poi->save();

        return redirect()->route('admin.pois.index')->with('success', 'POI berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Select X and Y from geometry to pre-fill form
        $poi = \App\Models\Poi::select('*', \DB::raw('ST_X(geom) as lng, ST_Y(geom) as lat'))->findOrFail($id);

        // Auto-fix swapped coordinates (Legacy Data Issue)
        // If Lat > 90, it's definitely Longitude (swapped)
        if (abs($poi->lat) > 90) {
            $temp = $poi->lat;
            $poi->lat = $poi->lng;
            $poi->lng = $temp;
        }

        return view('admin.pois.edit', compact('poi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $poi = \App\Models\Poi::findOrFail($id);
        $poi->name = $request->name;
        $poi->category = $request->category;
        $poi->geom = \DB::raw("ST_GeomFromText('POINT({$request->longitude} {$request->latitude})')");
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($poi->image && \Storage::disk('public')->exists($poi->image)) {
                \Storage::disk('public')->delete($poi->image);
            }
            $path = $request->file('image')->store('pois', 'public');
            $poi->image = $path;
        }

        $poi->save();

        return redirect()->route('admin.pois.index')->with('success', 'POI berhasil diperbarui');
    }

    public function destroy($id)
    {
        $poi = \App\Models\Poi::findOrFail($id);
        $poi->delete();
        return redirect()->route('admin.pois.index')->with('success', 'POI berhasil dihapus');
    }
}
