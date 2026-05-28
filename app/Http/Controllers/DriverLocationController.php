<?php

namespace App\Http\Controllers;

use App\Models\DriverLocation;
use Illuminate\Http\Request;

class DriverLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $driverLocations = DriverLocation::all();
        return view('driver_locations.index', compact('driverLocations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('driver_locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DriverLocation::create([
            'user_id' => $request->user_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect('/driver-locations');
    }


    /**
     * Display the specified resource.
     */
    public function show(DriverLocation $driverLocation)
    {
        //
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
        $driverLocation->update([
            'user_id' => $request->user_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect('/driver-locations');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverLocation $driverLocation)
    {
        $driverLocation->delete();

        return redirect('/driver-locations');
    }

}
