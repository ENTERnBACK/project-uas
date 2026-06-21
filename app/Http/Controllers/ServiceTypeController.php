<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('service_types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // return view('service_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           $request->validate([
            'service_type' => 'required'
        ]);

        ServiceType::create([
            'service_type' => $request->service_type
        ]);

        return redirect('/favorite-locations/create');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceType $service_type)
    {
        return view('services_types.show' , compact('serviceTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceType $service_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceType $service_type)
    {
        $request->validate([
            'service_type' => 'required'
        ]);

        $service_type->update([
            'service_type' => $request->service_type
        ]);

        return redirect('/favorite-locations/create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceType $service_type)
    {
        //
    }
}
