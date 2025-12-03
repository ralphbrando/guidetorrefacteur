<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            ['nom' => 'Auvergne-Rhône-Alpes', 'ordre' => 1],
            ['nom' => 'Bourgogne-Franche-Comté', 'ordre' => 2],
            ['nom' => 'Bretagne', 'ordre' => 3],
            ['nom' => 'Centre-Val de Loire', 'ordre' => 4],
            ['nom' => 'Corse', 'ordre' => 5],
            ['nom' => 'Grand Est', 'ordre' => 6],
            ['nom' => 'Hauts-de-France', 'ordre' => 7],
            ['nom' => 'Île-de-France', 'ordre' => 8],
            ['nom' => 'Normandie', 'ordre' => 9],
            ['nom' => 'Nouvelle-Aquitaine', 'ordre' => 10],
            ['nom' => 'Occitanie', 'ordre' => 11],
            ['nom' => 'Pays de la Loire', 'ordre' => 12],
            ['nom' => 'Provence-Alpes-Côte d\'Azur', 'ordre' => 13],
            ['nom' => 'Outre-mer', 'ordre' => 14],
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}


