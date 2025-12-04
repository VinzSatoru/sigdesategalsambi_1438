<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ImportGeoJSONSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Import Batas Desa
        $path = public_path('data/batasdesategalsambi.geojson');
        if (file_exists($path)) {
            $json = file_get_contents($path);
            $data = json_decode($json, true);

            foreach ($data['features'] as $feature) {
                $geometry = json_encode($feature['geometry']);
                $props = $feature['properties'];
                
                // Determine name from properties (adjust key 'Name' or 'NAMOBJ' based on QGIS export)
                $name = $props['Name'] ?? $props['NAMOBJ'] ?? 'Batas Desa';

                \DB::table('administrative_boundaries')->insert([
                    'name' => $name,
                    'type' => 'Desa',
                    'geom' => \DB::raw("ST_GeomFromGeoJSON('$geometry')"),
                    'attributes' => json_encode($props),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $this->command->info('Batas Desa imported.');
        }

        // 2. Import Sekolah
        $path = public_path('data/sekolah.geojson');
        if (file_exists($path)) {
            $json = file_get_contents($path);
            $data = json_decode($json, true);

            foreach ($data['features'] as $feature) {
                $geometry = json_encode($feature['geometry']);
                $props = $feature['properties'];
                $name = $props['Name'] ?? $props['NAMOBJ'] ?? 'Sekolah';

                \DB::table('pois')->insert([
                    'name' => $name,
                    'category' => 'Pendidikan',
                    'geom' => \DB::raw("ST_GeomFromGeoJSON('$geometry')"),
                    'attributes' => json_encode($props),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $this->command->info('Sekolah imported.');
        }

        // 3. Import Masjid
        $path = public_path('data/masjid.geojson');
        if (file_exists($path)) {
            $json = file_get_contents($path);
            $data = json_decode($json, true);

            foreach ($data['features'] as $feature) {
                $geometry = json_encode($feature['geometry']);
                $props = $feature['properties'];
                $name = $props['Name'] ?? $props['NAMOBJ'] ?? 'Masjid';

                \DB::table('pois')->insert([
                    'name' => $name,
                    'category' => 'Tempat Ibadah',
                    'geom' => \DB::raw("ST_GeomFromGeoJSON('$geometry')"),
                    'attributes' => json_encode($props),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $this->command->info('Masjid imported.');
        }
    }
}
