<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductController extends Controller
{
    //For showing all products in the page
    public function index(){
        $user = Auth::user();
        $products = Product::all();

        if ($user){
            $userCarts = $user->carts;
            foreach ($products as $product) {
                foreach ($userCarts as $cart) {
                    if ($cart->product_id == $product->id) {
                        $product->count = $cart->count;
                    }else{
                        $product->count = 0;
                    }
                }
            }
        }
        else{
            foreach ($products as $product) {
                $product->count = -1;
            }
        }
        return Inertia::render('Landing', compact('products'));
    }

    //For Showing a product with a specific ID
    public function show($id){
        $user = Auth::user();
        $product = Product::findOrFail($id);
        $product_Count_In_Cart = $user->carts()->where('product_id', $product->id)->first()->count;
        $submittedContent = [
            'product_count' => $product_Count_In_Cart,
            'product' => $product,
        ];
        return Inertia::render('Product', compact('submittedContent'));
    }
}
