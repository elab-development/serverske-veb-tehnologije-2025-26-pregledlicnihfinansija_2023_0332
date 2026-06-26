<?php

namespace Database\Seeders;

use App\Models\Klijent;
use App\Models\Transakcija;
use Illuminate\Database\Seeder;

class TransakcijaSeeder extends Seeder
{
    public function run(): void
    {
        $klijenti = Klijent::all();

        foreach ($klijenti as $klijent) {
            // Svaki klijent dobija 10 random transakcija
            Transakcija::factory(10)->create([
                'klijent_id' => $klijent->id,
            ]);
        }
    }
}