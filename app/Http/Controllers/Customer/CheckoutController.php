<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use function Symfony\Component\Translation\t;

class CheckoutController extends Controller
{
    public function show()
    {
//      Get the Invoice from the session then delete the session
        $invoice = session('invoice');
        $invoiceTime = session('invoice_time');

//      Checkout must be paid in less than 10 minutes, otherwise the session will be deleted
        if ($invoiceTime && now()->diffInSeconds($invoiceTime) > 600) {
            session()->forget(['invoice', 'invoice_time']);
        }

        if (!$invoice){
            return to_route('products.index');
        }

        $submittedContent = [
            'invoice_id' => $invoice['id'],
            'order_list' =>json_decode($invoice->order->order_list),
        ];

//      Specify the Wallet by its key
        $wallets = config('wallets');
        $wallet_id = $wallets[$invoice->wallet_id];
        $submittedContent['wallet_id'] = $wallet_id;

        if (session('existingTransaction')){
            session()->forget('existingTransaction');
            return Inertia::render('Checkout',  compact('submittedContent'));
        }
        else{
            return Inertia::render('Checkout', compact('submittedContent'));
        }
    }

    public function checkoutValidate(Request $request)
    {
        $invoice = Invoice::find($request->input('invoice_id'));
        $transaction_id = $request->input('transaction_id');

//      Check if entered transaction_id has already been entered by someone else, it will give an error message
        $existingTransaction = Invoice::where('transaction_id', $transaction_id)->first();
        if ($existingTransaction) {
            session(['existingTransaction' => true]);
            return to_route('checkouts.show')->withErrors([
                'error' => 'The entered transaction_id has already been entered by someone else. Please be careful.',
                'hint' => 'If you think there is a problem, contact us by email.'
            ]);
        }
        else{
            $response = json_decode(Http::get('https://apilist.tronscan.org/api/new/token_trc20/transfers', [
                'direction' => 'in',
                'count' => 5,
                'tokens' => 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
                'relatedAddress' => 'TCN6S5TfAPYf6aWbSgotEfsmNWgoDwa1Gm'
            ]));

//          Search in the api to match the TransactionID and Transferred Tether with transactions
            $totalCost = $invoice->order->total_cost;
            foreach ($response->token_transfers as $transaction) {
                if ($transaction->transaction_id == $transaction_id) {
                    if ($transaction->confirmed != true) {
                        return to_route('checkouts.show')->withErrors([
                            'error' => 'Your deposited Tether has not yet been deposited into the wallet, please check back in a few minutes',
                            'hint' => 'If you are sure of the correctness of the entered transaction, contact us by email.'
                        ]);
                    }
                    elseif (($transaction->quant/1000000) >= $totalCost){
//                      If validation is correct, add TrackingCode and TransactionID to DB
                        $invoiceController = new InvoiceController();
                        $invoiceController->update($invoice, $transaction_id);

//                      Set the success session for middleware then redirect the User to a successful page
                        session(['payment_successful' => true]);

//                      Set the session for order to show the order's details in Success page
                        session(['order' => $invoice->order]);

//                      Due to the successful payment, delete the Invoice session
                        session()->forget('invoice');

                        return to_route('checkouts.success');
                    }
                    else{
                        return to_route('checkouts.show')->withErrors([
                            'error' => 'Tether transferred is lower than your order price. Please pay the order amount in full.',
                            'hint' => 'To track the Tether amount already transferred, contact us via email.'
                        ]);
                    }
                }
            }
            return to_route('checkouts.show')->withErrors([
                'error' => 'The entered transaction ID does not exist in the list of transactions.',
                'hint' => 'If you are sure of the correctness of the entered transaction, check again in a few minutes'
            ]);
        }
    }

    protected function success()
    {
        if (session('order')){
            $order = session('order');
            session()->forget('order');

            $submittedContent = [
                'order_list' =>json_decode($order->order_list),
                'tracking_code' => $order->tracking_code,
            ];
//          return 'payment success';
            return Inertia::render('SuccessPay', compact('submittedContent'));
        }
        else{
            return to_route('products.index');
        }
    }

    protected function unpaid(Request $request)
    {
        $order_id = $request->input('order_id');
        $invoice = Invoice::where ('order_id', $order_id)->first();
        session(['invoice' => $invoice, 'invoice_time' => now()]);
        return to_route('checkouts.show');
    }

}
