<?php

namespace App\Http\Controllers;

use App\Models\FavoriteLocation;
use Illuminate\Http\Request;

class FavoriteLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     * (Menampilkan semua daftar lokasi favorit user)
     */
    public function index()
    {
        // Mengambil semua data lokasi favorit dari database lewat Model
        $locations = FavoriteLocation::all();

        // Melempar data ke view 'FavoriteLocations.index'
        return view('FavoriteLocations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     * (Menampilkan halaman form untuk menambah lokasi favorit baru)
     */
    public function create()
    {
        return view('FavoriteLocations.create');
    }

    /**
     * Store a newly created resource in storage.
     * (Menyimpan lokasi favorit baru yang dikirim dari form create ke database)
     */
    public function store(Request $request)
    {
        // Validasi data input agar aman dari error database
        $request->validate([
            'user_id' => 'required|integer',
            'label'   => 'required|string', // Contoh: Rumah, Kampus, Kosan
            'alamat'  => 'required|string', // Alamat lengkap
        ]);

        // Menyimpan ke database MySQL via Eloquent ORM
        FavoriteLocation::create([
            'user_id' => $request->user_id,
            'label'   => $request->label,
            'alamat'  => $request->alamat,
        ]);

        // Setelah berhasil, redirect kembali ke halaman daftar lokasi
        return redirect('/favorite-locations');
    }

    /**
     * Display the specified resource.
     * (Menampilkan detail satu lokasi tertentu, biasanya opsional untuk fitur ini)
     */
    public function show(FavoriteLocation $favoriteLocation)
    {
        return view('FavoriteLocations.show', compact('favoriteLocation'));
    }

    /**
     * Show the form for editing the specified resource.
     * (Menampilkan form untuk edit alamat atau label lokasi)
     */
    public function edit(FavoriteLocation $favoriteLocation)
    {
        return view('FavoriteLocations.edit', compact('favoriteLocation'));
    }

    /**
     * Update the specified resource in storage.
     * (Menyimpan perubahan data dari form edit ke database)
     */
    public function update(Request $request, FavoriteLocation $favoriteLocations)
    {
        $request->validate([
            'label'  => 'required|string',
            'alamat' => 'required|string',
        ]);

        $favoriteLocations->update([
            'label'  => $request->label,
            'alamat' => $request->alamat,
            
        ]);

        return redirect('/FavoriteLocations');
    }

    /**
     * Remove the specified resource from storage.
     * (Menghapus lokasi favorit dari daftar)
     */
    public function destroy(FavoriteLocation $favoriteLocation)
    {
        // Menghapus data dari MySQL
        $favoriteLocation->delete();

        return redirect('/FavoriteLocations');
    }
}