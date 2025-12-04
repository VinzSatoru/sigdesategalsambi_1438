<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandUse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'geom',
        'area_sqm',
        'attributes'
    ];
}
