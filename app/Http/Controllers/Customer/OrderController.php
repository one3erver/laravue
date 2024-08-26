<?php

namespace App\Http\Controllers\Customer;

use App\Http\classes\Telegram;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders;
        $orderID = $orders->pluck('id')->toArray();
        $invoices = Invoice::whereIn('order_id', $orderID)->get();

        $submittedOrders = [];
        for ($i = 0; $i < count($orders); $i++) {
            $order = $orders[$i];
            $invoice = $invoices[$i];

            $order_list = json_decode($order->order_list, true);

            $submittedOrders[] = [
                "tracking_code" => $order->tracking_code,
                "payment" =>[
                    'status' => $invoice->status,
                    'paid_at' => $invoice->paid_at,
                    'transaction_id' => $invoice->transaction_id,
                ],
                "order_list" => $order_list,
            ];
        }
        return inertia('Orders', compact('submittedOrders'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $cartsList = json_decode($request->post('cartsList'), true);
        $productIds = array_column($cartsList, 'product_id');

//      Finding the Price and Title of each product using the products ID
        $products = DB::table('products')->whereIn('id', $productIds)
            ->select('id', 'price', 'title')
            ->get()
            ->keyBy('id');

        $totalCost = 0;
//      Calculating the TotalCost and adding the Count of each product from cart
        foreach ($cartsList as $cart) {
            $price = $products->get($cart['product_id'])->price;
            $totalCost += $price * $cart['count'];

//          Adding Count of each product to its own product in products json
            $products->get($cart['product_id'])->count = $cart['count'];

//          After saving the details of each Cart, send each Cart to destroy method to delete it
            $cart_to_delete =  $user->carts->where('product_id', $cart['product_id']);
            $cartController = new CartController();
            $cartController->destroy($cart_to_delete);
        }

//      Making order list
        $products = array_values($products->toArray());

        $orderList = json_encode([
            'products' => $products,
            'totalCost' => $totalCost,
        ]);

//      Saving data to DB
        $order = $user->orders()->create([
            'total_cost' => $totalCost,
            'order_list' => $orderList,
        ]);
        // Send a message to Telegram
        $telegram = new Telegram();
        $telegram->sendMessage("New Order Placed: User Name: {$order->user->name}, Order List {$orderList}, Total Cost: {$totalCost}");

//      After creating the Order, send the Order to [InvoiceController] to create an Invoice for it
        $invoiceController = new InvoiceController();
        return $invoiceController->store($order);
    }

    public function update(Order $order)
    {
//      Create the TrackingCode and put it in Order's tracking_code
        $tracking_code = "trc".time().str::random(3);
        $order->update([
            'tracking_code' => $tracking_code,
        ]);
    }
}
