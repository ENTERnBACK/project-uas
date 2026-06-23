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
    
    public function show()
    {
        $user = auth()->user();
        $currentTrip = $user->trips()
            ->whereIn('status', ['accepted', 'ontrip'])
            ->latest()
            ->first();

        if (!$currentTrip) {
            $lastTrip = $user->trips()->latest()->first();

            return response()->json([
                'status' => 'completed',
                'last_trip_id' => $lastTrip ? $lastTrip->id : null
            ]);
        }
        return response()->json([
            'status' => $currentTrip->status,
            'last_trip_id' => $currentTrip->id
        ]);
    }
}