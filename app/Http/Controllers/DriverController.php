<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    
    public function index()
    {
        
        $drivers = Driver::all(); 
        
       
        return view('drivers.index', compact('drivers')); 
    }

   
    public function create()
    {
        return view('drivers.create');
    }

   
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'no_telepon' => 'required',
        'alamat' => 'required',
        'jenis_kendaraan' => 'required',
        'plate_nomor' => 'required',
        'status' => 'required',
    ]);

    Driver::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'no_telepon' => $request->no_telepon,
        'alamat' => $request->alamat,
        'jenis_kendaraan' => $request->jenis_kendaraan,
        'plate_nomor' => $request->plate_nomor,
        'status' => $request->status,
    ]);

    return redirect('/drivers');
}


    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    
    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

   
    public function update(Request $request, Driver $driver)
    {
        
        $request->validate([
            'nama' => 'required',
            'status' => 'required',
        ]);

        // Update data di database
        $driver->update([
            'nama' => $request->nama,
            'status' => $request->status, 
        ]);

        return redirect('/drivers');
    }

    
    public function destroy(Driver $driver)
    {
        
        $driver->delete();

        return redirect('/drivers');
    }
}