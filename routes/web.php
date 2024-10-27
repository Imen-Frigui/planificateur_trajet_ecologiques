<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\ChargingStationController;
use App\Http\Controllers\PublicTransportController;
use App\Http\Controllers\DurationController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');

//WeatherCondition 
Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');
Route::get('/weather/create', [WeatherController::class, 'create'])->name('weather.create');
Route::post('/weather', [WeatherController::class, 'store'])->name('weather.store');


//ChargingStations
Route::get('/chargingStations', [ChargingStationController::class, 'index'])->name('chargingStations.index');
Route::post('/chargingStations/add', [ChargingStationController::class, 'addChargingStation']);
Route::get('/chargingStations/create', [ChargingStationController::class, 'create'])->name('chargingStations.create');
Route::post('/chargingStations/store', [ChargingStationController::class, 'store'])->name('chargingStations.store');
// Route::delete('/chargingStations/delete', [ChargingStationController::class, 'destroy'])->name('chargingStations.delete');
Route::delete('/charging-station', action: [ChargingStationController::class, 'deleteChargingStation'])->name('chargingStations.delete');

// Public Transport routes
Route::get('/public-transport', [PublicTransportController::class, 'index'])->name('public-transport.index'); // Note: Use lowercase
Route::get('/public-transport/{id}', [PublicTransportController::class, 'show']);
Route::get('/transport/create', [PublicTransportController::class, 'create'])->name('public-transport.create');
Route::post('/public-transport', [PublicTransportController::class, 'store'])->name('public-transport.store');
Route::put('/public-transport/{id}', [PublicTransportController::class, 'update']);
Route::delete('/public-transport/{id}', [PublicTransportController::class, 'destroy'])->name('public-transport.destroy');

//Duration
Route::get('/duration', [DurationController::class, 'index'])->name('duration.index'); // Note: Use lowercase
Route::get('/duration/create', [DurationController::class, 'create'])->name('duration.create');
Route::post('/duration', [DurationController::class, 'store'])->name('duration.store');
Route::delete('/duration/{id}', [DurationController::class, 'destroy'])->name('duration.destroy');
