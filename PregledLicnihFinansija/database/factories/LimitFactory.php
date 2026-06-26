<?php

namespace Database\Factories;

use App\Models\Kategorija;
use App\Models\Klijent;
use App\Models\Limit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Limit>
 */
class LimitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => Klijent::inRandomOrder()->first()->user_id,
            'kategorija_id' => Kategorija::inRandomOrder()->first()->id,
            'iznos' => fake()->randomFloat(2, 5000, 50000),
        ];
    }
}