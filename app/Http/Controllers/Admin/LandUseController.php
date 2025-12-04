<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandUse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandUseController extends Controller
{
    public function index()
    {
        $landUses = LandUse::paginate(10);
        return view('admin.land_uses.index', compact('landUses'));
    }

    public function create()
    {
        $villageBoundary = \App\Models\AdministrativeBoundary::select(DB::raw('ST_AsGeoJSON(geom) as geometry'))
                            ->where('type', 'Desa')
                            ->first();
        return view('admin.land_uses.create', compact('villageBoundary'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'geometry' => 'required', // GeoJSON string
        ]);

        // Convert GeoJSON to WKT (Polygon)
        $geojson = json_decode($request->geometry);
        $coordinates = $geojson->coordinates[0]; // Polygon has array of rings, we take the first one (outer ring)
        
        $wktPoints = [];
        foreach ($coordinates as $coord) {
            $wktPoints[] = $coord[0] . ' ' . $coord[1]; // Lng Lat
        }
        $wkt = 'POLYGON((' . implode(',', $wktPoints) . '))';

        LandUse::create([
            'name' => $request->name,
            'category' => $request->category,
            'area_sqm' => $request->area_sqm,
            'geom' => DB::raw("ST_GeomFromText('$wkt')"),
            'attributes' => json_encode([
                'description' => $request->description
            ])
        ]);

        return redirect()->route('admin.land-uses.index')->with('success', 'Penggunaan Lahan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $landUse = LandUse::select('*', DB::raw('ST_AsGeoJSON(geom) as geometry'))->findOrFail($id);
        $villageBoundary = \App\Models\AdministrativeBoundary::select(DB::raw('ST_AsGeoJSON(geom) as geometry'))
                            ->where('type', 'Desa')
                            ->first();
        return view('admin.land_uses.edit', compact('landUse', 'villageBoundary'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        $landUse = LandUse::findOrFail($id);

        $updateData = [
            'name' => $request->name,
            'category' => $request->category,
            'area_sqm' => $request->area_sqm,
            'attributes' => json_encode([
                'description' => $request->description
            ])
        ];

        if ($request->geometry) {
            $geojson = json_decode($request->geometry);
            $coordinates = $geojson->coordinates[0];
            $wktPoints = [];
            foreach ($coordinates as $coord) {
                $wktPoints[] = $coord[0] . ' ' . $coord[1];
            }
            $wkt = 'POLYGON((' . implode(',', $wktPoints) . '))';
            $updateData['geom'] = DB::raw("ST_GeomFromText('$wkt')");
        }

        $landUse->update($updateData);

        return redirect()->route('admin.land-uses.index')->with('success', 'Penggunaan Lahan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $landUse = LandUse::findOrFail($id);
        $landUse->delete();
        return redirect()->route('admin.land-uses.index')->with('success', 'Penggunaan Lahan berhasil dihapus');
    }
}
