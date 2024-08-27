<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $orderList = json_decode($order->order_list);
        if (isset($orderList->products)) {
            foreach ($orderList->products as $product) {
                $productModel = Product::find($product->id);
                if ($productModel) {
                    if ($productModel->stock != -1) {
                        $productModel->stock += $product->count;
                        $productModel->save();
                    }
                }
            }
        }
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Orders deleted successfully.');
    }

    public function deleteUnpaid()
    {
        $unpaidOrders = Order::whereHas('invoice', function ($query) {
                $query->where('status', 'U');
            })->get();

        foreach ($unpaidOrders as $order) {
            $orderList = json_decode($order->order_list);
            if (isset($orderList->products)) {
                foreach ($orderList->products as $product) {
                    $productModel = Product::find($product->id);
                    if ($productModel) {
                        if ($productModel->stock != -1) {
                            $productModel->stock += $product->count;
                            $productModel->save();
                        }
                    }
                }
            }
        }

        Order::whereHas('invoice', function ($query) {
                $query->where('status', 'U');
            })->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Unpaid orders deleted successfully.');
    }
}
