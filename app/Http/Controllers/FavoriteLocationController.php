<?php

namespace App\Http\Controllers;

use App\Models\FavoriteLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteLocationController extends Controller
{
    // 1. Menampilkan daftar lokasi milik user yang sedang login
    public function index()
    {
        $locations = FavoriteLocation::where('user_id', Auth::id())->latest()->get();
        return view('FavoriteLocations.index', compact('locations'));
    }

    // 2. Menampilkan form tambah lokasi + daftar lokasi di bawahnya
    public function create()
    {
        $locations = FavoriteLocation::where('user_id', Auth::id())->latest()->get();
        return view('FavoriteLocations.create', compact('locations'));
    }

    // 3. Menyimpan data lokasi baru
    public function store(Request $request)
    {
        $request->validate([
            'label'  => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        FavoriteLocation::create([
            'user_id' => Auth::id(), 
            'label'   => $request->label,
            'alamat'  => $request->alamat,
        ]);

        return redirect()->route('favorite-locations.index')->with('success', 'Lokasi berhasil disimpan!');
    }

    // 4. Menampilkan detail lokasi tertentu
    public function show(FavoriteLocation $favoriteLocation)
    {
        if ($favoriteLocation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin.');
        }
        return view('FavoriteLocations.show', compact('favoriteLocation'));
    }

    // 5. Menampilkan form edit + daftar lokasi agar tabel tetap muncul
    public function edit(FavoriteLocation $favoriteLocation)
    {
        if ($favoriteLocation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin.');
        }
        
        // Ambil daftar lokasi untuk tabel di bawah form edit
        $locations = FavoriteLocation::where('user_id', Auth::id())->latest()->get();
        
        return view('FavoriteLocations.edit', compact('favoriteLocation', 'locations'));
    }

    // 6. Memperbarui data ke database
    public function update(Request $request, FavoriteLocation $favoriteLocation)
    {
        if ($favoriteLocation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin.');
        }

        $request->validate([
            'label'  => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        $favoriteLocation->update([
            'label'  => $request->label,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('favorite-locations.index')->with('success', 'Lokasi berhasil diupdate!');
    }

    // 7. Menghapus data
    public function destroy(FavoriteLocation $favoriteLocation)
    {
        if ($favoriteLocation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin.');
        }

        $favoriteLocation->delete();
        return redirect()->route('favorite-locations.index')->with('success', 'Lokasi berhasil dihapus!');
    }
}