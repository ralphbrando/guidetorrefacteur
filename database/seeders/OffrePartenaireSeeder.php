<?php

namespace Database\Seeders;

use App\Models\OffrePartenaire;
use Illuminate\Database\Seeder;

class OffrePartenaireSeeder extends Seeder
{
    public function run(): void
    {
        $offres = [
            [
                'code' => 'G',
                'nom' => 'Gratuit',
                'description' => 'Je préfère mourir que de vous donner même 1€ : Je rentre mes données et je n\'aurais aucune Photo, ni texte ni Icône',
                'prix' => 0,
                'nombre_guides' => 0,
                'limite' => null,
                'reserve' => 0,
                'ordre' => 1,
            ],
            [
                'code' => 'P1',
                'nom' => 'Participation à l\'éditorialisation',
                'description' => 'Participation à l\'éditorialisation + 3 Guides',
                'prix' => 49.99,
                'nombre_guides' => 3,
                'limite' => null,
                'reserve' => 0,
                'ordre' => 2,
            ],
            [
                'code' => 'P2',
                'nom' => 'Participant motivé',
                'description' => 'Participant motivé + 10 Guides',
                'prix' => 189.99,
                'nombre_guides' => 10,
                'limite' => null,
                'reserve' => 0,
                'ordre' => 3,
            ],
            [
                'code' => 'P3',
                'nom' => 'Pub ½ demi page',
                'description' => 'Pub ½ demi page + 20 Guides',
                'prix' => 1000.00,
                'nombre_guides' => 20,
                'limite' => null,
                'reserve' => 0,
                'ordre' => 4,
            ],
            [
                'code' => 'P4',
                'nom' => 'Pub Intérieure',
                'description' => 'Pub Intérieure + 20 Guides',
                'prix' => 2000.00,
                'nombre_guides' => 20,
                'limite' => null,
                'reserve' => 0,
                'ordre' => 5,
            ],
            [
                'code' => 'P5',
                'nom' => 'Pub R - page int. Gauche Région',
                'description' => 'Pub R - page int. Gauche Région + 30 Guides',
                'prix' => 3000.00,
                'nombre_guides' => 30,
                'limite' => 13,
                'reserve' => 0,
                'ordre' => 6,
            ],
            [
                'code' => 'P6',
                'nom' => 'Pub G - à gauche',
                'description' => 'Pub G - à gauche : des infos, de l\'avant-propos, sommaire, des considérations + 40 Guides',
                'prix' => 4000.00,
                'nombre_guides' => 40,
                'limite' => 4,
                'reserve' => 0,
                'ordre' => 7,
            ],
            [
                'code' => 'P7',
                'nom' => 'Pub 2 - 3è de couverture',
                'description' => 'Pub 2 - 3è de couverture + 40 Guides',
                'prix' => 4500.00,
                'nombre_guides' => 40,
                'limite' => 1,
                'reserve' => 0,
                'ordre' => 8,
            ],
            [
                'code' => 'P8',
                'nom' => 'Pub 2 - 2è de couverture',
                'description' => 'Pub 2 - 2è de couverture + 40 Guides',
                'prix' => 5000.00,
                'nombre_guides' => 40,
                'limite' => 1,
                'reserve' => 0,
                'ordre' => 9,
            ],
            [
                'code' => 'P9',
                'nom' => 'Pub 3 - 4è de couverture',
                'description' => 'Pub 3 - 4è de couverture + 50 Guides',
                'prix' => 6000.00,
                'nombre_guides' => 50,
                'limite' => 1,
                'reserve' => 0,
                'ordre' => 10,
            ],
        ];

        foreach ($offres as $offre) {
            OffrePartenaire::create($offre);
        }
    }
}


