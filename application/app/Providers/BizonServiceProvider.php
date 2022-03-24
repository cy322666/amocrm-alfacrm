<?php

namespace App\Providers;

use App\Sevices\Bizon365\Client;
use Illuminate\Support\ServiceProvider;

class BizonServiceProvider extends ServiceProvider
{
    public function register()
    {
        \Illuminate\Support\Facades\App::bind('Bizon365', function () {
            
            return new Client();
        });
    }
}