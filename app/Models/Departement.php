<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_id',
        'nom',
        'code',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function torrefacteurs()
    {
        return $this->hasMany(Torrefacteur::class);
    }
}


