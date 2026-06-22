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

    session([
    'selected_service' => session('selected_service', 'standar'),
    'base_price' => [
        'hemat' => 7000,
        'standar' => 10000,
        'comfort' => 15000
    ][session('selected_service', 'standar')]
]);

    $trip = Trip::findOrFail($tripId);
    $passengerName = auth()->user()->name ?? 'Guest';
    $paymentMethods = PaymentMethods::all();

    $selectedService = session('selected_service', 'standar');
    $basePrice = ['hemat' => 7000, 'standar' => 10000, 'comfort' => 15000][$selectedService];

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

    return view('payments.user', compact('trip', 'paymentMethods', 'passengerName', 'discountAmount', 'appliedPromo', 'selectedService'));
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

        if (session('applied_promo')) {

            $promoCode = session('applied_promo');

            $promo = $this->getDummyPromos()
                ->firstWhere('code', $promoCode);

            if ($promo) {

                $calculateDiscount = $promo->calculateDiscount;
                $discount = $calculateDiscount($basePrice);

                if ($discount == 0) {
                    session()->forget([
                        'discount_amount',
                        'applied_promo'
                    ]);
                }
            }
        }
        $total = $basePrice + $tip - $discount;

        $payment = Payment::create([
            'trip_id' => $request->trip_id,
            'passenger_name' => $trip->passenger_name ?? auth()->user()->name ?? 'Guest',
            'total_amount' => $total,
            'tip_amount' => $tip,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        session()->forget(['discount_amount', 'applied_promo']);

        return redirect()->route('reviews.create', ['paymentId' => $payment->id])
            ->with('success', 'Payment successful! Please leave a review.');
    }

    public function setService(Request $request)
{
    $basePrices = [
        'hemat' => 7000,
        'standar' => 10000,
        'comfort' => 15000
    ];

    session([
        'selected_service' => $request->service_type,
        'base_price' => $basePrices[$request->service_type]
    ]);

    return response()->json([
        'success' => true
    ]);
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
}