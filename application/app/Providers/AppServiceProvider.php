<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dashboard $dashboard)
    {
        Dashboard::useModel(\Orchid\Platform\Models\User::class, \App\Models\User::class);

        $this->app->bind('amoApi', 'App\Services\amoCRM\Client');
        $this->app->bind('Bizon', 'App\Services\Bizon365\Client');
    }
}
