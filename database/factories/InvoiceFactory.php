<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'transaction_id' => $this->faker->unique()->uuid,
            'status' => $this->faker->randomElement(['P', 'F', 'C']), // Paid, Failed, Cancelled
            'paid_at' => $this->faker->date()
        ];
    }
}
