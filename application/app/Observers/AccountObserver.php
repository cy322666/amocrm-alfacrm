<?php

namespace App\Observers;

use App\Models\Api\Core\Account;
use App\Notifications\HelloMessage;
use Carbon\Carbon;

class AccountObserver
{
    /**
     * Handle the Account "created" event.
     *
     * @param  \App\Models\Api\Core\Account  $account
     * @return void
     */
    public function created(Account $account)
    {
        $account->redirect_uri = env('AMO_REDIRECT_URI');
        $account->endpoint = Account::generateUuid();
        $account->expires_tariff = Carbon::now()->addDays(7)->timestamp;
        $account->save();
    
        $account->user->notify(new HelloMessage());
    }

    /**
     * Handle the Account "updated" event.
     *
     * @param  \App\Models\Api\Core\Account  $account
     * @return void
     */
    public function updated(Account $account)
    {
        //
    }

    /**
     * Handle the Account "deleted" event.
     *
     * @param  \App\Models\Api\Core\Account  $account
     * @return void
     */
    public function deleted(Account $account)
    {
        //
    }

    /**
     * Handle the Account "restored" event.
     *
     * @param  \App\Models\Api\Core\Account  $account
     * @return void
     */
    public function restored(Account $account)
    {
        //
    }

    /**
     * Handle the Account "force deleted" event.
     *
     * @param  \App\Models\Api\Core\Account  $account
     * @return void
     */
    public function forceDeleted(Account $account)
    {
        //
    }
}
