<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;

class AlfaAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return mixed|void
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->webhook->type   === 'status_record' &&
            $request->webhook->active === true) {

            return $next($request);
        } else
            dd('false');
        //TODO убить редирект
        //TODO уведомление?
    }
}
