<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_uses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // Settlement, Rice Field, etc.
            $table->polygon('geom'); // Spatial Polygon
            $table->double('area_sqm')->nullable();
            $table->json('attributes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('land_uses');
    }
}
