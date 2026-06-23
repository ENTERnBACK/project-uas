<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    /**
     * Menampilkan daftar driver
     */
    public function index()
    {
        // Menggunakan latest() agar yang terbaru di atas, paginate agar aplikasi ringan
        $drivers = Driver::latest()->paginate(10); 
        return view('drivers.index', compact('drivers')); 
    }

    /**
     * Menampilkan form pendaftaran driver baru
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah user sudah terdaftar sebagai driver agar tidak duplikat
        $existingDriver = Driver::where('email', Auth::user()->email)->first();
        if ($existingDriver) {
            return redirect()->route('drivers.show', $existingDriver->id)
                             ->with('info', 'Anda sudah terdaftar sebagai driver.');
        }

        return view('drivers.create');
    }

    /**
     * Menyimpan data driver baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'email'           => 'required|email|unique:drivers,email',
            'no_telepon'      => 'required',
            'alamat'          => 'required',
            'jenis_kendaraan' => 'required',
            'plate_nomor'     => 'required',
            'status'          => 'required|in:aktif,nonaktif',
            'foto_profil'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto_profil');

        if ($request->hasFile('foto_profil')) {
            // Menyimpan file ke folder 'public/foto_profil'
            $data['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        $driver = Driver::create($data);

        return redirect()->route('drivers.show', $driver->id)
                         ->with('success', 'Driver berhasil didaftarkan!');
    }

    /**
     * Menampilkan detail profil driver
     */
    public function show(Driver $driver)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Pastikan user hanya bisa melihat data miliknya sendiri
        if ($driver->email !== Auth::user()->email) {
            return redirect()->route('dashboard.driver')->with('error', 'Anda tidak memiliki akses!');
        }
        
        return view('drivers.show', compact('driver'));
    }

    /**
     * Menampilkan form edit data driver
     */
    public function edit(Driver $driver)
    {
        // Pastikan hanya pemilik data yang bisa masuk ke halaman edit
        if ($driver->email !== Auth::user()->email) {
            return redirect()->route('dashboard.driver')->with('error', 'Anda tidak memiliki akses edit!');
        }
        
        return view('drivers.edit', compact('driver'));
    }

    /**
     * Memperbarui data driver di database
     */
    public function update(Request $request, Driver $driver)
    {
        // Pastikan hanya pemilik data yang bisa melakukan update
        if ($driver->email !== Auth::user()->email) {
            return redirect()->route('dashboard.driver')->with('error', 'Anda tidak memiliki akses update!');
        }

        $request->validate([
            'nama'            => 'required|string|max:255',
            'no_telepon'      => 'required',
            'alamat'          => 'required',
            'jenis_kendaraan' => 'required',
            'plate_nomor'     => 'required',
            'status'          => 'required|in:aktif,nonaktif',
            'foto_profil'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['foto_profil', '_token', '_method']);

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama agar storage tidak penuh
            if ($driver->foto_profil) {
                Storage::disk('public')->delete($driver->foto_profil);
            }
            // Simpan foto baru
            $data['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        $driver->update($data);

        return redirect()->route('drivers.show', $driver->id)
                         ->with('success', 'Data driver berhasil diperbarui!');
    }

    /**
     * Menghapus data driver dan file foto terkait
     */
    public function destroy(Driver $driver)
    {
        // Pastikan hanya pemilik data yang bisa menghapus
        if ($driver->email !== Auth::user()->email) {
            return redirect()->route('dashboard.driver')->with('error', 'Anda tidak memiliki akses untuk menghapus data ini!');
        }

        // Hapus file fisik dari storage
        if ($driver->foto_profil) {
            Storage::disk('public')->delete($driver->foto_profil);
        }
        
        // Hapus record dari database
        $driver->delete();
        
        return redirect('/drivers')->with('success', 'Driver berhasil dihapus!');
    }
}