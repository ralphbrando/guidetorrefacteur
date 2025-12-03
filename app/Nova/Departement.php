<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Departement extends Resource
{
    public static $model = \App\Models\Departement::class;

    public static $title = 'nom';

    public static $search = [
        'id', 'nom', 'code',
    ];

    public function fields(NovaRequest $request)
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
                ->maxlength(3),
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


