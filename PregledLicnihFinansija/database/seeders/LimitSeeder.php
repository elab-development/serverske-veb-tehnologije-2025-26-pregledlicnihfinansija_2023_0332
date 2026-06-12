<?php

namespace Database\Seeders;

use App\Models\Kategorija;
use App\Models\Klijent;
use App\Models\Limit;
use Illuminate\Database\Seeder;

class LimitSeeder extends Seeder
{
    public function run(): void
    {
        $klijenti = Klijent::all();
        $kategorije = Kategorija::where('tip', 'trosak')->get();

        foreach ($klijenti as $klijent) {
            // Svaki klijent dobija limit na 3 random kategorije troškova
            $randomKategorije = $kategorije->random(3);

            foreach ($randomKategorije as $kategorija) {
                Limit::create([
                    'user_id' => $klijent->user_id,
                    'kategorija_id' => $kategorija->id,
                    'iznos' => fake()->randomFloat(2, 5000, 50000),
                ]);
            }
        }
    }
}