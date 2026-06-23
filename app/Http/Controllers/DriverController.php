<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{

    public function index()
    {
        $drivers = Driver::latest()->paginate(10); 
        return view('drivers.index', compact('drivers')); 
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $existingDriver = Driver::where('email', Auth::user()->email)->first();
        if ($existingDriver) {
            return redirect()->route('drivers.show', $existingDriver->id)
                             ->with('info', 'Anda sudah terdaftar sebagai driver.');
        }

        return view('drivers.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'email'           => 'required|email|unique:drivers,email',
            'no_telepon'      => 'required',
            'alamat'          => 'required',
            'jenis_kendaraan' => 'required',
            'plate_nomor'     => 'required',
            'foto_profil'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto_profil');

        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        $driver = Driver::create($data);

        return redirect()->route('drivers.show', $driver->id)
                         ->with('success', 'Driver berhasil didaftarkan!');
    }
    public function show(Driver $driver)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if ($driver->email !== Auth::user()->email) {
            return redirect()->route('dashboard.driver')->with('error', 'Anda tidak memiliki akses!');
        }
        
        return view('drivers.show', compact('driver'));
    }
    public function edit(Driver $driver)
    {

        if ($driver->email !== Auth::user()->email) {
            return redirect()->route('dashboard.driver')->with('error', 'Anda tidak memiliki akses edit!');
        }
        
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        if ($driver->email !== Auth::user()->email) {
            return redirect()->route('dashboard.driver')->with('error', 'Anda tidak memiliki akses update!');
        }

        $request->validate([
            'nama'            => 'required|string|max:255',
            'no_telepon'      => 'required',
            'alamat'          => 'required',
            'jenis_kendaraan' => 'required',
            'plate_nomor'     => 'required',
            'foto_profil'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['foto_profil', '_token', '_method']);

        if ($request->hasFile('foto_profil')) {
            if ($driver->foto_profil) {
                Storage::disk('public')->delete($driver->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        $driver->update($data);

        return redirect()->route('drivers.show', $driver->id)
                         ->with('success', 'Data driver berhasil diperbarui!');
    }
    public function destroy(Driver $driver)
    {
        if ($driver->email !== Auth::user()->email) {
            return redirect()->route('dashboard.driver')->with('error', 'Anda tidak memiliki akses untuk menghapus data ini!');
        }
        if ($driver->foto_profil) {
            Storage::disk('public')->delete($driver->foto_profil);
        }
        $driver->delete();
        return redirect('/drivers')->with('success', 'Driver berhasil dihapus!');
    }
}