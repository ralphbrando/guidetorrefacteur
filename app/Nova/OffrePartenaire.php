<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class OffrePartenaire extends Resource
{
    public static $model = \App\Models\OffrePartenaire::class;

    public static $title = 'nom';

    public static $search = [
        'id', 'code', 'nom',
    ];

    public function fields(NovaRequest $request)
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
                ->sortable()
                ->step(0.01)
                ->rules('required', 'numeric', 'min:0'),

            Number::make('Nombre de Guides', 'nombre_guides')
                ->default(0)
                ->rules('required', 'integer', 'min:0'),

            Number::make('Limite')
                ->nullable()
                ->help('null = illimité')
                ->rules('nullable', 'integer', 'min:0'),

            Number::make('Réservé', 'reserve')
                ->default(0)
                ->rules('required', 'integer', 'min:0'),

            Boolean::make('Actif')
                ->default(true),

            Number::make('Ordre')
                ->sortable()
                ->default(0),
        ];
    }

    public function cards(NovaRequest $request)
    {
        return [];
    }

    public function filters(NovaRequest $request)
    {
        return [];
    }

    public function lenses(NovaRequest $request)
    {
        return [];
    }

    public function actions(NovaRequest $request)
    {
        return [];
    }
}


