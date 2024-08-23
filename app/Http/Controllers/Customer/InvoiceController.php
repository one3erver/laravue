<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Order $order)
    {
        $user = Auth::user();
        $wallet = random_int(1,10);
        $order->invoice()->create([
            'status' => "U",
            'wallet_id' => $wallet
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        if ($invoice->status == "U"){
            return view('test_1', compact('invoice'));
        }
        else{
            return to_route('orders.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($transaction_id, Invoice $invoice)
    {
        $response = json_decode(Http::get('https://apilist.tronscan.org/api/new/token_trc20/transfers', [
            'direction' => 'in',
            'count' => 5,
            'tokens' => 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
            'relatedAddress' => 'TCN6S5TfAPYf6aWbSgotEfsmNWgoDwa1Gm'
        ]));

        $totalCost = $invoice->order->total_cost;
        foreach ($response->token_transfers as $transaction) {
            if ($transaction->transaction_id == $transaction_id && $totalCost == ($transaction->quant/1000000)) {
                $invoice->update([
                    'status' => 'P',
                    'paid_at' => now(),
                ]);
                return true;
            }
            else{
                return false;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
