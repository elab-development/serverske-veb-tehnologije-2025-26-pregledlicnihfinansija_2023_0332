<?php

namespace Database\Factories;

use App\Models\Kategorija;
use App\Models\Klijent;
use App\Models\Transakcija;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transakcija>
 */
class TransakcijaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'klijent_id' => Klijent::inRandomOrder()->first()->id,
            'kategorija_id' => Kategorija::inRandomOrder()->first()->id,
            'kolicina' => fake()->randomFloat(2, 100, 50000),
            'datum' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}