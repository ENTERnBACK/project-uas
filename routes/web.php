<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FavoriteLocationController;
use App\Http\Controllers\DriverLocationController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceTypeController;

Route::get('/', function () {
    return view('home');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('trips', TripController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('service-types', ServiceTypeController::class);
    Route::resource('support-tickets', SupportTicketController::class);
    Route::resource('driver-locations', DriverLocationController::class);
    Route::resource('favorite-locations', FavoriteLocationController::class);
});