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
        $submittedContent = [
            'invoice_id' => $invoice['id'],
            'order_list' =>json_decode($invoice->order->order_list),
        ];
        if (session('redirect')){
            session()->forget('redirect');
            $submittedContent['wallet_id'] = $invoice->wallet_id;
            return view('test_1', compact('submittedContent'));
            return Inertia::render('Checkout', $submittedContent);
        }
        else{
//          Specify the Wallet by its key
            $wallets = config('wallets');
            $wallet_id = $wallets[$invoice->wallet_id];
            $submittedContent['wallet_id'] = $wallet_id;

            return view('test_1', compact('submittedContent'));
            return Inertia::render('Checkout', $submittedContent);
        }
    }

    public function checkoutValidate(Request $request)
    {
        $invoice = Invoice::find($request->input('invoice_id'));
        $transaction_id = $request->input('transaction_id');

        $existingTransaction = Invoice::where('transaction_id', $transaction_id)->first();
        if ($existingTransaction) {
            session(['redirect' => true]);
            return to_route('checkouts.show')->with([
                'error' => 'The entered transaction_id has already been entered by someone else. Please be careful.',
                'hint' => 'If you think there is a problem, contact us by email.'
            ]);
        }

        $response = json_decode(Http::get('https://apilist.tronscan.org/api/new/token_trc20/transfers', [
            'direction' => 'in',
            'count' => 5,
            'tokens' => 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
            'relatedAddress' => 'TCN6S5TfAPYf6aWbSgotEfsmNWgoDwa1Gm'
        ]));

//      Search in the api to match the TransactionID and Transferred Tether with transactions
        $totalCost = $invoice->order->total_cost;
        foreach ($response->token_transfers as $transaction) {
            if ($transaction->transaction_id == $transaction_id) {
                if (($transaction->quant/1000000) >= $totalCost){
//                  If validation is correct, add TrackingCode and TransactionID to DB
                    $invoiceController = new InvoiceController();
                    $invoiceController->update($invoice, $transaction_id);
//                  Set the success session for middleware then redirect the User to a successful page
                    session(['payment_successful' => true]);
                    return to_route('checkouts.success');
                }
                else{
                    session(['redirect' => true]);
                    return to_route('checkouts.show')->with([
                        'error' => 'Tether transferred is lower than your order price. Please pay the order amount in full.',
                        'hint' => 'To track the Tether amount already transferred, contact us via email.'
                    ]);
                }
            }
            else{

            }
        }
    }

    protected function success()
    {
        return Inertia::render('Payment_success');
    }

}
