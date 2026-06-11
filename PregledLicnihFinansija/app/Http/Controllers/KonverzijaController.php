<?php

namespace App\Http\Controllers;

use App\Models\Klijent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KonverzijaController extends Controller
{
    // Use case 9 - Konverzija valuta
    public function konvertuj(Request $request)
    {
        $request->validate([
            'iznos' => 'required|numeric|min:0',
            'iz_valute' => 'required|string|size:3',
            'u_valutu' => 'required|string|size:3',
        ]);

        $apiKey = env('EXCHANGE_RATE_API_KEY');
        $izValute = strtoupper($request->iz_valute);
        $uValutu = strtoupper($request->u_valutu);

        $response = Http::get("https://v6.exchangerate-api.com/v6/{$apiKey}/pair/{$izValute}/{$uValutu}");

        if (!$response->successful()) {
            return response()->json([
                'message' => 'Greška pri preuzimanju kursa valuta.'
            ], 500);
        }

        $data = $response->json();

        if ($data['result'] !== 'success') {
            return response()->json([
                'message' => 'Nevažeća valuta ili greška API-ja.'
            ], 400);
        }

        $kurs = $data['conversion_rate'];
        $konvertovaniIznos = $request->iznos * $kurs;

        return response()->json([
            'iz_valute' => $izValute,
            'u_valutu' => $uValutu,
            'kurs' => $kurs,
            'originalni_iznos' => $request->iznos,
            'konvertovani_iznos' => round($konvertovaniIznos, 2),
        ]);
    }

    // Pregled dostupnih valuta
    public function valute()
    {
        $apiKey = env('EXCHANGE_RATE_API_KEY');

        $response = Http::get("https://v6.exchangerate-api.com/v6/{$apiKey}/codes");

        if (!$response->successful()) {
            return response()->json([
                'message' => 'Greška pri preuzimanju liste valuta.'
            ], 500);
        }

        return response()->json($response->json()['supported_codes']);
    }

    // Promena preferred_currency klijenta
    public function promeniValutu(Request $request)
    {
        $request->validate([
            'valuta' => 'required|string|size:3',
        ]);

        /** @var User $user */
        $user = $request->user();
        $klijent = Klijent::where('user_id', $user->id)->first();

        if (!$klijent) {
            return response()->json([
                'message' => 'Korisnik nije klijent.'
            ], 403);
        }

        $klijent->preferred_currency = strtoupper($request->valuta);
        $klijent->save();

        return response()->json([
            'message' => 'Valuta uspešno promenjena!',
            'preferred_currency' => $klijent->preferred_currency,
        ]);
    }
}