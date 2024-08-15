<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Auth::user()->carts()->get();
        return inertia('Cart', compact('carts'));

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $products = $request->input('products');
        $productIds = array_column($products, 'id');
        $existingCarts = $user->carts()->whereIn('product_id', $productIds)->get()->keyBy('product_id');

        foreach ($products as $product) {
            $existingCart = $existingCarts->get($product['id']);

            if (!$existingCart) {
                $user->carts()->create([
                    'product_id' => $product['id'],
                    'count' => $product['count'],
                ]);
            } else {
                $this->update($product, $existingCart);
            }
        }

        return redirect()->back();
    }

    /**
     * Update the specified cart's count.
     */
    protected function update(array $product, Cart $cart)
    {
        $cart->update([
            'count' => $product['count'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->back();
    }
}
