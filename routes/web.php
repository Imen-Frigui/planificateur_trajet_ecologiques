<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ChargingStationController;

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



Route::get('/routes', [RouteController::class, 'index'])->name('routes.index');
Route::get('/routes/create', [RouteController::class, 'create'])->name('routes.create');
Route::post('/routes', [RouteController::class, 'store'])->name('routes.store');

//ChargingStations
Route::get('/chargingStations', [ChargingStationController::class, 'index'])->name('chargingStations.index');
Route::post('/chargingStations/add', [ChargingStationController::class, 'addChargingStation']);
Route::get('/chargingStations/create', [ChargingStationController::class, 'create'])->name('chargingStations.create');
Route::post('/chargingStations/store', [ChargingStationController::class, 'store'])->name('chargingStations.store');
