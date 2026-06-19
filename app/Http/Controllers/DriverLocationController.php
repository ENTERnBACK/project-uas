<?php

namespace App\Http\Controllers;

use App\Models\DriverLocation;
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

        DriverLocation::create($validated);

        return redirect()
            ->route('driver-locations.index')
            ->with('success', 'Lokasi driver berhasil ditambahkan.');
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
        return view('driver_locations.edit', compact('driverLocation'));
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