<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCartRequest;
use App\Http\Requests\Customer\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Auth::user()->carts;
        return inertia('Customer/Cart', compact('carts'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $user = Auth::user();
        $user->carts()->create($request->validated());

//        return ????
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $user = Auth::user();
        $existingCart = $user->carts()->where('id', $cart->id)->first();

        if ($existingCart) {
            $existingCart->update($request->validated());
//            return ????
        }
        else{
            return $this->store($request);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
//        return ????
    }
}
