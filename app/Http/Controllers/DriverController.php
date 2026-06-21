<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     * (Menampilkan semua daftar driver Gojek)
     */
    public function index()
    {
        // Mengambil semua data driver dari database lewat Model
        $drivers = Driver::all(); 
        
        // Melempar data ke view 'drivers.index'
        return view('drivers.index', compact('drivers')); 
    }

    /**
     * Show the form for creating a new resource.
     * (Menampilkan halaman form untuk mendaftar jadi driver baru)
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     * (Menyimpan data driver baru yang dikirim dari form create ke database)
     */
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

    /**
     * Display the specified resource.
     * (Menampilkan detail profil satu driver tertentu berdasarkan ID)
     */
    public function show(Driver $driver)
    {
        // Laravel menggunakan Route Model Binding, jadi data $driver otomatis dicari 
        return view('drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     * (Menampilkan halaman edit untuk mengubah data/status driver)
     */
    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     * (Menyimpan perubahan data/status driver dari form edit ke database)
     */
    public function update(Request $request, Driver $driver)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'status' => 'required',
        ]);

        // Update data di database
        $driver->update([
            'nama' => $request->nama,
            'status' => $request->status, // Mengubah status Aktif/Nonaktif
        ]);

        return redirect('/drivers');
    }

    /**
     * Remove the specified resource from storage.
     * (Menghapus akun driver dari sistem jika resign)
     */
    public function destroy(Driver $driver)
    {
        // Menghapus data dari MySQL
        $driver->delete();

        return redirect('/drivers');
    }
}