<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Cart;
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
        $orders = json_decode($user->orders->pluck('order_list'));
        $ordersList = array_map('json_decode', $orders);
        return inertia('Orders', compact('ordersList'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $cartsList = json_decode($request->post('cartsList'), true);
        $productIds = array_column($cartsList, 'product_id');

//      Finding the price and title of each product using the product ID
        $products = DB::table('products')->whereIn('id', $productIds)
            ->select('id', 'price', 'title')
            ->get()
            ->keyBy('id');

        $totalCost = 0;
//      Calculating the total cost and adding the count of each product from cart
        foreach ($cartsList as $cart) {
            $price = $products->get($cart['product_id'])->price;
            $totalCost += $price * $cart['count'];

            $products->get($cart['product_id'])->count = $cart['count'];


            $cart_to_delete =  $user->carts->where('product_id', $cart['product_id']);
            $cartController = new CartController();
            $cartController->destroy($cart_to_delete);
        }

        $products = array_values($products->toArray());
        $orderList = json_encode([
            'totalCost' => $totalCost,
            'products' => $products,
        ]);
        $trackingCode = Str::random(3).time().Str::random(3);
        $user->orders()->create([
            'total_cost' => $totalCost,
            'order_list' => $orderList,
            'tracking_code' => $trackingCode,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return inertia('Customer/Orders/Show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
