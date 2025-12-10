<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('galleries')->insert([
            [
                'title' => 'Pemandangan Sawah',
                'image' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                'description' => 'Hamparan sawah hijau di pagi hari.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Balai Desa',
                'image' => 'https://images.unsplash.com/photo-1572085313466-6710de0d80ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                'description' => 'Kantor Balai Desa Tegalsambi yang megah.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kegiatan Posyandu',
                'image' => 'https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                'description' => 'Rutin pemeriksaan kesehatan balita dan lansia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'title' => 'Festival Budaya',
                'image' => 'https://images.unsplash.com/photo-1516214104703-d870798883c5?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                'description' => 'Meriahnya festival budaya tahunan desa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
