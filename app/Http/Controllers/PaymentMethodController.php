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
    
   $myMethods = \App\Models\PaymentMethods::where('user_id', auth()->id())->get(); // Ambil object-nya
    
    $allAvailableMethods = [
        ['slug' => 'bank', 'name' => 'Kartu kredit atau debit', 'desc' => 'Visa, Mastercard, AMEX, dan JCB'],
        ['slug' => 'linkjago', 'name' => 'Kantong Jago', 'desc' => 'Tambahkan kantongmu'],
    ];

    return view('payment_method.index', compact('myMethods', 'allAvailableMethods'));
    

    }

    /**
     * Show the form for creating a new resource.
     */
   
   public function create(Request $request)
{
    $type = $request->query('type'); 
    
    //if ($type === 'bank') {
       // return view('payment_method.create_bank');
   // } elseif ($type === 'linkjago') {
   //     return view('payment_method.create_linkjago');
   // }
    return view('payment_method.create');
   // return redirect()->route('payment_method.index');
}



    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    if ($request->has('action') && $request->action === 'select') {
        if ($request->payment_option === 'bank') {
            return redirect()->route('payment_method.create', ['type' => 'bank']);
        } elseif ($request->payment_option === 'linkjago') {
            return redirect()->route('payment_method.create', ['type' => 'linkjago']);
        }
        return redirect()->back();
    }
    
    PaymentMethods::create([
        'user_id' => auth()->id(),
        'method'  => $request->method, 
        'label'   => $request->bank_name ?? $request->account_name,
        'status'  => 'active'
       
    ]);

    return redirect()->route('payment_method.index');
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
        $payment = PaymentMethods::findOrFail($id);
    $payment->delete();
    return redirect()->back()->with('success', 'Metode dihapus!');
    }
}