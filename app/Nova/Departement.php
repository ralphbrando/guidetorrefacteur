<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Http\Request;
use Laravel\Nova\Resource;

class Departement extends Resource
{
    public static $model = \App\Models\Departement::class;

    public static $title = 'nom';

    public static $search = [
        'id', 'nom', 'code',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Région', 'region', Region::class)
                ->required(),

            Text::make('Nom')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Code')
                ->nullable()
                ->rules('nullable', 'max:3'),
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


