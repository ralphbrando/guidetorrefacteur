<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Region extends Resource
{
    public static $model = \App\Models\Region::class;

    public static $title = 'nom';

    public static $search = [
        'id', 'nom',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Nom')
                ->sortable()
                ->rules('required', 'max:255'),

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


