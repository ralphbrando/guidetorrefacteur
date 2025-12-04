<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torrefacteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'region_id',
        'departement_id',
        'offre_partenaire_id',
        'nom_brulerie',
        'prenom_nom_representant',
        'adresse',
        'telephone',
        'email',
        'logo',
        'texte_descriptif',
        'site_internet',
        'photo',
        'statut',
        'valide',
        'date_validation',
        'machine_torrefier',
        'capacite_machine',
        'ateliers_decouvertes',
        'degustations',
        'labels',
        'arabica',
        'robusta',
        'geisha',
        'thes',
        'cacao',
        'accessoires_cafe_domestique',
        'machines_domestiques',
        'accessoires_thes',
        'espace_professionnels',
        'cascara',
        'formations_sca',
    ];

    protected $casts = [
        'valide' => 'boolean',
        'date_validation' => 'datetime',
        'ateliers_decouvertes' => 'boolean',
        'degustations' => 'boolean',
        'arabica' => 'boolean',
        'robusta' => 'boolean',
        'geisha' => 'boolean',
        'thes' => 'boolean',
        'cacao' => 'boolean',
        'accessoires_cafe_domestique' => 'boolean',
        'machines_domestiques' => 'boolean',
        'accessoires_thes' => 'boolean',
        'espace_professionnels' => 'boolean',
        'cascara' => 'boolean',
        'formations_sca' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function offrePartenaire()
    {
        return $this->belongsTo(OffrePartenaire::class);
    }

    public function equipements()
    {
        return $this->belongsToMany(Equipement::class, 'torrefacteur_equipements');
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function champsSupplementaires()
    {
        return $this->belongsToMany(ChampSupplementaire::class, 'torrefacteur_champs_supplementaires')
            ->withPivot('valeur')
            ->withTimestamps();
    }

    public function hasPaid()
    {
        return $this->paiements()->where('statut', 'paye')->exists();
    }
}


