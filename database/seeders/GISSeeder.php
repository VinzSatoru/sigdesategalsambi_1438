<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GISSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // POI: Balai Desa
        \DB::table('pois')->insert([
            'name' => 'Kantor Balai Desa Tegalsambi',
            'category' => 'Pemerintahan',
            'geom' => \DB::raw("ST_GeomFromText('POINT(110.675 -6.619)')"),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // POI: Masjid
        \DB::table('pois')->insert([
            'name' => 'Masjid Jami Tegalsambi',
            'category' => 'Tempat Ibadah',
            'geom' => \DB::raw("ST_GeomFromText('POINT(110.676 -6.620)')"),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Infrastructure: Jalan Utama
        \DB::table('infrastructures')->insert([
            'name' => 'Jalan Raya Tegalsambi',
            'category' => 'Jalan',
            'condition' => 'Baik',
            'geom' => \DB::raw("ST_GeomFromText('LINESTRING(110.670 -6.618, 110.675 -6.619, 110.680 -6.620)')"),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Land Use: Sawah
        \DB::table('land_uses')->insert([
            'name' => 'Sawah Blok A',
            'category' => 'Sawah',
            'area_sqm' => 5000,
            'geom' => \DB::raw("ST_GeomFromText('POLYGON((110.672 -6.621, 110.674 -6.621, 110.674 -6.623, 110.672 -6.623, 110.672 -6.621))')"),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Boundary: RT 01
        \DB::table('administrative_boundaries')->insert([
            'name' => 'RT 01 / RW 01',
            'type' => 'RT',
            'geom' => \DB::raw("ST_GeomFromText('POLYGON((110.670 -6.618, 110.675 -6.618, 110.675 -6.620, 110.670 -6.620, 110.670 -6.618))')"),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
