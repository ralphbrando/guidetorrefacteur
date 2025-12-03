<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'ordre',
    ];

    public function departements()
    {
        return $this->hasMany(Departement::class);
    }

    public function torrefacteurs()
    {
        return $this->hasMany(Torrefacteur::class);
    }
}


