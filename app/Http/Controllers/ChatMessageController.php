<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Trip;
use App\Models\Notification;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chats = ChatMessage::orderBy('created_at', 'desc')->get();
        return view('chats.index', compact('chats'));
    }

    public function destroy(ChatMessage $chatMessage)
    {
        $chatMessage->delete();
        return redirect()->route('chat-messages.index')->with('success', 'Riwayat chat berhasil dihapus.');
    }

    public function room(Trip $trip)
    {
        $messages = $trip->chatMessages()->orderBy('created_at', 'asc')->get();

        $loggedInUser = Auth::user();
        
        $current_role = ($trip->user_id === $loggedInUser->id) ? 'user' : 'driver';

        return view('chats.room', compact('trip', 'messages', 'current_role'));
    }

    public function storeMessage(Request $request, Trip $trip)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $loggedInUser = Auth::user();
        $current_role = ($trip->user_id === $loggedInUser->id) ? 'user' : 'driver';

        $chat = $trip->chatMessages()->create([
            'sender_type' => $current_role,
            'sender_id'   => $loggedInUser->id,
            'message'     => $request->message,
        ]);

        if ($current_role === 'driver') {
            Notification::create([
                'notifiable_type' => User::class,
                'notifiable_id'   => $trip->user_id,
                'title'           => 'Pesan Baru dari Driver 💬',
                'message'         => $chat->message,
                'is_read'         => false,
            ]);
        } else {
            if ($trip->driver_id) {
                Notification::create([
                    'notifiable_type' => Driver::class,
                    'notifiable_id'   => $trip->driver_id,
                    'title'           => 'Pesan Baru dari Penumpang 💬',
                    'message'         => $chat->message,
                    'is_read'         => false,
                ]);
            }
        }

        return back();
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


}
