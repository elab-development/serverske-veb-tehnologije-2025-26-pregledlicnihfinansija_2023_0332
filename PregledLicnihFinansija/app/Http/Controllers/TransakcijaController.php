<?php

namespace App\Http\Controllers;

use App\Models\Transakcija;
use App\Models\Klijent;
use App\Models\User;
use Illuminate\Http\Request;

class TransakcijaController extends Controller
{
    // Use case 3 - Unos transakcije
    public function store(Request $request)
    {
        $request->validate([
            'kategorija_id' => 'required|exists:kategorije,id',
            'kolicina' => 'required|numeric',
            'datum' => 'required|date',
        ]);

        /** @var User $user */
        $user = $request->user();
        $klijent = Klijent::where('user_id', $user->id)->first();

        if (!$klijent) {
            return response()->json([
                'message' => 'Korisnik nije klijent.'
            ], 403);
        }

        $transakcija = Transakcija::create([
            'klijent_id' => $klijent->id,
            'kategorija_id' => $request->kategorija_id,
            'kolicina' => $request->kolicina,
            'datum' => $request->datum,
        ]);

        return response()->json([
            'message' => 'Transakcija uspešno dodata!',
            'transakcija' => $transakcija,
        ], 201);
    }

    // Use case 6 - Istorija aktivnosti
    public function index(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $klijent = Klijent::where('user_id', $user->id)->first();

        if (!$klijent) {
            return response()->json([
                'message' => 'Korisnik nije klijent.'
            ], 403);
        }

        $transakcije = Transakcija::where('klijent_id', $klijent->id)
            ->with('kategorija')
            ->orderBy('datum', 'desc')
            ->get();

        return response()->json($transakcije);
    }

    // Use case 6 - Filtriranje
    public function filter(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $klijent = Klijent::where('user_id', $user->id)->first();

        if (!$klijent) {
            return response()->json([
                'message' => 'Korisnik nije klijent.'
            ], 403);
        }

        $query = Transakcija::where('klijent_id', $klijent->id)->with('kategorija');

        if ($request->has('kategorija_id')) {
            $query->where('kategorija_id', $request->kategorija_id);
        }

        if ($request->has('od') && $request->has('do')) {
            $query->whereBetween('datum', [$request->od, $request->do]);
        }

        return response()->json($query->orderBy('datum', 'desc')->get());
    }

    // Brisanje transakcije
    public function destroy(Request $request, $id)
    {
        /** @var User $user */
        $user = $request->user();
        $klijent = Klijent::where('user_id', $user->id)->first();

        $transakcija = Transakcija::where('id', $id)
            ->where('klijent_id', $klijent->id)
            ->first();

        if (!$transakcija) {
            return response()->json([
                'message' => 'Transakcija nije pronađena.'
            ], 404);
        }

        $transakcija->delete();

        return response()->json([
            'message' => 'Transakcija uspešno obrisana.'
        ]);
    }
}