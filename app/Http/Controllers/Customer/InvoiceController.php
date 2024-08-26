<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use App\Http\classes\Telegram;

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
        $walletCount = count(config('wallets'));
        $wallet = random_int(1,$walletCount);
        $order->invoice()->create([
            'status' => "U",
            'wallet_id' => $wallet
        ]);

        session(['invoice' => $order->invoice]);
        return to_route('checkouts.show');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Invoice $invoice, $transaction_id)
    {
        $invoice->update([
            'transaction_id' => $transaction_id,
            'status' => 'P',
            'paid_at' => now()
        ]);
        // Send a message to Telegram
        $telegram = new Telegram();
        $telegram->sendMessage("Payment Successful: Order ID {$invoice->order->id}, Transaction ID: {$transaction_id}");

        $orderController = new OrderController();
        $orderController->update($invoice->order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
