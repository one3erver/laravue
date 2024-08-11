<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add($productId){
        if(!Auth::check()){
            return redirect()->route('login');
        }
        else{
            $userId = Auth::id();

            //Finding the Cart belonging to the user with a specific id
            $cart = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

            //If a Cart with a specific userId and productId found, increase its counter by one number
            //else make a Cart with that userId and productId
            if ($cart){
                $cart->update(['count' => $cart->count + 1]);
            }
            else{
                $cart = new Cart();
                $cart->user_id = $userId;
                $cart->product_id = $productId;
                $cart->save();
            }

            return redirect()->back();
        }
    }
}
