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
   $payment = \App\Models\PaymentMethods::create([
        'method' => $request->method, 
        'trip_id' => $request->trip_id,
        'status' => 'pending'
    ]);

    // Redirect
    return redirect()->route('payment-methods.show', $payment->trip_id);

}
    

    /**
     * Display the specified resource.
     */

   public function show($id)
{
   $payment = \App\Models\PaymentMethods::where('trip_id', $id)->firstOrFail();
    return view('payment_method.show', compact('payment'));
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