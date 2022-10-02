<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\User;
use App\Services\amoCRM\Client;
use App\Services\amoCRM\EloquentStorage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        DB::listen(function ($query) {

            Log::channel('query')->debug('>', [
                    $query->sql,
                    $query->bindings,
                    $query->time,
                ]
            );

            if (round((floatval($query->time))) > 5) {

                (new \App\Services\Telegram\Client())->send('fat query '.Auth::user()->email ?? 'user'.' : '.$query->sql.' time : '.$query->time);
            }
        });
    }
}
