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


        $orderController = new OrderController();
        $orderController->update($invoice->order);

        // Send a message to Telegram
        $telegram = new Telegram();
        $message = "Payment Successful\n\nEmail: {$invoice->order->user->email}\nName: {$invoice->order->user->email}\n\nTransaction ID: {$transaction_id}\nTracking Code: {$invoice->order->tracking_code}\n\nTotal Cost: {$invoice->order->total_cost}";
        $telegram->sendMessage($message);
    }
}
