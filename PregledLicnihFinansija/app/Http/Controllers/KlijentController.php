<?php

namespace App\Http\Controllers;

use App\Models\Klijent;
use App\Models\User;
use Illuminate\Http\Request;

class KlijentController extends Controller
{
    // Pregled net worth-a - samo premium
    public function netWorth(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $klijent = Klijent::where('user_id', $user->id)->first();

        if (!$klijent) {
            return response()->json([
                'message' => 'Korisnik nije klijent.'
            ], 403);
        }

        return response()->json([
            'net_worth' => $klijent->getNetWorth(),
        ]);
    }

    // Pregled profila klijenta
    public function profil(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $klijent = Klijent::where('user_id', $user->id)->with('user')->first();

        if (!$klijent) {
            return response()->json([
                'message' => 'Korisnik nije klijent.'
            ], 403);
        }

        return response()->json($klijent);
    }
}