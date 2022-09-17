<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\BizonViewerSend;
use App\Models\Account;
use App\Models\Bizon\Setting;
use App\Models\Bizon\Viewer;
use App\Models\Bizon\Webinar;
use App\Services\Bizon365\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Octane\Exceptions\DdException;

class BizonController extends Controller
{
    /**
     * @throws GuzzleException|DdException
     */
    public function webinar(Account $account, Request $request)
    {
        //TODO webhook
        $webinar = $account->bizonWebinar()->create($request->toArray());

        $setting = $account->bizonSetting;

        //TODO facade
        $bizon = (new Client())->setToken($account->token_bizon);

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
        $webinar->save();

        foreach ($webinar->viewers as $viewer) {

            Log::info(__METHOD__.' > ставим в очередь viewer id : '.$viewer->id);

            BizonViewerSend::dispatch($viewer, $setting);
        }
    }
}
