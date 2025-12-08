<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffrePartenaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'nom',
        'description',
        'prix',
        'nombre_guides',
        'limite',
        'reserve',
        'actif',
        'ordre',
    ];

    protected $casts = [
        'actif' => 'boolean',
    ];

    public function torrefacteurs()
    {
        return $this->hasMany(Torrefacteur::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function isDisponible()
    {
        if ($this->limite === null) {
            return true;
        }
        return ($this->reserve ?? 0) < $this->limite;
    }
    
    public function getReserveAttribute($value)
    {
        return $value ?? 0;
    }
}


