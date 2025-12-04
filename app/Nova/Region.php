<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\HasMany;
use Illuminate\Http\Request;
use Laravel\Nova\Resource;

class Region extends Resource
{
    public static $model = \App\Models\Region::class;

    public static $title = 'nom';

    public static $group = 'Territoires';

    public static $priority = 50;

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


