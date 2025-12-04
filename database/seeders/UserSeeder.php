<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin user principal
        User::updateOrCreate(
            ['email' => 'appdevxxx@gmail.com'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@guide-torrefacteurs.fr'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Commercial users
        User::updateOrCreate(
            ['email' => 'commercial1@guide-torrefacteurs.fr'],
            [
                'name' => 'Commercial 1',
                'password' => Hash::make('password'),
                'role' => 'commercial1',
            ]
        );

        User::updateOrCreate(
            ['email' => 'commercial2@guide-torrefacteurs.fr'],
            [
                'name' => 'Commercial 2',
                'password' => Hash::make('password'),
                'role' => 'commercial2',
            ]
        );
    }
}


