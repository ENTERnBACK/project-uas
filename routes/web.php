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
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\DriverTripController;
use App\Http\Controllers\ChatMessageController;

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
        $trips = \App\Models\Trip::latest()->get();
        return view('dashboard', compact('trips'));
    })->name('dashboard');

    Route::get('/dashboard-driver', function () {
        $availableTrips = \App\Models\Trip::where('status', 'pending')->latest()->get();
        $reviews = collect([]);
        $averageRating = '5.0';
        return view('dashboard_driver', compact('availableTrips', 'reviews', 'averageRating'));
    })->name('dashboard.driver');
    

    Route::get('/driver-locations/trip/{tripId}', [DriverLocationController::class, 'showByTrip'])
        ->name('driver-locations.show-by-trip');

    Route::put('/driver-trips/{id}', [DriverTripController::class, 'update'])->name('driver-trips.update');
    Route::post('/driver-trips', [DriverTripController::class, 'store'])->name('driver-trips.store');

    Route::get('/payment/{tripId}', [PaymentController::class, 'userPayment'])->name('payments.user');
    Route::post('/payments/process', [PaymentController::class, 'processPayment'])->name('payments.process');

    Route::get('/promos/user', [PromoController::class, 'userIndex'])->name('promos.user');
    Route::post('/promos/apply', [PromoController::class, 'applyPromo'])->name('promos.apply');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::put('/trips/{id}/accept', [TripController::class, 'acceptTrip'])->name('driver.trips.accept');
    Route::get('/trips/{id}/ontrip', [TripController::class, 'showOnTrip'])->name('driver.trips.ontrip');

    Route::resource('trips', TripController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('service-types', ServiceTypeController::class);
    Route::resource('support-tickets', SupportTicketController::class);
    Route::resource('driver-locations', DriverLocationController::class);
    Route::resource('favorite-locations', FavoriteLocationController::class);
    Route::resource('payment-methods', PaymentMethodController::class);
    Route::resource('chat-messages', ChatMessageController::class);
});