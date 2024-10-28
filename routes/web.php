<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ChargingStationController;
use App\Http\Controllers\SpeedController;

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
