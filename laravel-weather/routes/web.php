<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

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

Route::get('/', [WeatherController::class, 'index'])->name('weather.index');

// API Routes for AJAX calls
Route::prefix('api')->group(function () {
    Route::get('/weather/current', [WeatherController::class, 'getCurrentWeather']);
    Route::get('/weather/forecast', [WeatherController::class, 'getForecast']);
    Route::get('/weather/hourly', [WeatherController::class, 'getHourlyForecast']);
    Route::get('/weather/search', [WeatherController::class, 'searchCities']);
    
    // Favorites
    Route::post('/favorites', [WeatherController::class, 'addFavorite']);
    Route::get('/favorites', [WeatherController::class, 'getFavorites']);
    Route::delete('/favorites', [WeatherController::class, 'removeFavorite']);
});