<?php

namespace Database\Factories;

use App\Models\GrupnaTransakcija;
use App\Models\Klijent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GrupnaTransakcija>
 */
class GrupnaTransakcijaFactory extends Factory
{
    public function definition(): array
    {
        $ciljIznos = fake()->randomFloat(2, 10000, 500000);
        $prikupljeno = fake()->randomFloat(2, 0, $ciljIznos);

        return [
            'kreator_id' => Klijent::where('premium_klijent', true)->inRandomOrder()->first()->id,
            'naziv' => fake()->sentence(3),
            'ciljIznos' => $ciljIznos,
            'trenutnoPrikupljeno' => $prikupljeno,
        ];
    }
}