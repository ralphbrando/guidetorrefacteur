<?php

namespace Database\Seeders;

use App\Models\Equipement;
use Illuminate\Database\Seeder;

class EquipementSeeder extends Seeder
{
    public function run()
    {
        $equipements = [
            ['nom' => 'Machine à torréfier', 'icone' => 'machine.svg', 'ordre' => 1],
            ['nom' => 'Capacité de la machine', 'icone' => 'capacite.svg', 'ordre' => 2],
            ['nom' => 'Organisation d\'ateliers découvertes', 'icone' => 'atelier.svg', 'ordre' => 3],
            ['nom' => 'Dégustations', 'icone' => 'degustation.svg', 'ordre' => 4],
            ['nom' => 'Labels', 'icone' => 'label.svg', 'ordre' => 5],
            ['nom' => 'Arabica', 'icone' => 'arabica.svg', 'ordre' => 6],
            ['nom' => 'Robusta', 'icone' => 'robusta.svg', 'ordre' => 7],
            ['nom' => 'Geisha', 'icone' => 'geisha.svg', 'ordre' => 8],
            ['nom' => 'Thés', 'icone' => 'the.svg', 'ordre' => 9],
            ['nom' => 'Cacao', 'icone' => 'cacao.svg', 'ordre' => 10],
            ['nom' => 'Accessoires café domestique', 'icone' => 'accessoire-cafe.svg', 'ordre' => 11],
            ['nom' => 'Machines domestiques', 'icone' => 'machine-domestique.svg', 'ordre' => 12],
            ['nom' => 'Accessoires thés', 'icone' => 'accessoire-the.svg', 'ordre' => 13],
            ['nom' => 'Espace professionnels', 'icone' => 'espace-pro.svg', 'ordre' => 14],
            ['nom' => 'Cascara', 'icone' => 'cascara.svg', 'ordre' => 15],
            ['nom' => 'Formations SCA', 'icone' => 'formation.svg', 'ordre' => 16],
        ];

        foreach ($equipements as $equipement) {
            Equipement::create($equipement);
        }
    }
}


