<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChampSupplementaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'obligatoire',
        'ordre',
        'actif',
    ];

    protected function casts(): array
    {
        return [
            'obligatoire' => 'boolean',
            'actif' => 'boolean',
        ];
    }

    public function torrefacteurs()
    {
        return $this->belongsToMany(Torrefacteur::class, 'torrefacteur_champs_supplementaires')
            ->withPivot('valeur')
            ->withTimestamps();
    }
}


