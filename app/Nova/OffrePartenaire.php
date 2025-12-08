<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Illuminate\Http\Request;
use Laravel\Nova\Resource;

class OffrePartenaire extends Resource
{
    public static $model = \App\Models\OffrePartenaire::class;

    public static $title = 'nom';

    public static $group = 'Configuration';

    public static $priority = 10;

    public static $search = [
        'id', 'code', 'nom',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Code')
                ->sortable()
                ->rules('required', 'max:255')
                ->help('G, P1, P2, etc.'),

            Text::make('Nom')
                ->sortable()
                ->rules('required', 'max:255'),

            Textarea::make('Description')
                ->nullable(),

            Number::make('Prix')
                ->rules('required'),

            Number::make('Nombre de Guides', 'nombre_guides')
                ->rules('required', 'integer', 'min:0')
                ->default(0),

            Number::make('Limite')
                ->help('null = illimité')
                ->rules('nullable', 'integer', 'min:0')
                ->nullable(),

            Number::make('Réservé', 'reserve')
                ->rules('required', 'integer', 'min:0')
                ->default(0),

            Boolean::make('Actif')
                ->default(true),

            Number::make('Ordre')
                ->sortable()
                ->default(0),
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


