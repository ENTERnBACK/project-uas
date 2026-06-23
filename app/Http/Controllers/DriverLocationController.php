<?php

namespace App\Http\Controllers;

use App\Models\DriverLocation;
use App\Models\Trip;
use App\Models\User;
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

        return view('driver_locations.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        DriverLocation::updateOrCreate(
            ['user_id' => $request->user_id],
            [
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]
        );

        return redirect()
            ->route('driver-locations.index')
            ->with('success', 'Lokasi driver berhasil diperbarui.');
    }

    /**
     * User memilih driver.
     */
    public function selectDriver(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:users,id',
        ]);

        // Ambil trip terakhir milik user yang sedang login
        $trip = Trip::where('user_id', auth()->id())
                    ->latest()
                    ->firstOrFail();

        $trip->update([
            'driver_id' => $request->driver_id,
            'status'    => 'on_trip',
        ]);

        return redirect()
            ->route('trips.show', $trip->id)
            ->with('success', 'Driver berhasil dipilih.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $driverLocation = DriverLocation::findOrFail($id);

        return view('driver_locations.show', compact('driverLocation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $driverLocation = DriverLocation::findOrFail($id);
        $users = User::where('role', 'driver')->get();

        return view('driver_locations.edit', compact('driverLocation', 'users'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $driverLocation = DriverLocation::findOrFail($id);

        $driverLocation->update([
            'user_id' => $request->user_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()
            ->route('driver-locations.index')
            ->with('success', 'Lokasi driver berhasil diperbarui.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy($id)
    {
        $driverLocation = DriverLocation::findOrFail($id);

        $driverLocation->delete();

        return redirect()
            ->route('driver-locations.index')
            ->with('success', 'Lokasi driver berhasil dihapus.');
    }
}