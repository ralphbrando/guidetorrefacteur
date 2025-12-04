<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsToMany;
use Illuminate\Http\Request;
use Laravel\Nova\Resource;

class Torrefacteur extends Resource
{
    public static $model = \App\Models\Torrefacteur::class;

    public static $title = 'nom_brulerie';

    public static $search = [
        'id', 'nom_brulerie', 'email', 'telephone',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Utilisateur', 'user', User::class)
                ->required(),

            Text::make('Nom de la Brulerie', 'nom_brulerie')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsTo::make('Région', 'region', Region::class)
                ->required(),

            BelongsTo::make('Département', 'departement', Departement::class)
                ->required(),

            BelongsTo::make('Offre Partenaire', 'offrePartenaire', OffrePartenaire::class)
                ->nullable(),

            Text::make('Prénom NOM Représentant', 'prenom_nom_representant')
                ->rules('required', 'max:255'),

            Textarea::make('Adresse')
                ->rules('required'),

            Text::make('Téléphone')
                ->rules('required', 'max:20'),

            Text::make('Email')
                ->rules('required', 'email', 'max:255'),

            Text::make('Site Internet', 'site_internet')
                ->nullable(),

            Image::make('Logo')
                ->disk('public')
                ->path('logos')
                ->nullable(),

            Image::make('Photo')
                ->disk('public')
                ->path('photos')
                ->nullable(),

            Textarea::make('Texte Descriptif', 'texte_descriptif')
                ->nullable(),

            Select::make('Statut')
                ->options([
                    'brouillon' => 'Brouillon',
                    'en_attente' => 'En attente',
                    'valide' => 'Validé',
                    'refuse' => 'Refusé',
                ])
                ->displayUsingLabels()
                ->default('brouillon'),

            Boolean::make('Validé', 'valide')
                ->default(false),

            BelongsToMany::make('Équipements', 'equipements', Equipement::class),

            // Champs supplémentaires
            Text::make('Machine à torréfier', 'machine_torrefier')
                ->nullable(),

            Text::make('Capacité machine', 'capacite_machine')
                ->nullable(),

            Boolean::make('Ateliers découvertes', 'ateliers_decouvertes'),
            Boolean::make('Dégustations', 'degustations'),
            Text::make('Labels')->nullable(),
            Boolean::make('Arabica'),
            Boolean::make('Robusta'),
            Boolean::make('Geisha'),
            Boolean::make('Thés', 'thes'),
            Boolean::make('Cacao'),
            Boolean::make('Accessoires café domestique', 'accessoires_cafe_domestique'),
            Boolean::make('Machines domestiques', 'machines_domestiques'),
            Boolean::make('Accessoires thés', 'accessoires_thes'),
            Boolean::make('Espace professionnels', 'espace_professionnels'),
            Boolean::make('Cascara'),
            Boolean::make('Formations SCA', 'formations_sca'),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}


