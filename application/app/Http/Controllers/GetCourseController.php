<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\GetCourse\OrderRequest;
use App\Http\Requests\Api\GetCourse\PaymentRequest;
use App\Http\Requests\Api\GetCourse\SiteRequest;
use App\Jobs\GetCourse\FormSend;
use App\Jobs\GetCourse\OrderSend;
use App\Jobs\GetCourse\PaymentSend;
use App\Models\GetCourse\Form;
use App\Models\Webhook;

class GetCourseController extends Controller
{
    public function form(Webhook $webhook, SiteRequest $request)
    {
        try {
            $user = $webhook->user;

            $setting = $user->getcourseSetting;

            $form = $setting->forms()->create($request->toArray());

            FormSend::dispatch($form, $setting, $user);

        } catch (\Throwable $exception) {


        }
    }

    public function payment(Webhook $webhook, PaymentRequest $request)
    {
        try {
            $user = $webhook->user;

            $setting = $user->getcourseSetting;

            $payment = $setting->forms()->create($request->toArray());

            PaymentSend::dispatch($payment, $setting, $user);

        } catch (\Throwable $exception) {


        }
    }

    public function order(Webhook $webhook, OrderRequest $request)
    {
        try {
            $user = $webhook->user;

            $setting = $user->getcourseSetting;

            $order = $setting->orders()->create($request->toArray());

            OrderSend::dispatch($order, $setting, $user);

        } catch (\Throwable $exception) {


        }
    }
}
