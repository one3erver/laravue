<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $cart_list = $user->carts;
        $productIds = $cart_list->pluck('product_id')->toArray();
        $products = DB::table('products')->whereIn('id', $productIds)
            ->get(['id', 'price', 'title', 'image', 'image_thumbnail']);

        $totalCost = 0;
        foreach ($products as $product ) {
            $count = $cart_list->where('product_id', $product->id)->first()->count;
            $product->count = $count;
            $price = $product->price;
            $totalCost += $count*$price;
        }
        $submittedContent = [
            'totalCost' => $totalCost,
            'products' => $products
        ];

        return inertia('Cart', compact('submittedContent'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $cart_list = json_decode($request->post('cart_list'), true);
        $productIds = array_column($cart_list, 'id');
        $deletedCarts = $user->carts()->whereNotIn('product_id', $productIds)->get()->keyBy('product_id');
        $this->destroy($deletedCarts);

        $existingCarts = $user->carts()->whereIn('product_id', $productIds)->get()->keyBy('product_id');
        foreach ($cart_list as $cart) {
            $existingCart = $existingCarts->get($cart['id']);

            if (!$existingCart) {
                $user->carts()->create([
                    'product_id' => $cart['id'],
                    'count' => $cart['count'],
                ]);
            } else {
                $this->update($cart, $existingCart);
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
    public function destroy($cart)
    {
        if ($cart instanceof Collection) {
            foreach ($cart as $item) {
                $item->delete();
            }
        } else {
            $cart->delete();
        }
        return redirect()->intended();
    }
}
