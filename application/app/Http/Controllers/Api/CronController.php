<?php

namespace App\Http\Controllers\Api;

use AmoCRM\Client\AmoCRMApiClient;
use App\Facades\amoApi;
use App\Http\Controllers\Controller;
use App\Models\Api\Core\Account;
use App\Models\Api\Integrations\Bizon\Webinar;
use App\Notifications\TariffExpiresToday;
use App\Notifications\TariffExpiresYesterday;
use App\Services\amoCRM\Client;
use App\Services\amoCRM\Strategy\Bizon\SendFactory;
use App\Services\amoCRM\Strategy\Bizon\UniteLeads;
use App\Services\Bizon365\ViewerSender;
use Carbon\Carbon;

class CronController extends Controller
{
    //TODO несколько сервисов
    public function tariff()
    {
        $accounts = Account::query()
            ->where('status', '!=', 'expired')
            ->get();

        foreach ($accounts as $account) {

            //сделать between
            if ($account->expires_tariff > Carbon::today('Europe/Moscow')->timestamp &&
                $account->expires_tariff < Carbon::tomorrow('Europe/Moscow')->timestamp) {

                //выходит сегодня
                $account->user->notify(new TariffExpiresToday());

            } elseif($account->expires_tariff > Carbon::yesterday('Europe/Moscow')->timestamp) {

                //вышел вчера
                $user = $account->user;

                $user->notify(new TariffExpiresYesterday());

                $account->status = 'expired';
                $account->active = 0;
                $account->save();
            }
        }
    }
}