<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;

class DriverTripController extends Controller
{
    public function update(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);
        $trip->update([
            'status' => 'on_trip'
        ]);

        $passenger = User::find($trip->user_id);
        $passengerName = $passenger ? $passenger->name : 'Pelanggan';

        return view('driver_ontrip', compact('trip', 'passengerName'));
    }

    public function store(Request $request)
    {
        $trip = Trip::findOrFail($request->trip_id);
        $trip->update([
            'status' => 'completed'
        ]);
        return redirect()->to('/dashboard-driver')->with('success', 'Hore! Berhasil menyelesaikan orderan.');
    }
}