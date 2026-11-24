<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PackingItemController;
use App\Http\Controllers\SavedPlaceController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // Gestión de viajes
    Route::resource('trips', TripController::class);

    // Gestión de destinos
    Route::resource('trips.destinations', DestinationController::class);

    // Gestión de actividades
    Route::resource('trips.destinations.activities', ActivityController::class);

    // Gestión de gastos
    Route::resource('trips.expenses', ExpenseController::class);

    // Gestión del equipaje
    Route::resource('trips.packing-items', PackingItemController::class);

    // Gestión de lugares guardados
    Route::resource('trips.destinations.saved-places', SavedPlaceController::class);

    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::get('/test-cookie', function () {
    return response('Cookie test')
        ->header('X-Laravel-Test', 'correcto')
        ->cookie('test-cookie', 'funciona', 60);
});

require __DIR__.'/auth.php';