<?php

namespace Database\Factories;

use App\Models\Kredit;
use App\Models\Klijent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kredit>
 */
class KreditFactory extends Factory
{
    public function definition(): array
    {
        $premiumKlijent = Klijent::where('premium_klijent', true)->inRandomOrder()->first();
        
        return [
            'klijent_id' => $premiumKlijent->id,
            'pozajmljenaCifra' => fake()->randomFloat(2, 10000, 500000),
            'kamatnaStopa' => fake()->randomFloat(2, 1, 15),
            'mesecnaRata' => fake()->randomFloat(2, 1000, 20000),
        ];
    }
}