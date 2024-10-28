<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\ChargingStationController;
use App\Http\Controllers\TrafficController;



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

Route::get('/chargingStations/{uri}/edit', [ChargingStationController::class, 'edit'])
    ->name('chargingStations.edit')
    ->where('uri', '.*');

Route::put('/chargingStations/{uri}', [ChargingStationController::class, 'update'])
    ->name('chargingStations.update')
    ->where('uri', '.*');

    Route::get('/trafficConditions', [TrafficController::class, 'index'])->name('trafficConditions.index');

    Route::post('/trafficConditions/add', [TrafficController::class, 'add']);
    Route::get('/trafficConditions/create', [TrafficController::class, 'create'])->name('trafficConditions.create');
    Route::post('/trafficConditions/store', [TrafficController::class, 'store'])->name('trafficConditions.store');
    Route::delete('/traffic-condition', [TrafficController::class, 'deleteTrafficCondition'])->name('trafficConditions.delete');


    
    Route::get('/trafficConditions/{id}/edit', [TrafficController::class, 'edit'])
    ->name('trafficConditions.edit')
    ->where('id', '.*'); 


Route::put('/trafficConditions/{id}', [TrafficController::class, 'update'])
    ->name('trafficConditions.update')
    ->where('id', '.*');

    