<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');
Route::get('/peta', [App\Http\Controllers\MapController::class, 'index'])->name('map');
Route::get('/berita/{slug}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');

// Auth Routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pois', App\Http\Controllers\Admin\PoiController::class);
    Route::resource('infrastructures', App\Http\Controllers\Admin\InfrastructureController::class);
    Route::resource('land-uses', App\Http\Controllers\Admin\LandUseController::class);
    Route::resource('population', App\Http\Controllers\Admin\PopulationController::class);
    Route::resource('administrative-boundaries', App\Http\Controllers\Admin\AdministrativeBoundaryController::class);
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::resource('galleries', App\Http\Controllers\Admin\GalleryController::class);
});
