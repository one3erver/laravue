<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'price' => $this->faker->numberBetween(100, 10000),
            'caption' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            'status' => 1,
            'stock' => $this->faker->numberBetween(0, 100)
        ];
    }
}
