<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Trip;
use App\Models\Notification;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chats = ChatMessage::all();
        return view('chats.index', compact('chats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('chats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|integer|exists:trips,id',
            'sender_type' => 'required|string|in:user,driver',
            'sender_id' => 'required|integer',
            'message' => 'required|string',
        ]);

        $chat = ChatMessage::create($request->all());

        $trip = Trip::find($chat->trip_id);

        if ($trip) {
            if ($chat->sender_type === 'driver') {
                Notification::create([
                    'notifiable_type' => User::class,
                    'notifiable_id'   => $trip->user_id,
                    'title'           => 'Driver mengirim pesan baru 💬',
                    'message'         => $chat->message,
                    'is_read'         => false,
                ]);
            }
            elseif ($chat->sender_type === 'user') {
                Notification::create([
                    'notifiable_type' => Driver::class,
                    'notifiable_id'   => $trip->driver_id,
                    'title'           => 'Penumpang mengirim pesan baru 💬',
                    'message'         => $chat->message,
                    'is_read'         => false,
                ]);
            }
        }

        return back()->with('success', 'Pesan terkirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ChatMessage $chatMessage)
    {
        return view('chats.show', compact('chatMessage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChatMessage $chatMessage)
    {
        return view('chats.edit', compact('chatMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChatMessage $chatMessage)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $chatMessage->update($request->only('message'));
        return redirect()->route('chat-messages.index')->with('success', 'Chat updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatMessage $chatMessage)
    {
        $chatMessage->delete();
        return redirect()->route('chat-messages.index')->with('success', 'Chat deleted successfully.');
    }
}
