<?php

namespace App\Http\Controllers\Api;

use App\Facades\amoApi;
use App\Http\Controllers\Controller;
use App\Jobs\BizonWebinarSend;
use App\Models\Api\Core\Access;
use App\Models\Api\Core\Account;
use App\Models\Api\Integrations\Bizon\BizonSetting;
use App\Models\Api\Integrations\Bizon\Viewer;
use App\Models\Api\Integrations\Bizon\Webinar;
use App\Notifications\BizonAccessException;
use App\Services\amoCRM\Strategy\Bizon\SendFactory;
use App\Services\Bizon365\Client;
use App\Services\Bizon365\ViewerSender;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Octane\Exceptions\DdException;

class BizonController extends Controller
{
    /**
     * @throws GuzzleException|DdException
     */
    public function hook(Account $account, Request $request)
    {
        $webinar = Webinar::create(
            $request->toArray() + ['account_id' => $account->id]
        );

        $setting = $account->bizon_settings;
        $access  = $account->access
            ->where('service_name', 'bizon365')
            ->where('status', 1)
            ->first();

        //new BizonAccessException(); //TODO check

        //TODO facade
        $bizon = (new Client())
            ->setLogin($access->login)
            ->setPassword($access->password)
            ->auth();

        $info = $bizon->webinar($webinar->webinarId);

        $webinar_title   = $info->room_title;
        $webinar_created = $info->report->created;
        $webinar_group   = $info->report->group;
        $webinar->room_title = $webinar_title;
        $webinar->created    = $webinar_created;
        $webinar->group      = $webinar_group;

        $report = json_decode($info->report->report, true);

        $commentariesTS = json_decode($info->report->messages, true);

        $webinar->setViewers($report, $setting, $commentariesTS);//TODO response

        $webinar->status = 'wait';
        $webinar->save();

//        BizonWebinarSend::dispatch($webinar, $setting)->afterCommit();; //TODO observer?
    }

    //TODO jobs
    public function cron()
    {
        $webinar = Webinar::query()->first();

        /* @var BizonSetting $setting */
        $setting = $webinar->account->bizon_settings;

        $amoApi = amoApi::getInstance();

        BizonWebinarSend::dispatch($webinar, $setting)->afterCommit();//TODO передавать юзера для авторизации клиента амо
    }
}
