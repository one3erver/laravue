<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();

        Invoice::factory()->count(3)->make()->each(function ($invoice) use ($orders) {
            $invoice->order_id = $orders->random()->id;
            $invoice->save();
        });
    }
}
