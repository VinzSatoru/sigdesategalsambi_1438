<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_name',
        'total_population',
        'male_population',
        'female_population',
        'household_count'
    ];
}
