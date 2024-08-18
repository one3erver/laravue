<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Auth::user()->orders;
        return inertia('Customer/Orders/Index', compact('orders'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart_list = json_decode($request->post('cart_list'), true);
        $productIds = array_column($cart_list, 'product_id');

        $products = DB::table('products')->whereIn('id', $productIds)->pluck('price', 'id');

        $totalCost = 0;
        foreach ($cart_list as $cart) {
            $price = $products->get($cart['product_id'], 0);
            $totalCost += $price * $cart['count'];
        }
        return $totalCost;
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
