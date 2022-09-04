<?php

namespace App\Services\ManagerClients\AlfaCRMManager;

use App\Models\Webhook;
use App\Services\AlfaCRM\Client as alfaApi;
use App\Services\amoCRM\Client as amoApi;

class AlfaCRMManager
{
    public amoApi $amoApi;
    public alfaApi $alfaApi;

    //TODO exception auth
    public function __construct(Webhook $webhook)
    {
        $user = $webhook->user;

        $amoAccount = $user->account('amocrm')->first();

        $this->amoApi = (new amoApi($amoAccount))->init();

        $alfaAccount = $user->account('alfacrm')->first();

        $this->alfaApi = (new alfaApi($alfaAccount));
    }
}
