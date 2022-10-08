<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\GetCourse\OrderRequest;
use App\Http\Requests\Api\GetCourse\SiteRequest;
use App\Jobs\GetCourse\FormSend;
use App\Jobs\GetCourse\OrderSend;
use App\Models\Webhook;
use Illuminate\Support\Facades\Log;

class GetCourseController extends Controller
{
    public function form(Webhook $webhook, SiteRequest $request)
    {
        try {
            $user = $webhook->user;

            $setting = $user->getcourseSetting;

            $form = $setting->forms()->create($request->toArray());

            FormSend::dispatch($webhook, $form, $setting, $user);

        } catch (\Throwable $exception) {


        }
    }

    public function orders(Webhook $webhook, OrderRequest $request)
    {
        try {
            $user = $webhook->user;

            $requestArr = $request->toArray();

            $status = $requestArr['status'];
            $order_id = $requestArr['id'];

            unset($requestArr['status']);

            $order = $user->getcourseSetting->orders()
                ->create(
                    array_merge($requestArr, [
                        'status_order' => $status,
                        'order_id'   => $order_id,
                        'webhook_id' => $webhook->id,
                        'user_id'    => $user->id,
                    ])
                );

            Log::channel('getcourse')->info(__METHOD__.' > ставим в очередь order id : '.$order->id);

            OrderSend::dispatch($webhook, $order, $user);

        } catch (\Throwable $exception) {

            $order->error = $exception->getMessage().' '.$exception->getFile().' '.$exception->getLine();
            $order->save();
        }
    }
}
