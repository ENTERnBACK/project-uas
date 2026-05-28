<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Trip;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('trip')->latest()->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $trips = Trip::where('status', 'completed')->get();
        return view('payments.create', compact('trips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'passenger_id' => 'required|string',
            'passenger_name' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
            'tip_amount' => 'nullable|numeric|min:0',
        ]);

        $existingPayment = Payment::where('trip_id', $request->trip_id)->first();

        if ($existingPayment) {
            return redirect()->back()->withErrors([
                'trip_id' => 'Payment already exists for this trip'
            ])->withInput();
        }

        $payment = Payment::create([
            'trip_id' => $request->trip_id,
            'passenger_id' => $request->passenger_id,
            'passenger_name' => $request->passenger_name,
            'total_amount' => $request->total_amount,
            'tip_amount' => $request->tip_amount ?? 0,
            'status' => 'pending',
        ]);

        return redirect()->route('payments.show', $payment)
            ->with('success', 'Payment created successfully.');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $data = [
            'status' => $request->status
        ];

        if ($request->status === 'paid') {
            $data['payment_time'] = now();
        }

        $payment->update($data);

        return redirect()->route('payments.index')
            ->with('success', 'Payment status updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully.');
    }

    public function markAsPaid(Payment $payment)
    {
        $payment->update([
            'status' => 'paid',
            'payment_time' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Payment marked as paid successfully.');
    }

    public function getByPassenger($passengerId)
    {
        $payments = Payment::byPassenger($passengerId)
            ->with('trip')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $payments
        ]);
    }

    public function getByTrip($tripId)
    {
        $payment = Payment::where('trip_id', $tripId)->first();

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found for this trip'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $payment
        ]);
    }
}