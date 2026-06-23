<?php

namespace App\Http\Controllers;

use App\Models\DriverLocation;
use App\Models\User;
use App\Models\Trip;
use Illuminate\Http\Request;

class DriverLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $driverLocations = DriverLocation::with('user')->get();

        return view('driver_locations.index', compact('driverLocations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'driver')->get();

        return view(
            'driver_locations.create',
            compact('users')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $driverLocation = DriverLocation::updateOrCreate(
            ['user_id' => $validated['user_id']],
            [
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
            ]
        );

        $activeTrip = Trip::where('driver_id', $validated['user_id'])
            ->latest()
            ->first();

        if (!$activeTrip) {
            $activeTrip = Trip::create([
                'user_id' => auth()->id(),
                'driver_id' => $validated['user_id'],
                'pickup_point' => 'Lokasi Penumpang',
                'dropoff_point' => 'Tujuan Perjalanan',
                'status' => 'on_trip',
            ]);
        } else {
            $activeTrip->update([
                'status' => 'on_trip'
            ]);
        }

        return redirect()
            ->route('trips.show', $activeTrip->id)
            ->with('success', 'Driver dipilih dan perjalanan dimulai.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DriverLocation $driverLocation)
    {
        return view('driver_locations.show', compact('driverLocation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DriverLocation $driverLocation)
    {
        $users = User::where('role', 'driver')->get();

        return view('driver_locations.edit', compact('driverLocation', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DriverLocation $driverLocation)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $driverLocation->update($validated);

        return redirect()
            ->route('driver-locations.index')
            ->with('success', 'Lokasi driver berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverLocation $driverLocation)
    {
        $driverLocation->delete();

        return redirect()
            ->route('driver-locations.index')
            ->with('success', 'Lokasi driver berhasil dihapus.');
    }
}