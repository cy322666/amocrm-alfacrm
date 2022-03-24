<?php

namespace App\Http\Middleware\Api;

use App\Models\Api\Core\Account;
use App\Notifications\BizonAccessException;
use App\Notifications\BizonSettingsException;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class BizonHookMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param Account $account
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, Account $account)
    {
        Log::info(__METHOD__, $request->toArray());

        $validated = $request->validate([
            'event'     => ['required'],
            'roomid'    => ['required'],
            'webinarId' => ['required'],
            'stat'      => ['required'],
            'len'       => ['required'],
        ]);
        //        if($validated->)

        $setting = $account->bizon_settings()
            ->where('status', 1)
            ->first();//TODO 1?

        if ($setting && $setting->token && $setting->email) {

            //TODO проверка доступов
            return $next($request, $setting, $account);

        } else
            new BizonSettingsException(); //TODO check
    }
}
