<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('driver-locations', DriverLocationController::class);

Route::resource('support-tickets', SupportTicketController::class);