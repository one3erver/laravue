<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductController extends Controller
{
    //For showing all products in the page
    public function index()
    {
        $user = Auth::user();
        $products = Product::all()->where("status", 1)->Where("stock", "!=", "0")->values();
//      If the user is logged in, the count of each product in the cart is stored in Count,
//      but if the user is not logged in, the value -1 is sent in Count.
        if ($user) {
            $userCarts = $user->carts->keyBy('product_id');
            foreach ($products as $product) {
                $product->count = $userCarts->has($product->id) ? $userCarts[$product->id]->count : 0;
            }
        } else {
            foreach ($products as $product) {
                $product->count = -1;
            }
        }
        return Inertia::render('Landing', compact('products'));
    }

//For Showing a product with a specific ID
    public function show($id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        if ($user) {
            $userCart = $user->carts->where('product_id', $product->id)->first();
            $product->count = $userCart ? $userCart->count : 0;
        } else {
            $product->count = -1;
        }

        return Inertia::render('Product', compact('product'));
    }

    public function update($cart_list)
    {
        foreach ($cart_list as $cart) {
            $product = Product::find($cart['product_id']);
            if ($product->count >= 1){
                $newStock = $product->stock - $cart['count'];
                $product->update(['stock' => $newStock]);
            }
        }
    }
}
