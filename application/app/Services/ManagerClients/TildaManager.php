<?php

namespace App\Services\ManagerClients;

use App\Models\User;
use App\Models\Webhook;
use App\Notifications\Api\amoCRMAuthException;
use App\Services\amoCRM\Client as amoApi;

class TildaManager
{
    public $amoAccount;
    public amoApi $amoApi;

    public function __construct(Webhook $webhook)
    {
        $user = $webhook->user;

        $this->amoAccount = $user->amoAccount();

        $this->amoApi = (new amoApi($this->amoAccount));
        $this->amoApi->init();

        if ($this->amoApi->auth == false) {

            $user->notify(new amoCRMAuthException());
        }
    }

    public static function register(User $user)
    {
        $user->account()->create(['name' => 'tilda']);

        $setting = $user->tildaSetting()->create();

        $setting->createWebhooks($user);
    }
}
