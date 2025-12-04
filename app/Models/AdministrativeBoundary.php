<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrativeBoundary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'geom',
        'attributes'
    ];
}
