<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'icone',
        'description',
        'ordre',
        'actif',
    ];

    protected function casts(): array
    {
        return [
            'actif' => 'boolean',
        ];
    }

    public function torrefacteurs()
    {
        return $this->belongsToMany(Torrefacteur::class, 'torrefacteur_equipements');
    }
}


