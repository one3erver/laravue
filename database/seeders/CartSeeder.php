<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        Cart::factory()->count(10)->make()->each(function ($cart) use ($users, $products) {
            do {
                $cart->user_id = $users->random()->id;
                $cart->product_id = $products->random()->id;

                // Check if a cart with the same user_id and product_id already exists
                $exists = Cart::where('user_id', $cart->user_id)->where('product_id', $cart->product_id)->exists();
            } while ($exists);

            $cart->save();
        });
    }
}
