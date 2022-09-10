<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Octane\Exceptions\DdException;

class AlfaAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return mixed|void
     * @throws DdException
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info($request->path(), $request->toArray());

        if ($request->webhook->active === true) {

            return $next($request);
        } else
            dd('false');
        //TODO убить редирект
        //TODO уведомление?
    }
}
