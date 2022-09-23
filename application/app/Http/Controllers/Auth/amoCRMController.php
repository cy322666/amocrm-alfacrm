<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AlfaCRM\Field;
use App\Models\User;
use App\Services\AlfaCRM\Models\Branch;
use App\Services\AlfaCRM\Models\Customer;
use App\Services\amoCRM\Client;
use App\Services\amoCRM\EloquentStorage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\AlfaCRM\Client as alfaApi;

use App\Services\amoCRM\Client as amoApi;

class amoCRMController extends Controller
{
    /**
     * @throws Exception
     */
    public function redirect(Request $request)
    {
        Log::info(__METHOD__, $request->toArray());

        if ($request->state !== 'hello') {

            redirect(route('account'), ['auth' => 2]);
        }

        $account = Auth::user()->amoAccount();

        $subdomain = explode('.', $request->referer)[0];

        if (Account::query()
            ->where('subdomain', $subdomain)
            ->where('user_id', '!=', Auth::user()->id)
            ->first()) {

            return redirect()->route('account', ['auth' => 2]);
        }

        $account->client_secret = config('services.amocrm.client_secret');
        $account->subdomain = $subdomain;
        $account->code = $request->code;
        $account->client_id = $request->client_id;
        $account->save();

        try {
            $amoApi = (new amoApi($account))->init();

            if ($amoApi->auth == true) {

                $account->active = true;
                $account->save();
            } else {
                return redirect()->route('account', ['auth' => 0]);
            }

            return redirect()->route('account', ['auth' => 1]);

        } catch (\Throwable $exception) {

            Log::error(__METHOD__.' : '.$exception->getMessage());

            return redirect()->route('account', ['auth' => 0]);
        }
    }

    public function secrets(Request $request)
    {
        Log::info(__METHOD__, $request->toArray());

//        $user = User::query()
//            ->where('email', $request->account)
//            ->first();
//
//        $account = $user->amoAccount();
//        $account->client_secret = $request->client_secret;
//        $account->save();
    }

    public function off(Request $request)
    {
        Log::info(__METHOD__, $request->toArray());
    }
}
