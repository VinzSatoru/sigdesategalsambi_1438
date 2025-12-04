<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infrastructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfrastructureController extends Controller
{
    public function index()
    {
        $infrastructures = Infrastructure::paginate(10);
        return view('admin.infrastructures.index', compact('infrastructures'));
    }

    public function create()
    {
        $villageBoundary = \App\Models\AdministrativeBoundary::select(DB::raw('ST_AsGeoJSON(geom) as geometry'))
                            ->where('type', 'Desa')
                            ->first();
        return view('admin.infrastructures.create', compact('villageBoundary'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'geometry' => 'required', // GeoJSON string
        ]);

        // Convert GeoJSON to WKT (LineString)
        $geojson = json_decode($request->geometry);
        $coordinates = $geojson->coordinates;
        
        $wktPoints = [];
        foreach ($coordinates as $coord) {
            $wktPoints[] = $coord[0] . ' ' . $coord[1]; // Lng Lat
        }
        $wkt = 'LINESTRING(' . implode(',', $wktPoints) . ')';

        Infrastructure::create([
            'name' => $request->name,
            'category' => $request->category,
            'condition' => $request->condition,
            'geom' => DB::raw("ST_GeomFromText('$wkt')"),
            'attributes' => json_encode([
                'width' => $request->width,
                'material' => $request->material
            ])
        ]);

        return redirect()->route('admin.infrastructures.index')->with('success', 'Infrastruktur berhasil ditambahkan');
    }

    public function edit($id)
    {
        $infrastructure = Infrastructure::select('*', DB::raw('ST_AsGeoJSON(geom) as geometry'))->findOrFail($id);
        $villageBoundary = \App\Models\AdministrativeBoundary::select(DB::raw('ST_AsGeoJSON(geom) as geometry'))
                            ->where('type', 'Desa')
                            ->first();
        return view('admin.infrastructures.edit', compact('infrastructure', 'villageBoundary'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        $infrastructure = Infrastructure::findOrFail($id);

        $updateData = [
            'name' => $request->name,
            'category' => $request->category,
            'condition' => $request->condition,
            'attributes' => json_encode([
                'width' => $request->width,
                'material' => $request->material
            ])
        ];

        if ($request->geometry) {
            $geojson = json_decode($request->geometry);
            $coordinates = $geojson->coordinates;
            $wktPoints = [];
            foreach ($coordinates as $coord) {
                $wktPoints[] = $coord[0] . ' ' . $coord[1];
            }
            $wkt = 'LINESTRING(' . implode(',', $wktPoints) . ')';
            $updateData['geom'] = DB::raw("ST_GeomFromText('$wkt')");
        }

        $infrastructure->update($updateData);

        return redirect()->route('admin.infrastructures.index')->with('success', 'Infrastruktur berhasil diperbarui');
    }

    public function destroy($id)
    {
        $infrastructure = Infrastructure::findOrFail($id);
        $infrastructure->delete();
        return redirect()->route('admin.infrastructures.index')->with('success', 'Infrastruktur berhasil dihapus');
    }
}
