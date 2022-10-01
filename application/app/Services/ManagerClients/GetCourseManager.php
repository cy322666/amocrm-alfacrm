<?php

namespace App\Services\ManagerClients;

use App\Models\User;
use App\Models\Webhook;
use App\Notifications\Api\amoCRMAuthException;
use App\Notifications\Api\BizonAuthException;
use App\Services\amoCRM\Client as amoApi;
use App\Services\Bizon\Client;
use Illuminate\Support\Facades\Log;

class GetCourseManager
{
    public $amoAccount;
    public amoApi $amoApi;

    public function __construct(Webhook $webhook)
    {
        $user = $webhook->user;

        $this->amoAccount = $user->amoAccount();

        try {

            $this->amoApi = (new amoApi($this->amoAccount))->init();

        } catch (\Throwable $exception) {

            Log::error(__METHOD__.' : '.$exception->getMessage());

            $user->notify(new amoCRMAuthException());
        }
    }

    public static function register(User $user)
    {
        $user->account()->create(['name' => 'getcourse']);

        $setting = $user->getcourseSetting()->create();

        $setting->createWebhooks($user);
    }
}
