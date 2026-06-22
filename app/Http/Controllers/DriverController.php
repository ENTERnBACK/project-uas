<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    // Menampilkan semua driver (untuk admin)
    public function index()
    {
        $drivers = Driver::all(); 
        return view('drivers.index', compact('drivers')); 
    }

    // Menampilkan form pendaftaran dengan proteksi
    public function create()
    {
        if (!Auth::check()) return redirect()->route('login');

        // CEK LOGIKA: Jika sudah terdaftar, jangan buka form, arahkan ke profil
        $existingDriver = Driver::where('email', Auth::user()->email)->first();
        if ($existingDriver) {
            return redirect()->route('drivers.show', $existingDriver->id)
                             ->with('info', 'Anda sudah terdaftar sebagai driver.');
        }

        return view('drivers.create');
    }

    // Menyimpan data driver
    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required',
            'email'          => 'required|email|unique:drivers,email',
            'no_telepon'     => 'required',
            'alamat'         => 'required',
            'jenis_kendaraan'=> 'required',
            'plate_nomor'    => 'required',
            'status'         => 'required',
        ]);

        $driver = Driver::create($request->all());

        return redirect()->route('drivers.show', $driver->id)
                         ->with('success', 'Driver berhasil didaftarkan!');
    }

    // Menampilkan profil driver dengan proteksi akses
    public function show(Driver $driver)
    {
        if (!Auth::check()) return redirect()->route('login');

        // Cek apakah driver tersebut milik user yang sedang login
        if ($driver->email !== Auth::user()->email) {
            return redirect()->route('dashboard.driver')->with('error', 'Anda tidak memiliki akses!');
        }
        
        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'status'=> 'required|in:aktif,nonaktif',
        ]);

        $driver->update([
            'nama'  => $request->nama,
            'status'=> $request->status, 
        ]);

        return redirect('/drivers')->with('success', 'Data driver berhasil diperbarui!');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect('/drivers')->with('success', 'Driver berhasil dihapus!');
    }
}