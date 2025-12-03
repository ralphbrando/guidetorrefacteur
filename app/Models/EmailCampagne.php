<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCampagne extends Model
{
    use HasFactory;

    protected $fillable = [
        'sujet',
        'contenu',
        'envoyes',
        'total',
        'statut',
        'date_envoi',
    ];

    protected function casts(): array
    {
        return [
            'date_envoi' => 'datetime',
        ];
    }
}


