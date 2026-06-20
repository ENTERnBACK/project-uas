<?php

namespace App\Http\Controllers;

use App\Models\FavoriteLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteLocationController extends Controller
{
    // Menampilkan daftar lokasi milik user yang sedang login
    public function index()
    {
        $locations = FavoriteLocation::where('user_id', Auth::id())->get();
        return view('favoritelocations.index', compact('locations'));
    }

    // Menampilkan form tambah lokasi
    public function create()
    {
        return view('favoritelocations.create');
    }

    // Menyimpan data lokasi baru
    public function store(Request $request)
    {
        $request->validate([
            'label'  => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        FavoriteLocation::create([
            'user_id' => Auth::id(), // Mengambil ID user otomatis dari sesi login
            'label'   => $request->label,
            'alamat'  => $request->alamat,
        ]);

        return redirect()->route('favorite-locations.index')->with('success', 'Lokasi berhasil disimpan!');
    }

    // Menampilkan detail lokasi tertentu
    public function show(FavoriteLocation $favoriteLocation)
    {
        // Proteksi: User lain tidak bisa melihat data user lain
        if ($favoriteLocation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin.');
        }
        $location = $favoriteLocation;
        return view('favoritelocations.show', compact('location'));
    }

    // Menampilkan form edit
    public function edit(FavoriteLocation $favoriteLocation)
    {
        // Proteksi: User lain tidak bisa edit data user lain
        if ($favoriteLocation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin.');
        }
        $location = $favoriteLocation;
        return view('favoritelocations.edit', compact('location'));
    }

    // Memperbarui data ke database
    public function update(Request $request, FavoriteLocation $favoriteLocation)
    {
        // Proteksi: User lain tidak bisa update data user lain
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

    // Menghapus data
    public function destroy(FavoriteLocation $favoriteLocation)
    {
        // Proteksi: User lain tidak bisa hapus data user lain
        if ($favoriteLocation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin.');
        }

        $favoriteLocation->delete();
        return redirect()->route('favorite-locations.index')->with('success', 'Lokasi berhasil dihapus!');
    }
}