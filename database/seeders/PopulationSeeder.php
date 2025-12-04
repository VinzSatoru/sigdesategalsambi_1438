<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Population;

class PopulationSeeder extends Seeder
{
    public function run()
    {
        // Dusun GEGUNUNG
        // RW 002
        Population::create([
            'region_name' => 'RT 008 / RW 002 - Dusun GEGUNUNG',
            'household_count' => 164,
            'total_population' => 543,
            'male_population' => 267,
            'female_population' => 276,
        ]);
        Population::create([
            'region_name' => 'RT 006 / RW 002 - Dusun GEGUNUNG',
            'household_count' => 132,
            'total_population' => 428,
            'male_population' => 231,
            'female_population' => 197,
        ]);
        Population::create([
            'region_name' => 'RT 007 / RW 002 - Dusun GEGUNUNG',
            'household_count' => 140,
            'total_population' => 472,
            'male_population' => 240,
            'female_population' => 232,
        ]);
        Population::create([
            'region_name' => 'RT 012 / RW 002 - Dusun GEGUNUNG',
            'household_count' => 70,
            'total_population' => 221,
            'male_population' => 115,
            'female_population' => 106,
        ]);

        // RW 001
        Population::create([
            'region_name' => 'RT 004 / RW 001 - Dusun GEGUNUNG',
            'household_count' => 174,
            'total_population' => 592,
            'male_population' => 305,
            'female_population' => 287,
        ]);
        Population::create([
            'region_name' => 'RT 005 / RW 001 - Dusun GEGUNUNG',
            'household_count' => 176,
            'total_population' => 624,
            'male_population' => 313,
            'female_population' => 311,
        ]);

        // Dusun LEMBAH
        // RW 001
        Population::create([
            'region_name' => 'RT 001 / RW 001 - Dusun LEMBAH',
            'household_count' => 157,
            'total_population' => 533,
            'male_population' => 267,
            'female_population' => 266,
        ]);
        Population::create([
            'region_name' => 'RT 002 / RW 001 - Dusun LEMBAH',
            'household_count' => 100,
            'total_population' => 294,
            'male_population' => 146,
            'female_population' => 148,
        ]);
        Population::create([
            'region_name' => 'RT 003 / RW 001 - Dusun LEMBAH',
            'household_count' => 109,
            'total_population' => 348,
            'male_population' => 177,
            'female_population' => 171,
        ]);

        // RW 002
        Population::create([
            'region_name' => 'RT 009 / RW 002 - Dusun LEMBAH',
            'household_count' => 186,
            'total_population' => 567,
            'male_population' => 283,
            'female_population' => 284,
        ]);
        Population::create([
            'region_name' => 'RT 010 / RW 002 - Dusun LEMBAH',
            'household_count' => 109,
            'total_population' => 359,
            'male_population' => 173,
            'female_population' => 186,
        ]);
        Population::create([
            'region_name' => 'RT 011 / RW 002 - Dusun LEMBAH',
            'household_count' => 156,
            'total_population' => 494,
            'male_population' => 248,
            'female_population' => 246,
        ]);
    }
}
