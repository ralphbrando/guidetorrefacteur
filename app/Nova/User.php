<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Password;
use Illuminate\Http\Request;
use Laravel\Nova\Resource;

class User extends Resource
{
    public static $model = \App\Models\User::class;

    public static $title = 'name';

    public static $group = 'Gestion';

    public static $priority = 10;

    public static $search = [
        'id', 'name', 'email',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Nom', 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email', 'email')
                ->sortable()
                ->rules('required', 'email', 'max:255')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Mot de passe', 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Select::make('Rôle', 'role')
                ->options([
                    'admin' => 'Administrateur',
                    'commercial1' => 'Commercial 1',
                    'commercial2' => 'Commercial 2',
                    'torrefacteur' => 'Torréfacteur',
                ])
                ->displayUsingLabels()
                ->rules('required'),
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


