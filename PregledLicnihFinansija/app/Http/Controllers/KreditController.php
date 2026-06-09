<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use App\Models\Klijent;
use App\Models\User;
use Illuminate\Http\Request;

class KreditController extends Controller
{
    // Use case 8 - Unos kredita
    public function store(Request $request)
    {
        $request->validate([
            'pozajmljenaCifra' => 'required|numeric|min:0',
            'kamatnaStopa' => 'required|numeric|min:0',
            'mesecnaRata' => 'required|numeric|min:0',
        ]);

        /** @var User $user */
        $user = $request->user();
        $klijent = Klijent::where('user_id', $user->id)->first();

        $kredit = Kredit::create([
            'klijent_id' => $klijent->id,
            'pozajmljenaCifra' => $request->pozajmljenaCifra,
            'kamatnaStopa' => $request->kamatnaStopa,
            'mesecnaRata' => $request->mesecnaRata,
        ]);

        return response()->json([
            'message' => 'Kredit uspešno dodat!',
            'kredit' => $kredit,
            'meseci_do_otplate' => $kredit->racunajVremeOtplate(),
        ], 201);
    }

    // Pregled svih kredita klijenta
    public function index(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $klijent = Klijent::where('user_id', $user->id)->first();

        $krediti = Kredit::where('klijent_id', $klijent->id)
            ->get()
            ->map(function ($kredit) {
                $kredit->meseci_do_otplate = $kredit->racunajVremeOtplate();
                return $kredit;
            });

        return response()->json($krediti);
    }

    // Brisanje kredita
    public function destroy(Request $request, $id)
    {
        /** @var User $user */
        $user = $request->user();
        $klijent = Klijent::where('user_id', $user->id)->first();

        $kredit = Kredit::where('id', $id)
            ->where('klijent_id', $klijent->id)
            ->first();

        if (!$kredit) {
            return response()->json([
                'message' => 'Kredit nije pronađen.'
            ], 404);
        }

        $kredit->delete();

        return response()->json([
            'message' => 'Kredit uspešno obrisan.'
        ]);
    }

    // Izmena mesecne rate kredita
public function update(Request $request, $id)
{
    $request->validate([
        'mesecnaRata' => 'required|numeric|min:0',
        ]);

    /** @var User $user */
    $user = $request->user();
    $klijent = Klijent::where('user_id', $user->id)->first();

    $kredit = Kredit::where('id', $id)
        ->where('klijent_id', $klijent->id)
        ->first();

    if (!$kredit) {
        return response()->json([
            'message' => 'Kredit nije pronađen.'
        ], 404);
    }

    $kredit->update([
        'mesecnaRata' => $request->mesecnaRata,
    ]);

    return response()->json([
        'message' => 'Mesečna rata uspešno izmenjena!',
        'kredit' => $kredit,
        'meseci_do_otplate' => $kredit->racunajVremeOtplate(),
    ]);
}
}