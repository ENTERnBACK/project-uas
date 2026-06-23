<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loggedInUser = auth()->user();

        $notifications = \App\Models\Notification::where('notifiable_type', get_class($loggedInUser))
                    ->where('notifiable_id', $loggedInUser->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'notifiable_type' => 'required|string',
        'notifiable_id'   => 'required|integer',
        'title'           => 'required|string',
        'message'         => 'required|string',
        ]);

        \App\Models\Notification::create($request->all());

        return back()->with('success', 'Notifikasi berhasil ditembakkan ke target!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        return view('notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        return view('notifications.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'is_read' => 'required|boolean',
        ]);

        $notification->update($request->all());
        return redirect()->route('notifications.index')->with('success', 'Notification updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification deleted.');
    }
}
