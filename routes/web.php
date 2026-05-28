<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverLocationController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\ReviewController;
Route::get('/', function () {
    return redirect('/reviews');
});

Route::resource('driver-locations', DriverLocationController::class);

Route::resource('support-tickets', SupportTicketController::class);

Route::resource('reviews', ReviewController::class);