<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FavoriteLocationController;
use App\Http\Controllers\DriverLocationController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ServiceTypeController;

Route::get('/', function () {
    return redirect('/reviews');
});

Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route::get('/login', function () {
//     return view('auth.login');
// });
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/logout', [AuthController::class, 'logout']);


// Route::post('/register', [AuthController::class, 'register']);

Route::resource('favorite-locations', FavoriteLocationController::class);

Route::resource('drivers', DriverController::class);

Route::resource('driver-locations', DriverLocationController::class);

Route::resource('support-tickets', SupportTicketController::class);

Route::resource('reviews', ReviewController::class);

Route::resource('service-types', ServiceTypeController::class);