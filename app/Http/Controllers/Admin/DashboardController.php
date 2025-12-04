<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'pois' => \App\Models\Poi::count(),
            'infrastructures' => \App\Models\Infrastructure::count(),
            'land_uses' => \App\Models\LandUse::count(),
            'boundaries' => \App\Models\AdministrativeBoundary::count(),
            'population_total' => \App\Models\Population::sum('total_population'),
            'population_male' => \App\Models\Population::sum('male_population'),
            'population_female' => \App\Models\Population::sum('female_population'),
            'population_kk' => \App\Models\Population::sum('household_count'),
        ];

        $recent_pois = \App\Models\Poi::latest()->take(5)->get();

        // Calculate Area (in Square Meters then convert to Hectares)
        $area_sqm = \App\Models\AdministrativeBoundary::where('type', 'Desa')
            ->selectRaw('SUM(ST_Area(geom)) as area')
            ->value('area');
            
        $area_ha = $area_sqm ? $area_sqm / 10000 : 0;

        return view('admin.dashboard', compact('counts', 'recent_pois', 'area_ha'));
    }
}
