<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $populations = \App\Models\Population::all();
        return view('map.index', compact('populations'));
    }

    public function getAdministrativeBoundaries()
    {
        $boundaries = \App\Models\AdministrativeBoundary::select('id', 'name', 'type', 'attributes', \DB::raw('ST_AsGeoJSON(geom) as geometry'))->get();

        $features = $boundaries->map(function($boundary) {
            return [
                'type' => 'Feature',
                'geometry' => json_decode($boundary->geometry),
                'properties' => [
                    'id' => $boundary->id,
                    'name' => $boundary->name,
                    'type' => $boundary->type,
                    'attributes' => $boundary->attributes,
                ]
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features
        ]);
    }

    public function getPois()
    {
        $pois = \App\Models\Poi::select('id', 'name', 'category', 'image', 'attributes', \DB::raw('ST_AsGeoJSON(geom) as geometry'))->get();

        $features = $pois->map(function($poi) {
            return [
                'type' => 'Feature',
                'geometry' => json_decode($poi->geometry),
                'properties' => [
                    'id' => $poi->id,
                    'name' => $poi->name,
                    'category' => $poi->category,
                    'image' => $poi->image,
                    'attributes' => $poi->attributes,
                ]
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features
        ]);
    }

    public function getInfrastructures()
    {
        $infrastructures = \App\Models\Infrastructure::select('id', 'name', 'category', 'condition', 'attributes', \DB::raw('ST_AsGeoJSON(geom) as geometry'))->get();

        $features = $infrastructures->map(function($infra) {
            return [
                'type' => 'Feature',
                'geometry' => json_decode($infra->geometry),
                'properties' => [
                    'id' => $infra->id,
                    'name' => $infra->name,
                    'category' => $infra->category,
                    'condition' => $infra->condition,
                    'attributes' => $infra->attributes,
                ]
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features
        ]);
    }

    public function getLandUses()
    {
        $landUses = \App\Models\LandUse::select('id', 'name', 'category', 'area_sqm', 'attributes', \DB::raw('ST_AsGeoJSON(geom) as geometry'))->get();

        $features = $landUses->map(function($land) {
            return [
                'type' => 'Feature',
                'geometry' => json_decode($land->geometry),
                'properties' => [
                    'id' => $land->id,
                    'name' => $land->name,
                    'category' => $land->category,
                    'area_sqm' => $land->area_sqm,
                    'attributes' => $land->attributes,
                ]
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features
        ]);
    }
}
