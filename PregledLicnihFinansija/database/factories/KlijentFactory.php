<?php

namespace Database\Factories;

use App\Models\Klijent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Klijent>
 */
class KlijentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'net_worth' => 0,
            'premium_klijent' => false,
            'preferred_currency' => 'RSD',
        ];
    }

    public function premium(): static
    {
        return $this->state(fn (array $attributes) => [
            'premium_klijent' => true,
        ]);
    }
}