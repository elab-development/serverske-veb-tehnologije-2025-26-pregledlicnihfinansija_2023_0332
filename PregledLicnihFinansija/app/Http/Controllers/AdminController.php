<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transakcija;
use App\Models\Kategorija;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function korisnici()
    {
        $korisnici = User::with('klijent')->get();
        return response()->json($korisnici);
    }

    public function promeniUlogu(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:klijent,administrator',
        ]);

        $korisnik = User::findOrFail($id);
        $korisnik->update(['type' => $request->type]);

        return response()->json(['poruka' => 'Uloga je uspesno promenjena!', 'korisnik' => $korisnik]);
    }

    public function promeniPremium(Request $request, $id)
    {
        $request->validate([
            'isPremium' => 'required|boolean', 
        ]);

        $klijent = \App\Models\Klijent::where('user_id', $id)->firstOrFail();
        $klijent->update(['premium_klijent' => $request->isPremium]);

        return response()->json(['poruka' => 'Premium status uspesno postavljen', 'klijent' => $klijent]);

    }


    public function analitika()
    {
        $ukupnoKorisnika = User::count();
        $ukupnoTransakcija = Transakcija::count();
        $ukupnoKategorija = Kategorija::count();
        $transakcijePoKategoriji = Transakcija::with('kategorija') 
            ->selectRaw('kategorija_id, count(*) as broj, sum(kolicina) as ukupno')
            ->groupBy('kategorija_id')
            ->get(); 

        $transakcijePoMesecu = Transakcija::selectRaw('YEAR(datum) as godina, MONTH(datum) as mesec, count(*) as broj, sum(kolicina) as ukupno')
            ->groupBy('godina', 'mesec')
            ->orderBy('godina', 'desc')
            ->orderBy('mesec', 'desc')
            ->get();
            
          return response()->json([
            'ukupno_korisnika' => $ukupnoKorisnika,
            'ukupno_transakcija' => $ukupnoTransakcija,
            'ukupno_kategorija' => $ukupnoKategorija,
            'transakcije_po_kategoriji' => $transakcijePoKategoriji,
            'transakcije_po_mesecu' => $transakcijePoMesecu,
        ]);
    }















}
