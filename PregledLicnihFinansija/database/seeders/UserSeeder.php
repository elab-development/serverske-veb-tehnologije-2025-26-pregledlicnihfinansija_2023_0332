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
        // Kreiranje basic klijenta
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

        // Kreiranje premium klijenta
        $premiumUser = User::create([
            'name' => 'Premium Klijent',
            'email' => 'premium@test.com',
            'password' => Hash::make('password123'),
            'type' => 'klijent',
        ]);

        Klijent::create([
            'user_id' => $premiumUser->id,
            'net_worth' => 0,
            'premium_klijent' => true,
            'preferred_currency' => 'RSD',
        ]);

        // Kreiranje administratora
        $adminUser = User::create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'type' => 'administrator',
        ]);

        Administrator::create([
            'user_id' => $adminUser->id,
        ]);
    }
}