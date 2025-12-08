<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Illuminate\Http\Request;
use Laravel\Nova\Resource;

class Paiement extends Resource
{
    public static $model = \App\Models\Paiement::class;

    public static $title = 'numero_facture';

    public static $group = 'Gestion';

    public static $priority = 30;

    public static $search = [
        'id', 'numero_facture', 'nom_societe', 'transaction_id',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Torréfacteur', 'torrefacteur', Torrefacteur::class)
                ->required(),

            BelongsTo::make('Offre Partenaire', 'offrePartenaire', OffrePartenaire::class)
                ->required(),

            Text::make('Numéro Facture', 'numero_facture')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Nom Société', 'nom_societe')
                ->rules('required', 'max:255'),

            Number::make('Montant')
                ->sortable()
                ->step(0.01)
                ->rules('required', 'numeric', 'min:0'),

            Select::make('Méthode')
                ->options([
                    'carte' => 'Carte de crédit',
                    'paypal' => 'PayPal',
                    'virement' => 'Virement',
                ])
                ->nullable()
                ->displayUsingLabels(),

            Select::make('Statut')
                ->options([
                    'en_attente' => 'En attente',
                    'paye' => 'Payé',
                    'annule' => 'Annulé',
                    'rembourse' => 'Remboursé',
                ])
                ->displayUsingLabels()
                ->default('en_attente'),

            Text::make('Transaction ID', 'transaction_id')
                ->nullable(),

            Textarea::make('Notes')
                ->nullable(),

            DateTime::make('Date Paiement', 'date_paiement')
                ->nullable(),
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


