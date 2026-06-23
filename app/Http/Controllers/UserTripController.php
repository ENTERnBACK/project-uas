<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserTripController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $trips = $user->trips()->latest()->get();
        $currentTrip = $user->trips()->latest()->first();

        return view('dashboard', compact('trips', 'currentTrip'));
    }
}
