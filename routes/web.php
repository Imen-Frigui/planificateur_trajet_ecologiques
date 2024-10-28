<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ChargingStationController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\SpeedController;
use App\Http\Controllers\DistanceController;
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
Route::delete('/weather/{id}', [WeatherController::class, 'destroy'])->name('weather.destroy');
Route::get('/weather/search', [WeatherController::class, 'searchWeather'])->name('weather.search');
Route::get('/weather/{id}', [WeatherController::class, 'show'])->name('weather.show');




// Routes (CRUD for routes)
Route::get('/routes', [RouteController::class, 'index'])->name('routes.index');
Route::get('/routes/create', [RouteController::class, 'create'])->name('routes.create');
Route::post('/routes', [RouteController::class, 'store'])->name('routes.store');
Route::get('/routes/{id}', [RouteController::class, 'show'])->name('routes.show'); 
Route::get('/routes/{id}/edit', [RouteController::class, 'edit'])->name('routes.edit'); 
Route::put('/routes/{id}', [RouteController::class, 'update'])->name('routes.update'); 
Route::delete('/routes/{id}', [RouteController::class, 'destroy'])->name('routes.destroy'); 

// Routes (CRUD for Speed)
Route::get('/speeds', [SpeedController::class, 'index'])->name('speeds.index');
Route::get('/speeds/create', [SpeedController::class, 'create'])->name('speeds.create');
Route::post('/speeds', [SpeedController::class, 'store'])->name('speeds.store');
Route::get('/speeds/{id}/edit', [SpeedController::class, 'edit'])->name('speeds.edit');
Route::put('/speeds/{id}', [SpeedController::class, 'update'])->name('speeds.update');
Route::delete('/speeds/{id}', [SpeedController::class, 'destroy'])->name('speeds.destroy');

//ChargingStations
Route::get('/chargingStations', [ChargingStationController::class, 'index'])->name('chargingStations.index');
Route::post('/chargingStations/add', [ChargingStationController::class, 'addChargingStation']);
Route::get('/chargingStations/create', [ChargingStationController::class, 'create'])->name('chargingStations.create');
Route::post('/chargingStations/store', [ChargingStationController::class, 'store'])->name('chargingStations.store');
// Route::delete('/chargingStations/delete', [ChargingStationController::class, 'destroy'])->name('chargingStations.delete');
Route::delete('/charging-station', action: [ChargingStationController::class, 'deleteChargingStation'])->name('chargingStations.delete');

// Vehicle Routes
Route::get('/vehicle', [VehicleController::class, 'index'])->name('vehicle.index');
Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create');
Route::post('/vehicle', [VehicleController::class, 'store'])->name('vehicle.store');
Route::delete('/vehicle/{id}', [VehicleController::class, 'destroy'])->name('vehicle.destroy');
Route::get('/vehicle/search', [VehicleController::class, 'search'])->name('vehicle.search');
Route::get('/vehicle/{id}', [VehicleController::class, 'show'])->name('vehicle.show');


Route::get('/chargingStations/{uri}/edit', [ChargingStationController::class, 'edit'])
    ->name('chargingStations.edit')
    ->where('uri', '.*');

Route::put('/chargingStations/{uri}', [ChargingStationController::class, 'update'])
    ->name('chargingStations.update')
    ->where('uri', '.*');


    // Other routes...
    
    Route::get('/distances', [DistanceController::class, 'index'])->name('distances.index');
    Route::get('/distances/create', [DistanceController::class, 'create'])->name('distances.create');
    Route::post('/distances', [DistanceController::class, 'store'])->name('distances.store');
    Route::delete('/distances/delete', [DistanceController::class, 'deleteDistance'])->name('distances.delete');
     

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

    