<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        Cart::factory()->count(3)->make()->each(function ($cart) use ($users, $products) {
            $cart->user_id = $users->random()->id;
            $cart->save();
        });
    }
}
