<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('news')->insert([
            [
                'title' => 'Gotong Royong Membersihkan Saluran Irigasi',
                'slug' => 'gotong-royong-membersihkan-saluran-irigasi',
                'content' => 'Warga Desa Tegalsambi bersama-sama melaksanakan kerja bakti membersihkan saluran irigasi guna mengantisipasi banjir di musim hujan. Kegiatan ini diikuti oleh seluruh perangkat desa dan masyarakat setempat.',
                'image' => 'https://images.unsplash.com/photo-1590053959828-569b910018bd?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Penyaluran Bantuan Langsung Tunai (BLT)',
                'slug' => 'penyaluran-bantuan-langsung-tunai-blt',
                'content' => 'Pemerintah Desa Tegalsambi menyalurkan Bantuan Langsung Tunai (BLT) kepada 100 Kepala Keluarga yang membutuhkan. Penyaluran berjalan tertib dan lancar dengan tetap mematuhi protokol kesehatan.',
                'image' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                'published_at' => now()->subDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pelatihan Digital Marketing untuk UMKM',
                'slug' => 'pelatihan-digital-marketing-untuk-umkm',
                'content' => 'Untuk meningkatkan ekonomi warga, diadakan pelatihan Digital Marketing bagi pelaku UMKM di Desa Tegalsambi. Peserta diajarkan cara memasarkan produk melalui media sosial dan marketplace.',
                'image' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
                'published_at' => now()->subDays(7),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
