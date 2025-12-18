<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $total_population = \App\Models\Population::sum('total_population');
        $male_population = \App\Models\Population::sum('male_population');
        $female_population = \App\Models\Population::sum('female_population');
        $total_kk = \App\Models\Population::sum('household_count');
        
        // Calculate Area (in Square Meters then convert to Hectares)
        // MySQL ST_Area returns meters for SRID 4326 (MySQL 8.0+) or degrees (MySQL 5.7)
        // We remove ::geography which is Postgres syntax
        $area_sqm = \App\Models\AdministrativeBoundary::where('type', 'Desa')
            ->selectRaw('SUM(ST_Area(geom)) as area')
            ->value('area');
            
        $area_ha = $area_sqm ? $area_sqm / 10000 : 0; // Convert m² to Hectares

        // Additional Stats
        $total_pois = \App\Models\Poi::count();
        $total_infrastructures = \App\Models\Infrastructure::count();
        $total_land_uses = \App\Models\LandUse::count();

        // News & Gallery
        $news_updates = \App\Models\News::latest('published_at')->take(3)->get();
        $galleries = \App\Models\Gallery::latest()->take(6)->get();

        return view('landing', compact(
            'total_population', 'male_population', 'female_population', 'total_kk', 'area_ha',
            'total_pois', 'total_infrastructures', 'total_land_uses',
            'news_updates', 'galleries'
        ));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'message' => 'required',
        ]);

        $contactData = $request->all();

        // Format Date for WhatsApp
        $wa_phone = '6285741458614'; // Ganti dengan nomor WhatsApp Admin (gunakan kode negara 62)
        $wa_text = "Halo Admin Desa Tegalsambi, saya ingin mengirim pesan:\n\n" .
                   "Nama: " . $contactData['name'] . "\n" .
                   "Pesan:\n" . $contactData['message'];

        $url = "https://wa.me/" . $wa_phone . "?text=" . urlencode($wa_text);

        return redirect()->away($url);
    }
}
