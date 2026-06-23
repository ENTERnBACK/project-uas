<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::latest()->get();
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'review_driver' => 'nullable|string',
            'trip_id' => 'required|exists:trips,id',
        ]);

        $trip = \App\Models\Trip::findOrFail($request->trip_id);
        Review::create([
            'trip_id'       => $trip->id,
            'driver_id'     => $trip->driver_id,
            'rating'        => $request->rating,
            'review_driver' => $request->review_driver,
        ]);

        if ($request->status === 'completed') 
        {
            Notification::push(User::class, $trip->user_id, 'Perjalanan Selesai ✅', 'Kamu telah sampai di tujuan.');
        } 
        elseif ($request->status === 'cancelled') 
        {
            Notification::push(User::class, $trip->user_id, 'Order Dibatalkan ❌', 'Perjalananmu telah dibatalkan.');
        }

        return redirect()->route('/trips')->with('success', 'Review created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
        'rating' => 'nullable|integer|min:1|max:5',
        'review_driver' => 'nullable|string',
        ]);

        $review->update($request->only('rating', 'review_driver'));

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}
