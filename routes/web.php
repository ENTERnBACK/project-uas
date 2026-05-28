<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FavoriteLocationController;
use App\Http\Controllers\DriverLocationController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/reviews');
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::resource('favorite-locations', FavoriteLocationController::class);

Route::resource('drivers', DriverController::class);

Route::resource('driver-locations', DriverLocationController::class);

Route::resource('support-tickets', SupportTicketController::class);

Route::resource('reviews', ReviewController::class);