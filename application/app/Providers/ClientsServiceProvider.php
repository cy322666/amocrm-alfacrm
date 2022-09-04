<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\User;
use App\Services\amoCRM\Client;
use App\Services\amoCRM\EloquentStorage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class ClientsServiceProvider extends ServiceProvider
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
    public function boot()
    {
        view()->composer('*', function ($view) {

            if (Auth::user()) {

                $account = Auth::user()->account();

                $this->app->bind(Client::class, function ($app) use ($account) {

                    return (new Client($account));
                });

                $this->app->bind( \App\Services\AlfaCRM\Client::class, function ($app) {

                    $alfaAccount = Auth::user()->account('alfacrm');

                    return (new \App\Services\AlfaCRM\Client($alfaAccount));
                });
            }
        });
    }
}
