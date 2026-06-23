<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Trip;
use Illuminate\Http\Request;

class PaymentController extends Controller
{       
    public function userPayment($tripId)
    {
        $trip = Trip::findOrFail($tripId);
        
        session(['current_trip_id' => $tripId]);
        
        $selectedService = request()->service ?? session('selected_service', 'standar');
        $basePrice = ['hemat' => 7000, 'standar' => 10000, 'comfort' => 15000][$selectedService];
        
        session([
            'selected_service' => $selectedService,
            'base_price' => $basePrice
        ]);

        $passengerName = auth()->user()->name ?? 'Guest';
        $selectedPaymentMethod = 'cash';

        $discountAmount = session('discount_amount', 0);
        $appliedPromo = session('applied_promo', null);

        if ($appliedPromo && $discountAmount > 0) {
            $promos = $this->getDummyPromos();
            $promo = $promos->firstWhere('code', $appliedPromo);

            if ($promo) {
                $calculateDiscount = $promo->calculateDiscount;
                $newDiscount = $calculateDiscount($basePrice);

                if ($newDiscount == 0) {
                    session()->forget(['discount_amount', 'applied_promo']);
                    $discountAmount = 0;
                    $appliedPromo = null;
                } else {
                    $discountAmount = $newDiscount;
                    session(['discount_amount' => $newDiscount]);
                }
            }
        }

        return view('payments.user', compact('trip', 'passengerName', 'discountAmount', 'appliedPromo', 'selectedService', 'basePrice', 'selectedPaymentMethod'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'payment_method' => 'required|string',
            'tip_amount' => 'nullable|numeric|min:0',
        ]);

        $trip = Trip::findOrFail($request->trip_id);

        $basePrices = [
            'hemat' => 7000,
            'standar' => 10000,
            'comfort' => 15000
        ];

        $selectedService = session('selected_service', 'standar');
        $basePrice = $basePrices[$selectedService];
        $tip = $request->tip_amount ?? 0;
        $discount = session('discount_amount', 0);

        if (session('applied_promo')) {
            $promoCode = session('applied_promo');
            $promo = $this->getDummyPromos()->firstWhere('code', $promoCode);

            if ($promo) {
                $calculateDiscount = $promo->calculateDiscount;
                $discount = $calculateDiscount($basePrice);

                if ($discount == 0) {
                    session()->forget(['discount_amount', 'applied_promo']);
                }
            }
        }

        $total = $basePrice + $tip - $discount;

        $payment = Payment::create([
            'trip_id' => $request->trip_id,
            'passenger_id' => auth()->id(),
            'passenger_name' => $trip->passenger_name ?? auth()->user()->name ?? 'Guest',
            'total_amount' => $total,
            'tip_amount' => $tip,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        session()->forget(['discount_amount', 'applied_promo', 'selected_service', 'base_price', 'current_trip_id']);

        return redirect()->route('driver-locations.index')->with('success', 'Payment successful! Silakan Pilih Driver');
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'passenger_name' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
            'tip_amount' => 'nullable|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        $payment = Payment::create([
            'driver_id' => $request->driver_id,
            'passenger_id' => auth()->id(),
            'passenger_name' => $request->passenger_name,
            'total_amount' => $request->total_amount,
            'tip_amount' => $request->tip_amount ?? 0,
            'payment_method' => $request->payment_method,
            'status' => 'completed',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment data saved successfully',
            'data' => $payment
        ], 201);
    }

    private function getDummyPromos()
    {
        return collect([
            (object) [
                'code' => 'HEMAT10',
                'name' => 'Diskon 10%',
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'max_discount' => 2000,
                'min_transaction' => 10000,
                'calculateDiscount' => function($amount) {
                    if ($amount < 10000) return 0;
                    $discount = $amount * 0.10;
                    return min($discount, 2000);
                }
            ],
            (object) [
                'code' => 'RIDEAJA',
                'name' => 'Diskon Rp 2.000',
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'min_transaction' => 10000,
                'calculateDiscount' => function($amount) {
                    if ($amount < 10000) return 0;
                    return min(2000, $amount);
                }
            ],
            (object) [
                'code' => 'NEWUSER',
                'name' => 'Diskon 15% User Baru',
                'discount_type' => 'percentage',
                'discount_value' => 15,
                'max_discount' => 3000,
                'min_transaction' => 15000,
                'calculateDiscount' => function($amount) {
                    if ($amount < 15000) return 0;
                    $discount = $amount * 0.15;
                    return min($discount, 3000);
                }
            ],
            (object) [
                'code' => 'SELALU50',
                'name' => 'DISKON 50% TIAP HARI',
                'discount_type' => 'percentage',
                'discount_value' => 50,
                'max_discount' => 5000,
                'min_transaction' => 15000,
                'calculateDiscount' => function($amount) {
                    if ($amount < 15000) return 0;
                    $discount = $amount * 0.50;
                    return min($discount, 5000);
                }
            ],
            (object) [
                'code' => 'GRATIS5',
                'name' => 'Gratis Ongkir Rp 5.000',
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'min_transaction' => 10000,
                'calculateDiscount' => function($amount) {
                    if ($amount < 10000) return 0;
                    return min(5000, $amount);
                }
            ]
        ]);
    }

        public function index()
    {
        $payments = Payment::where('passenger_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalEarnings = Payment::where('passenger_id', auth()->id())
            ->where('status', 'completed')
            ->sum('total_amount');

        return view('payments.index', compact('payments', 'totalEarnings'));
    }

    public function show($id)
    {
        $payment = Payment::where('passenger_id', auth()->id())
            ->findOrFail($id);

        return view('payments.invoice', compact('payment'));
    }

}