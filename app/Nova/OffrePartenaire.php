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


