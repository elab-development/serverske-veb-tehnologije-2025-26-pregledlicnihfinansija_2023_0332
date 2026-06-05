<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Models\Klijent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Registracija
    public function register(Request $request)
    {
        // Preuzimanje podatak iz request i validacija da li su okej
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //Pravljenje objekta user koji je po defaultu klijent
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'klijent',
        ]);
        
        Klijent::create([
            'user_id' => $user->id,
            'net_worth' => 0,
            'premium_klijent' => false,
            'preferred_currency' => 'RSD',
        ]);
        //Automatski login za klijenta
        Auth::login($user);
        //Vraća se json sa porukom o uspešnoj registraciji
        return response()->json([
            'message' => 'Uspešna registracija!',
            'user' => $user,
        ], 201);
    }

    //Prijava
    public function login(Request $request)
        {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'message' => 'Uspešna prijava!',
                    'token' => $token,
                    'user' => $user,
                ]);
            }

            return response()->json([
                'message' => 'Pogrešan email ili lozinka.',
            ], 401);
        }

    //Odjava
   public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
            'message' => 'Uspešno ste se odjavili.',
        ]);
    }
}
