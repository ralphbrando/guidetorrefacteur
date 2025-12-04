<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\BelongsToMany;
use Illuminate\Http\Request;
use Laravel\Nova\Resource;

class Equipement extends Resource
{
    public static $model = \App\Models\Equipement::class;

    public static $title = 'nom';

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

            Image::make('Icône', 'icone')
                ->disk('public')
                ->path('icones')
                ->nullable(),

            Textarea::make('Description')
                ->nullable(),

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


