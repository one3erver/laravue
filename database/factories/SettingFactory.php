<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'telegram_id' => $this->faker->unique()->regexify('[A-Za-z0-9]{10}'),
            'telegram_token' => $this->faker->unique()->regexify('[A-Za-z0-9]{10}'),
            'landing_content' => $this->faker->sentence,
            'logo' => $this->faker->imageUrl(),
            'site_title' => $this->faker->company,
        ];
    }
}
