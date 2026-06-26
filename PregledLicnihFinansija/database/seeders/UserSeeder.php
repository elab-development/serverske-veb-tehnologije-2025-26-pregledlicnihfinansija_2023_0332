<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Klijent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Poznati test korisnici sa fiksnim emailovima

        // Basic klijent
        $basicUser = User::create([
            'name' => 'Basic Klijent',
            'email' => 'basic@test.com',
            'password' => Hash::make('password123'),
            'type' => 'klijent',
        ]);
        Klijent::create([
            'user_id' => $basicUser->id,
            'net_worth' => 0,
            'premium_klijent' => false,
            'preferred_currency' => 'RSD',
        ]);

        // 3 premium klijenta sa fiksnim emailovima
        $premiumData = [
            ['name' => 'Premium Klijent', 'email' => 'premium@test.com'],
            ['name' => 'Premium Klijent 2', 'email' => 'premium2@test.com'],
            ['name' => 'Premium Klijent 3', 'email' => 'premium3@test.com'],
        ];

        foreach ($premiumData as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password123'),
                'type' => 'klijent',
            ]);
            Klijent::create([
                'user_id' => $user->id,
                'net_worth' => 0,
                'premium_klijent' => true,
                'preferred_currency' => 'RSD',
            ]);
        }

        // Administrator
        $adminUser = User::create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'type' => 'administrator',
        ]);
        Administrator::create([
            'user_id' => $adminUser->id,
        ]);

        // 5 random basic klijenata pomocu factory
        User::factory(5)->create(['type' => 'klijent'])->each(function ($user) {
            Klijent::create([
                'user_id' => $user->id,
                'net_worth' => 0,
                'premium_klijent' => false,
                'preferred_currency' => 'RSD',
            ]);
        });

        // 5 random premium klijenata pomocu factory
        User::factory(5)->create(['type' => 'klijent'])->each(function ($user) {
            Klijent::create([
                'user_id' => $user->id,
                'net_worth' => 0,
                'premium_klijent' => true,
                'preferred_currency' => 'RSD',
            ]);
        });
    }
}