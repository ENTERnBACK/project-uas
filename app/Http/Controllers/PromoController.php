<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

class PromoController extends Controller
{
    private function getDummyPromos()
    {
        return collect([
            (object) [
                'code' => 'HEMAT10',
                'name' => 'Diskon 10%',
                'description' => 'Diskon 10% dengan maksimal potongan Rp 2.000',
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'max_discount' => 2000,
                'min_transaction' => 7000,
                'usage_limit' => 50,
                'calculateDiscount' => function($amount) {
                    if ($amount < 7000) return 0;
                    $discount = $amount * 0.10;
                    return min($discount, 2000);
                }
            ],
            (object) [
                'code' => 'RIDEAJA',
                'name' => 'Diskon Rp 2.000',
                'description' => 'Potongan Rp 2.000 untuk setiap transaksi',
                'discount_type' => 'fixed',
                'discount_value' => 2000,
                'min_transaction' => 10000,
                'usage_limit' => 30,
                'calculateDiscount' => function($amount) {
                    if ($amount < 10000) return 0;
                    return min(2000, $amount);
                }
            ],
            (object) [
                'code' => 'NEWUSER',
                'name' => 'Diskon 15% User Baru',
                'description' => 'Diskon 15% untuk pengguna baru',
                'discount_type' => 'percentage',
                'discount_value' => 15,
                'max_discount' => 3000,
                'min_transaction' => 15000,
                'usage_limit' => 20,
                'calculateDiscount' => function($amount) {
                    if ($amount < 15000) return 0;
                    $discount = $amount * 0.15;
                    return min($discount, 3000);
                }
            ],
            (object) [
                'code' => 'SELALU50',
                'name' => 'Diskon 50%',
                'description' => 'Diskon 50% dengan maksimal potongan Rp 5.000',
                'discount_type' => 'percentage',
                'discount_value' => 50,
                'max_discount' => 5000,
                'min_transaction' => 15000,
                'usage_limit' => 10,
                'calculateDiscount' => function($amount) {
                    if ($amount < 15000) return 0;
                    $discount = $amount * 0.50;
                    return min($discount, 5000);
                }
            ],
            (object) [
                'code' => 'KAMPUS5',
                'name' => 'Gratis Ongkir Rp 5.000',
                'description' => 'Potongan Rp 5.000 untuk mahasiswa',
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'min_transaction' => 10000,
                'usage_limit' => 15,
                'calculateDiscount' => function($amount) {
                    if ($amount < 10000) return 0;
                    return min(5000, $amount);
                }
            ]
        ]);
    }

    public function index()
    {
        $promos = $this->getDummyPromos();
        return view('promos.index', compact('promos'));
    }

    public function userIndex()
    {
        $promos = $this->getDummyPromos();
        $tripId = session('current_trip_id', 1);
        return view('promos.user', compact('promos', 'tripId'));
    }

    public function applyPromo(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string',
            'base_price' => 'required|numeric|min:0'
        ]);

        $promoCode = strtoupper($request->promo_code);
        $basePrice = $request->base_price;
        $promos = $this->getDummyPromos();
        $promo = $promos->firstWhere('code', $promoCode);

        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Kode promo tidak valid'
            ]);
        }

        $calculateDiscount = $promo->calculateDiscount;
        $discountAmount = $calculateDiscount($basePrice);

        if ($discountAmount == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Kode promo tidak memenuhi syarat minimal transaksi Rp ' . number_format($promo->min_transaction, 0, ',', '.')
            ]);
        }

        session([
            'applied_promo' => $promoCode,
            'discount_amount' => $discountAmount
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Promo Berhasil Digunakan',
            'discount_amount' => $discountAmount,
            'promo_code' => $promoCode,
            'promo_name' => $promo->name,
            'redirect' => route('payments.user', session('current_trip_id', 1))
        ]);
    }

    public function removePromo()
    {
        session()->forget(['applied_promo', 'discount_amount']);

        return response()->json([
            'success' => true,
            'message' => 'Promo berhasil dihapus'
        ]);
    }

    public function validatePromo(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string',
            'base_price' => 'required|numeric|min:0'
        ]);

        $promoCode = strtoupper($request->promo_code);
        $basePrice = $request->base_price;
        $promos = $this->getDummyPromos();
        $promo = $promos->firstWhere('code', $promoCode);

        if (!$promo) {
            return response()->json([
                'valid' => false,
                'message' => 'Kode promo tidak valid'
            ]);
        }

        $calculateDiscount = $promo->calculateDiscount;
        $discountAmount = $calculateDiscount($basePrice);

        if ($discountAmount == 0) {
            return response()->json([
                'valid' => false,
                'message' => 'Kode promo tidak memenuhi syarat minimal transaksi Rp ' . number_format($promo->min_transaction, 0, ',', '.')
            ]);
        }

        return response()->json([
            'valid' => true,
            'message' => 'Kode promo valid!',
            'discount_amount' => $discountAmount,
            'promo_name' => $promo->name
        ]);
    }
}