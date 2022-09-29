<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Bizon\HookRequest;
use App\Jobs\Bizon\ViewerSend;
use App\Models\User;
use App\Models\Webhook;
use App\Notifications\Api\BizonAuthException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class BizonController extends Controller
{
    public function webinar(Webhook $webhook, HookRequest $request)
    {
        try {
            $user = $webhook->user;

            $setting = $user->bizonSetting;
            $account = $user->bizonAccount();
            $webinar = $setting->webinars()->create($request->toArray());

            $bizonApi = (new \App\Services\Bizon\Client())->setToken($account->access_token);

            try {
                $info = $bizonApi->webinar($webinar->webinarId);

            } catch (GuzzleException $exception) {

                Log::channel('bizon')->error(__METHOD__.' account '.$user->email.' : '.$exception->getMessage());

                $user->notify(new BizonAuthException());

                return;
            }

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

                Log::channel('bizon')->info(__METHOD__.' > ставим в очередь viewer id : '.$viewer->id);

                ViewerSend::dispatch($webhook, $viewer, $setting, $webhook->user);
            }

        } catch (\Throwable $exception) {

            $webinar->error = $exception->getMessage();
            $webinar->save();
        }
        User::saveMemoryInfo(__METHOD__);
    }
}
