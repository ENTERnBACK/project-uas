<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FavoriteLocationController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('drivers', DriverController::class);

Route::resource('favorite-locations', FavoriteLocationController::class);