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
        return redirect()->back()->with('error', 'Kode promo tidak ditemukan');
    }

    $usageCount = session('promo_usage_' . $code, 0);

    $promoBawah3k = ['HEMAT10', 'RIDEAJA', 'NEWUSER'];
    $promoPotongan5k = ['SELALU50', 'GRATIS5'];

    if (in_array($code, $promoBawah3k) && $usageCount >= 5) {
        return redirect()->back()->with('error', 'Promo sudah mencapai batas pemakaian (5x)');
    }

    if (in_array($code, $promoPotongan5k) && $usageCount >= 2) {
        return redirect()->back()->with('error', 'Promo sudah mencapai batas pemakaian (2x)');
    }

    $basePrice = session('base_price', 10000);
    $calculateDiscount = $promo->calculateDiscount;
    $discount = $calculateDiscount($basePrice);

    if ($discount == 0) {
        return redirect()->back()->with('error', 'Minimal transaksi belum terpenuhi');
    }

    session(['promo_usage_' . $code => $usageCount + 1]);

    session([
        'applied_promo' => $promo->code,
        'discount_amount' => $discount
    ]);

    $tripId = session('current_trip_id', 1);
    return redirect()->route('payments.user', $tripId)
        ->with('success', "Promo berhasil! Diskon Rp " . number_format($discount, 0, ',', '.'));
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