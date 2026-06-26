<?php

namespace App\Observers;

use App\Models\Transakcija;
use App\Models\Limit;
use App\Models\Klijent;
use App\Http\Controllers\GejmifikacijaController;

class TransakcijaObserver
{
    /**
     * Handle the Transakcija "created" event.
     */
    public function created(Transakcija $transakcija): void
    {
        $klijent = Klijent::find($transakcija->klijent_id);

        if(!$klijent) return;

        $limit = Limit::where('user_id', $klijent->user_id)
            ->where('kategorija_id', $transakcija->kategorija_id)
            ->first();

        if ($limit) {
            $ukupnoPotroseno = Transakcija::where('klijent_id', $transakcija->klijent_id)
                ->where('kategorija_id', $transakcija->kategorija_id)
                ->sum('kolicina');

            $procenat = ($ukupnoPotroseno / $limit->iznos) * 100;

      
            if ($procenat < 80) {
                $gejmifikacija = new GejmifikacijaController();
                $gejmifikacija->dodajPoene($klijent->id, 5);
            }
        }
    }

    /**
     * Handle the Transakcija "updated" event.
     */
    public function updated(Transakcija $transakcija): void
    {
        //
    }

    /**
     * Handle the Transakcija "deleted" event.
     */
    public function deleted(Transakcija $transakcija): void
    {
        $klijent = Klijent::find($transakcija->klijent_id);
    
        if (!$klijent) return;

        // Oduzmi poene kada se transakcija obriše
        if ($klijent->poeni >= 1) {
            $klijent->poeni -= 1;
            $klijent->bedz = app(GejmifikacijaController::class)->izracunajBedz($klijent->poeni);
            $klijent->save();
        }
    }

    /**
     * Handle the Transakcija "restored" event.
     */
    public function restored(Transakcija $transakcija): void
    {
        //
    }

    /**
     * Handle the Transakcija "force deleted" event.
     */
    public function forceDeleted(Transakcija $transakcija): void
    {
        //
    }
}
