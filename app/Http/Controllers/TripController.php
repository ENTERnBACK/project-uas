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
        return view('trips.create');
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

        Trip::create([
            'pickup_point' => $request->pickup_point,
            'dropoff_point' => $request->dropoff_point,
            'status' => 'pending',
        ]);

        return redirect('/dashboard')->with('success', 'Trip berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        return view('trips.show', compact('trip'));
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

        return redirect()->route('trips.index')->with('success', 'Trip berhasil diperbarui!');
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
