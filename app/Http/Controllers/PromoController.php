<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function userIndex()
    {
        $promos = $this->getDummyPromos();
        return view('promos.user', compact('promos'));
    }

    public function applyPromo(Request $request)
    {
        $code = $request->promo_code;

        $promos = $this->getDummyPromos();
        $promo = $promos->firstWhere('code', $code);

        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Kode promo tidak ditemukan'
            ]);
        }

        $selectedService = session('selected_service', 'standar');

        $basePrices = [
            'hemat' => 7000,
            'standar' => 10000,
            'comfort' => 15000
        ];

        $basePrice = $basePrices[$selectedService];

        $calculateDiscount = $promo->calculateDiscount;
        $discount = $calculateDiscount($basePrice);

        session([
            'applied_promo' => $promo->code,
            'discount_amount' => $discount
        ]);

        return response()->json([
            'success' => true,
            'message' => "Promo berhasil! Diskon Rp " . number_format($discount, 0, ',', '.'),
            'discount' => $discount,
            'redirect' => route('payments.user', session('current_trip_id', 1))
        ]);
    }

    public function validatePromo(Request $request)
    {
        $code = $request->promo_code;
        $basePrice = $request->base_price ?? 10000;

        $promos = $this->getDummyPromos();
        $promo = $promos->firstWhere('code', $code);

        if (!$promo) {
            return response()->json([
                'valid' => false
            ]);
        }

        $calculateDiscount = $promo->calculateDiscount;
        $discount = $calculateDiscount($basePrice);

        return response()->json([
            'valid' => true,
            'discount' => $discount
        ]);
    }

    private function getDummyPromos()
    {
        return collect([
            (object) [
                'code' => 'HEMAT10',
                'name' => 'Diskon 10%',
                'description' => 'Potongan 10% hingga Rp 2.000',
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'max_discount' => 2000,
                'calculateDiscount' => function($amount) {
                    $discount = $amount * 0.10;
                    return min($discount, 2000);
                }
            ],
            (object) [
                'code' => 'RIDEAJA',
                'name' => 'Diskon Rp 2.000',
                'description' => 'Potongan langsung Rp 2.000',
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'calculateDiscount' => function($amount) {
                    return min(2000, $amount);
                }
            ],
            (object) [
                'code' => 'NEWUSER',
                'name' => 'Diskon 15% User Baru',
                'description' => 'Potongan 15% hingga Rp 3.000',
                'discount_type' => 'percentage',
                'discount_value' => 15,
                'max_discount' => 3000,
                'calculateDiscount' => function($amount) {
                    $discount = $amount * 0.15;
                    return min($discount, 3000);
                }
            ],
            (object) [
                'code' => 'SELALU50',
                'name' => 'DISKON 50% TIAP HARI',
                'description' => 'Potongan 50% hingga Rp 5.000',
                'discount_type' => 'percentage',
                'discount_value' => 50,
                'max_discount' => 5000,
                'calculateDiscount' => function($amount) {
                    $discount = $amount * 0.50;
                    return min($discount, 5000);
                }
            ],
            (object) [
                'code' => 'GRATIS5',
                'name' => 'Gratis Ongkir Rp 5.000',
                'description' => 'Potongan langsung Rp 5.000',
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'calculateDiscount' => function($amount) {
                    return min(5000, $amount);
                }
            ]
        ]);
    }
}