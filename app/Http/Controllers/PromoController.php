<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
 
    public function index()
    {
        $promos = Promo::latest()->paginate(10);
        return view('promos.index', compact('promos'));
    }

    public function create()
    {
        return view('promos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:promos,code|max:50',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'min_transaction' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'status' => 'required|in:active,expired,disabled',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after:valid_from',
        ]);

        Promo::create($request->all());

        return redirect()->route('promos.index')
            ->with('success', 'Promo created successfully.');
    }

    public function show(Promo $promo)
    {

        $isValid = $promo->isValid();
        return view('promos.show', compact('promo', 'isValid'));
    }

    public function edit(Promo $promo)
    {
        return view('promos.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'min_transaction' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'status' => 'required|in:active,expired,disabled',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date',
        ]);

        $promo->update($request->all());

        return redirect()->route('promos.index')
            ->with('success', 'Promo updated successfully.');
    }
  
    public function destroy(Promo $promo)
    {
        $promo->delete();

        return redirect()->route('promos.index')
            ->with('success', 'Promo deleted successfully.');
    }


    public function validatePromo($code, Request $request)
    {
        $amount = $request->query('amount', 0);
        
        $promo = Promo::where('code', $code)->first();
        
        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Promo code not found'
            ], 404);
        }

        if (!$promo->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'Promo code is not valid or expired'
            ], 422);
        }

        $discountAmount = $promo->calculateDiscount($amount);
 
       if ($amount < $promo->min_transaction) {
           return response()->json([
           'success' => false,
           'message' => 'Transaction amount does not meet minimum requirement'
          ], 422);
       } 

        return response()->json([
            'success' => true,
            'message' => 'Promo code is valid',
            'data' => [
                'id' => $promo->id,
                'code' => $promo->code,
                'name' => $promo->name,
                'discount_type' => $promo->discount_type,
                'discount_value' => $promo->discount_value,
                'discount_amount' => $discountAmount,
                'min_transaction' => $promo->min_transaction,
            ]
        ]);
    }

    public function getActivePromos()
    {
        $promos = Promo::active()->get();
  
        $validPromos = $promos->filter(function ($promo) {
            return $promo->isValid();
        })->values();

        return response()->json([
            'success' => true,
            'count' => $validPromos->count(),
            'data' => $validPromos
        ]);
    }
}