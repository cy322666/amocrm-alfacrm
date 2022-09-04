<?php

namespace App\Services\ManagerClients;

use App\Models\Account;
use App\Models\Webhook;
use App\Services\AlfaCRM\Client as alfaApi;
use App\Services\amoCRM\Client as amoApi;

class AlfaCRMManager
{
    public amoApi $amoApi;
    public alfaApi $alfaApi;
    public Account $amoAccount;
    public Account $alfaAccount;

    //TODO exception auth
    public function __construct(Webhook $webhook)
    {
        $user = $webhook->user;

        $this->amoAccount = $user->account('amocrm');

        $this->amoApi = (new amoApi($this->amoAccount))->init();

        $this->alfaAccount = $user->account('alfacrm')->first();

        $this->alfaApi = (new alfaApi($this->alfaAccount));
    }
}
