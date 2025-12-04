<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/map/boundaries', [App\Http\Controllers\MapController::class, 'getAdministrativeBoundaries']);
Route::get('/map/pois', [App\Http\Controllers\MapController::class, 'getPois']);
Route::get('/map/infrastructures', [App\Http\Controllers\MapController::class, 'getInfrastructures']);
Route::get('/map/land-uses', [App\Http\Controllers\MapController::class, 'getLandUses']);
