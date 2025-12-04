<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeBoundary;
use Illuminate\Http\Request;

class AdministrativeBoundaryController extends Controller
{
    public function index()
    {
        $boundaries = AdministrativeBoundary::latest()->paginate(10);
        return view('admin.boundaries.index', compact('boundaries'));
    }

    public function create()
    {
        return view('admin.boundaries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'geojson_file' => 'required|file|mimes:json,geojson',
        ]);

        $file = $request->file('geojson_file');
        $json = json_decode(file_get_contents($file), true);

        // Assuming the uploaded file contains a FeatureCollection or a single Feature
        // This is a simplified handler. For robust handling, we might need to iterate features.
        // Here we take the first feature if it's a collection.
        
        $geometry = null;
        if (isset($json['type']) && $json['type'] === 'FeatureCollection' && !empty($json['features'])) {
            $geometry = json_encode($json['features'][0]['geometry']);
        } elseif (isset($json['type']) && $json['type'] === 'Feature') {
            $geometry = json_encode($json['geometry']);
        }

        if (!$geometry) {
            return back()->with('error', 'Invalid GeoJSON file.');
        }

        $boundary = new AdministrativeBoundary();
        $boundary->name = $request->name;
        $boundary->type = $request->type;
        $boundary->geom = \DB::raw("ST_GeomFromGeoJSON('$geometry')");
        $boundary->save();

        return redirect()->route('admin.administrative-boundaries.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $boundary = AdministrativeBoundary::findOrFail($id);
        return view('admin.boundaries.edit', compact('boundary'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'geojson_file' => 'nullable|file|mimes:json,geojson',
        ]);

        $boundary = AdministrativeBoundary::findOrFail($id);
        $boundary->name = $request->name;
        $boundary->type = $request->type;

        if ($request->hasFile('geojson_file')) {
            $file = $request->file('geojson_file');
            $json = json_decode(file_get_contents($file), true);
            
            $geometry = null;
            if (isset($json['type']) && $json['type'] === 'FeatureCollection' && !empty($json['features'])) {
                $geometry = json_encode($json['features'][0]['geometry']);
            } elseif (isset($json['type']) && $json['type'] === 'Feature') {
                $geometry = json_encode($json['geometry']);
            }

            if ($geometry) {
                $boundary->geom = \DB::raw("ST_GeomFromGeoJSON('$geometry')");
            }
        }

        $boundary->save();

        return redirect()->route('admin.administrative-boundaries.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $boundary = AdministrativeBoundary::findOrFail($id);
        $boundary->delete();
        return redirect()->route('admin.administrative-boundaries.index')->with('success', 'Data berhasil dihapus');
    }
}
