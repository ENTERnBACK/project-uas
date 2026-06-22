<?php

namespace App\Http\Controllers;

use App\Models\FavoriteLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteLocationController extends Controller
{
   
    public function index()
    {
        $locations = FavoriteLocation::where('user_id', Auth::id())->latest()->get();
        return view('FavoriteLocations.index', compact('locations'));
    }

   
    public function create()
    {
        $locations = FavoriteLocation::where('user_id', Auth::id())->latest()->get();
        return view('FavoriteLocations.create', compact('locations'));
    }

  
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

   
    public function show(FavoriteLocation $favoriteLocation)
    {
        if ($favoriteLocation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin.');
        }
        return view('FavoriteLocations.show', compact('favoriteLocation'));
    }

    
    public function edit(FavoriteLocation $favoriteLocation)
    {
        if ($favoriteLocation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki izin.');
        }
        
     
        $locations = FavoriteLocation::where('user_id', Auth::id())->latest()->get();
        
        return view('FavoriteLocations.edit', compact('favoriteLocation', 'locations'));
    }

    
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