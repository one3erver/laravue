<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        Order::factory()->count(30)->make()->each(function ($order) use ($users) {
            $order->user_id = $users->random()->id;
            $order->save();
        });
    }
}
