<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Bizon extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Bizon';
    }
}