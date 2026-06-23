<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::orderBy('created_at', 'desc')->get();
        return view('trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $favoriteLocations = \App\Models\FavoriteLocation::where('user_id', auth()->id())->get();
        return view('trips.create', compact('favoriteLocations'));;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pickup_point' => 'required|string|max:255',
            'dropoff_point' => 'required|string|max:255',
        ]);

        $trip = Trip::create([
            'user_id'       => auth()->id(),
            'pickup_point' => $request->pickup_point,
            'dropoff_point' => $request->dropoff_point,
            'status' => 'cancelled',
        ]);

        return redirect()->route('service-types.index', ['trip_id' => $trip->id])
            ->with('success', 'Trip berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        $currentTrip = $trip;
        return view('trips.show', compact('currentTrip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        return view('trips.edit', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {

        if ($request->has('activate_trip')) {
            $trip->update([
                'status' => 'pending'
            ]);

            return redirect()->route('trips.index')->with('success');
        }

        $request->validate([
            'pickup_point' => 'required|string|max:255',
            'dropoff_point' => 'required|string|max:255',
            'status' => 'required|in:pending,on_trip,completed,cancelled',
        ]);;

        $trip->update([
            'pickup_point' => $request->pickup_point,
            'dropoff_point' => $request->dropoff_point,
            'status' => $request->status,
        ]);

        return redirect()->route('payment-methods.index', ['trip_id' => $trip->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('trips.index')->with('success', 'Trip berhasil dihapus!');
    }
}
