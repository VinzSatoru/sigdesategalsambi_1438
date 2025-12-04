<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'admin@tegalsambi.desa.id',
            'password' => bcrypt('password'), // Default password
            'role' => 'admin',
        ]);
    }
}
