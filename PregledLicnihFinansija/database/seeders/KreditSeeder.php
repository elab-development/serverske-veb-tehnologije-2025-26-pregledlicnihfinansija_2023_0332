<?php

namespace Database\Seeders;

use App\Models\Kredit;
use App\Models\Klijent;
use Illuminate\Database\Seeder;

class KreditSeeder extends Seeder
{
    public function run(): void
    {
        // Samo premium klijenti mogu imati kredite
        $premiumKlijenti = Klijent::where('premium_klijent', true)->get();

        foreach ($premiumKlijenti as $klijent) {
            // Svaki premium klijent dobija 1-2 kredita
            Kredit::factory(rand(1, 2))->create([
                'klijent_id' => $klijent->id,
            ]);
        }
    }
}