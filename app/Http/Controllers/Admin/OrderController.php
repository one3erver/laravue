<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Orders deleted successfully.');
    }

    public function deleteUnpaid()
    {
        $deletedOrders = Order::whereHas('invoice', function ($query) {
            $query->where('status', 'U');
        })->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Unpaid orders deleted successfully.');
    }
}
