<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Illuminate\Http\Request;
use Laravel\Nova\Resource;

class ChampSupplementaire extends Resource
{
    public static $model = \App\Models\ChampSupplementaire::class;

    public static $title = 'nom';

    public static $group = 'Configuration';

    public static $priority = 30;

    public static $search = [
        'id', 'nom',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Nom')
                ->sortable()
                ->rules('required', 'max:255'),

            Select::make('Type')
                ->options([
                    'text' => 'Texte',
                    'textarea' => 'Zone de texte',
                    'file' => 'Fichier',
                    'checkbox' => 'Case à cocher',
                    'number' => 'Nombre',
                    'email' => 'Email',
                    'url' => 'URL',
                ])
                ->default('text')
                ->rules('required'),

            Boolean::make('Obligatoire')
                ->default(false),

            Number::make('Ordre')
                ->sortable()
                ->default(0),

            Boolean::make('Actif')
                ->default(true),
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


