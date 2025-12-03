<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@guide-torrefacteurs.fr',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Commercial users
        User::create([
            'name' => 'Commercial 1',
            'email' => 'commercial1@guide-torrefacteurs.fr',
            'password' => Hash::make('password'),
            'role' => 'commercial1',
        ]);

        User::create([
            'name' => 'Commercial 2',
            'email' => 'commercial2@guide-torrefacteurs.fr',
            'password' => Hash::make('password'),
            'role' => 'commercial2',
        ]);
    }
}


