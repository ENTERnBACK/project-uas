<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $supportTickets = SupportTicket::all();

    return view(
        'support_tickets.index',
        compact('supportTickets')
    );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('support_tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'subject' => 'required',
        'description' => 'required',
    ]);

    SupportTicket::create([
        'user_id' => $request->user_id,
        'subject' => $request->subject,
        'description' => $request->description,
        'status' => 'open',
    ]);

    return redirect()
        ->route('support-tickets.index')
        ->with('success', 'Pengaduan berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SupportTicket $supportTicket)
    {
        return view('support_tickets.show', compact('supportTicket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupportTicket $supportTicket)
    {
        return view('support_tickets.edit', compact('supportTicket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupportTicket $supportTicket)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
        ]);

        $supportTicket->update([
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect('/support-tickets')
            ->with('success', 'Ticket berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupportTicket $supportTicket)
    {
        $supportTicket->delete();

        return redirect('/support-tickets')
            ->with('success', 'Ticket berhasil dihapus');
    }
}