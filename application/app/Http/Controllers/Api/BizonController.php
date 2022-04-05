<?php

namespace App\Http\Controllers\Api;

use App\Facades\amoApi;
use App\Http\Controllers\Controller;
use App\Jobs\BizonWebinarSend;
use App\Models\Api\Core\Access;
use App\Models\Api\Core\Account;
use App\Models\Api\Integrations\Bizon\BizonDispatcher;
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

        //new BizonAccessException(); //TODO check

        //TODO facade
        $bizon = (new Client())
            ->setToken($account->token_bizon);

        $info = $bizon->webinar($webinar->webinarId);

        $webinar_title   = $info->room_title;
        $webinar_created = $info->report->created;
        $webinar_group   = $info->report->group;
        $webinar->room_title = $webinar_title;
        $webinar->created    = $webinar_created;
        $webinar->group      = $webinar_group;

        $report = json_decode($info->report->report, true);

        $commentariesTS = json_decode($info->report->messages, true);

        $webinar->setViewers($report, $setting, $commentariesTS);

        $webinar->status = 'wait';
        $webinar->save();

        BizonDispatcher::schedule($webinar, $setting);
    }

    //TODO jobs
    public function cron()
    {
        $webinar = Webinar::query()->first();

        $setting = $webinar->account->bizon_settings;

        $viewers = $webinar->viewers()
            ->skip(20)
            ->take(5)
            ->get();

        $amoApi = amoApi::getInstance($webinar->account);

        foreach ($viewers as $viewer) {

            $result = ViewerSender::send(
                $amoApi,
                $viewer,
                SendFactory::getStrategy('unite_leads', $setting), //TODO strategy name
                $setting);

            $viewer->status = 'ok';//TODO ?
            $viewer->save();
        }
    }
}
