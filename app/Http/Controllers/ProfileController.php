<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('user_profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('user_profile.edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'phone' => 'required|max:15',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('photo')) {

        if ($user->photo) {
            Storage::disk('public')->delete('profile/'.$user->photo);
        }

        $photoName = time().'.'.$request->file('photo')->getClientOriginalExtension();
    
        $request->file('photo')->storeAs(
            'profile',
            $photoName,
            'public'
        );

        $user->photo = $photoName;
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;

    $user->save();

    return redirect()
        ->route('user_profile.index')
        ->with('success', 'Profile berhasil diperbarui.');
}
}
