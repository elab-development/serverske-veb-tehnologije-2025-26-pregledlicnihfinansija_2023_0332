<?php

namespace App\Http\Controllers;

use App\Models\Klijent;
use App\Models\Transakcija;
use App\Models\Limit;
use Illuminate\Http\Request;

class GejmifikacijaController extends Controller
{
    
    public function status(Request $request)
    {
        $klijent = Klijent::where('user_id', $request->user()->id)->firstOrFail();
        return response()->json([
            'poeni' => $klijent->poeni,
            'bedz' => $klijent->bedz,
        ]);
    }
    
    public function dodajPoene($klijentId, $iznos)
    {
        $klijent = Klijent::findOrFail($klijentId);
        $klijent->poeni += $iznos;
        $klijent->bedz = $this->izracunajBedz($klijent->poeni);
        $klijent->save();
    }

     public function izracunajBedz($poeni)
    {
        if ($poeni >= 1000) return 'Dijamantski stedisa';
        if ($poeni >= 500) return 'Zlatni stedisa';
        if ($poeni >= 200) return 'Srebrni stedisa';
        if ($poeni >= 50) return 'Bronzani stedisa';
        return 'Pocetnik';
    }








}
