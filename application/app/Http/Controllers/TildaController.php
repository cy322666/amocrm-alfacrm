<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Tilda\SiteRequest;
use App\Jobs\Tilda\FormSend;
use App\Models\Webhook;
use Throwable;

class TildaController extends Controller
{
    public function site(Webhook $webhook, SiteRequest $request)
    {
        try {
            $user = $webhook->user;

            $setting = $user->tildaSetting;

            $transaction = $setting
                ->transactions()
                ->create($request->toArray());

            $transaction->user_id = $user->id;
            $transaction->save();

            FormSend::dispatch($webhook, $transaction->refresh(), $setting, $user);

        } catch (Throwable $exception)  {

            dd($exception->getMessage());
        }
    }
}
