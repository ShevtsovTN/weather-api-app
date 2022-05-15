<?php

use Illuminate\Support\Facades\Route;
use Modules\Weather\Http\Controllers\WeatherController;

Route::get('weather', [WeatherController::class, 'show'])->name('weather.show');
Route::post('weather', [WeatherController::class, 'pull'])->name('weather.pull');
Route::match(['put', 'patch'], 'weather/{weather}', [WeatherController::class, 'update'])->name('weather.update');
Route::delete('weather/{weather}', [WeatherController::class, 'destroy'])->name('weather.destroy');
