<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethods;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentMethods = \App\Models\PaymentMethods::all();
        
        return view('payment_method.index', compact('paymentMethods')); 

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    
    $request->validate([
        'method' => 'required',
        'trip_id' => 'required',
    ]);

  
    \App\Models\PaymentMethods::create([
        'method' => $request->method,
        'trip_id' => $request->trip_id,
        'status' => 'pending'
    ]);

   $va_number = ($request->method === 'bca') ? '8808' . mt_rand(10000000, 99999999) : null;
    return back()->with([
        'success' => 'Pembayaran Anda Berhasil ' . $request->trip_id,
        'va_number' => $va_number
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        //
    }
}