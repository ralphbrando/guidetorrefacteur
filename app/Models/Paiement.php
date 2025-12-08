<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'torrefacteur_id',
        'offre_partenaire_id',
        'numero_facture',
        'nom_societe',
        'montant',
        'methode',
        'statut',
        'transaction_id',
        'notes',
        'date_paiement',
    ];

    protected $casts = [
        'date_paiement' => 'datetime',
    ];

    public function torrefacteur()
    {
        return $this->belongsTo(Torrefacteur::class);
    }

    public function offrePartenaire()
    {
        return $this->belongsTo(OffrePartenaire::class);
    }

    public static function generateNumeroFacture()
    {
        $year = date('Y');
        $last = self::whereYear('created_at', $year)->latest()->first();
        $number = $last ? (int) substr($last->numero_facture, -6) + 1 : 1;
        return 'FACT-' . $year . '-' . str_pad($number, 6, '0', STR_PAD_LEFT);
    }
}


