<?php

namespace App\Facades;

use AmoCRM\Client\AmoCRMApiClient;
use App\Services\amoCRM\Client;
use Illuminate\Support\Facades\Facade;

/**
 * @method static getInstance()
 * @return AmoCRMApiClient
 */
class amoApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'amoApi';
    }
}