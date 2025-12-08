<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        
        Nova::name('Guide des Torréfacteurs');

        // Organize resources in categories
        Nova::groupBy(function ($resource) {
            // Define categories for resources
            $categories = [
                'Gestion' => [
                    \App\Nova\User::class,
                    \App\Nova\Torrefacteur::class,
                    \App\Nova\Paiement::class,
                ],
                'Géographie' => [
                    \App\Nova\Region::class,
                    \App\Nova\Departement::class,
                ],
                'Configuration' => [
                    \App\Nova\OffrePartenaire::class,
                    \App\Nova\Equipement::class,
                    \App\Nova\ChampSupplementaire::class,
                ],
            ];

            // Find which category this resource belongs to
            foreach ($categories as $category => $resources) {
                if (in_array(get_class($resource), $resources)) {
                    return $category;
                }
            }

            // Default category
            return 'Autres';
        });

        Nova::serving(function () {
            Nova::theme(asset('vendor/nova/css/coffee-theme.css'));
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'appdevxxx@gmail.com',
            ]) || $user->isAdmin();
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

