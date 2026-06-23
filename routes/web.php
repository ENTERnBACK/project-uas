<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FavoriteLocationController;
use App\Http\Controllers\DriverLocationController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\DriverTripController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserTripController;

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

    Route::get('/dashboard', [UserTripController::class, 'index'])->name('dashboard');
    Route::get('/trips/status/check', [UserTripController::class, 'show'])->name('trips.check-status');
    Route::post('/trips/select-driver', [App\Http\Controllers\TripController::class, 'selectDriver'])->name('trips.selectDriver');

    Route::get('/dashboard-driver', function () {
        $availableTrips = \App\Models\Trip::where('status', 'pending')->latest()->get();
        $reviews = \App\Models\Review::latest()->get();
        $avg = \App\Models\Review::avg('rating') ?? 5.0;
        $averageRating = number_format((float)$avg, 1, '.', '');
        return view('dashboard_driver', compact('availableTrips', 'reviews', 'averageRating'));
    })->name('dashboard.driver');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('user_profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('user_profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('user_profile.update');

    Route::get('/driver-locations/trip/{tripId}', [DriverLocationController::class, 'showByTrip'])
        ->name('driver-locations.show-by-trip');

    Route::put('/driver-trips/{id}', [DriverTripController::class, 'update'])->name('driver-trips.update');
    Route::post('/driver-trips', [DriverTripController::class, 'store'])->name('driver-trips.store');

    Route::get('/payment/{tripId}', [PaymentController::class, 'userPayment'])->name('payments.user');
    Route::post('/payments/process', [PaymentController::class, 'processPayment'])->name('payments.process');
    Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');

    Route::get('/promos', [PromoController::class, 'index'])->name('promos.index');
    Route::get('/promos/user', [PromoController::class, 'userIndex'])->name('promos.user');
    Route::post('/promos/apply', [PromoController::class, 'applyPromo'])->name('promos.apply');
    Route::post('/promos/remove', [PromoController::class, 'removePromo'])->name('promos.remove');

    Route::post('/payments/set-service', [PaymentController::class, 'setService'])->name('payments.set-service');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::put('/trips/{id}/accept', [TripController::class, 'acceptTrip'])->name('driver.trips.accept');
    Route::get('/trips/{id}/ontrip', [TripController::class, 'showOnTrip'])->name('driver.trips.ontrip');

    Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('payment_method.index');
    Route::prefix('payment-methods')->name('payment_method.')->group(function () {
        Route::get('/', [PaymentMethodController::class, 'index'])->name('index');
        Route::get('/create', [PaymentMethodController::class, 'create'])->name('create');
        Route::post('/', [PaymentMethodController::class, 'store'])->name('store');
        Route::delete('/{id}', [PaymentMethodController::class, 'destroy'])->name('destroy');
        Route::post('/payment-methods', [PaymentController::class, 'storePaymentMethod'])->name('payment-methods.store');
    });
    
    Route::post('/service-types/select', [App\Http\Controllers\ServiceTypeController::class, 'selectService'])->name('service_types.select');
    
    Route::resource('trips', TripController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('service-types', ServiceTypeController::class);
    Route::resource('support-tickets', SupportTicketController::class);
    Route::resource('driver-locations', DriverLocationController::class);
    Route::resource('favorite-locations', FavoriteLocationController::class);
    Route::resource('payment-methods', PaymentMethodController::class)->names('payment_method');
    Route::resource('chat-messages', ChatMessageController::class)->except(['show', 'edit', 'update', 'create', 'store']);
    Route::resource('notifications', NotificationController::class)->except(['show', 'edit', 'update']);
     
    Route::get('/trips/{trip}/chat', [ChatMessageController::class, 'room'])->name('trips.chat');
    Route::post('/trips/{trip}/chat', [ChatMessageController::class, 'storeMessage'])->name('trips.chat.store');
});