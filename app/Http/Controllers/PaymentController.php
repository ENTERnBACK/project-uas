<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Trip;
use App\Models\PaymentMethods;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function userPayment($tripId)
    {
        session(['current_trip_id' => $tripId]);

        $trip = Trip::findOrFail($tripId);
        $passengerName = auth()->user()->name ?? 'Guest';
        $paymentMethods = PaymentMethods::all();

        return view('payments.user', compact('trip', 'paymentMethods', 'passengerName'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'service_type' => 'required|in:hemat,standar,comfort',
            'payment_method' => 'required|string',
            'tip_amount' => 'nullable|numeric|min:0',
        ]);

        $trip = Trip::findOrFail($request->trip_id);

        $basePrices = [
            'hemat' => 7000,
            'standar' => 10000,
            'comfort' => 15000
        ];

        $basePrice = $basePrices[$request->service_type];
        $tip = $request->tip_amount ?? 0;
        $discount = session('discount_amount', 0);
        $total = $basePrice + $tip - $discount;

        $payment = Payment::create([
            'trip_id' => $request->trip_id,
            'passenger_name' => $trip->passenger_name ?? 'Guest',
            'total_amount' => $total,
            'tip_amount' => $tip,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        session()->forget(['discount_amount', 'applied_promo']);

        return redirect()->route('payments.show', $payment->id)
            ->with('success', 'Payment created successfully!');
    }
}