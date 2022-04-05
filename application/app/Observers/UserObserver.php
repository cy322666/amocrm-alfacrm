<?php

namespace App\Observers;

use App\Models\Api\Core\Account;
use App\Models\User;
use App\Notifications\HelloMessage;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class UserObserver
{
    public function created(User $user)
    {
        $account = $user->account()->create([

            'redirect_uri' => env('AMO_REDIRECT_URI'),//TODO env
            'endpoint'     => Uuid::uuid6(),
            'expires_tariff' => Carbon::now()->addDays(7)->timestamp,
        ]);

        $account->bizon_settings()->create();

        $account->user->notify(new HelloMessage());
    }
}
