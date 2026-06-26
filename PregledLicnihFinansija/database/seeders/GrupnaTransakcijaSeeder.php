<?php

namespace Database\Seeders;

use App\Models\GrupnaTransakcija;
use App\Models\Klijent;
use App\Models\UdeoUGrupnojTransakciji;
use Illuminate\Database\Seeder;

class GrupnaTransakcijaSeeder extends Seeder
{
    public function run(): void
    {
        $premiumKlijenti = Klijent::where('premium_klijent', true)->get();

        // Kreiraj 3 grupne transakcije
        GrupnaTransakcija::factory(3)->create()->each(function ($grupa) use ($premiumKlijenti) {
            
            // Dodaj 2-4 random premium klijenta kao clanove
            $clanovi = $premiumKlijenti->random(rand(2, min(4, $premiumKlijenti->count())));

            foreach ($clanovi as $klijent) {
                UdeoUGrupnojTransakciji::create([
                    'grupna_transakcija_id' => $grupa->id,
                    'klijent_id' => $klijent->id,
                    'iznosUdela' => fake()->randomFloat(2, 1000, 50000),
                    'datumUplate' => fake()->dateTimeBetween('-6 months', 'now'),
                ]);
            }

            // Azuriraj trenutno prikupljeno
            $grupa->trenutnoPrikupljeno = UdeoUGrupnojTransakciji::where('grupna_transakcija_id', $grupa->id)->sum('iznosUdela');
            $grupa->save();
        });
    }
}