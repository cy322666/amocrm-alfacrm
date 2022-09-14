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

            redirect(route('account'), ['auth' => false]);
        }

        $account = Auth::user()->amoAccount();

        $account->code = $request->code;
        $account->client_id = $request->client_id;
        $account->save();

        try {
            (new amoApi($account))->init();

            return redirect()->route('account', ['auth' => true]);

        } catch (\Throwable $exception) {

            Log::error(__METHOD__.' : '.$exception->getMessage());

            return redirect()->route('account', ['auth' => false]);
        }
    }

    public function secrets(Request $request)
    {
        Log::info(__METHOD__, $request->toArray());

//        $user = User::where('uuid', $request->input('user'))->first();
//
//        $access = $user->access()->where('service_name', 'amocrm')->first();
//
//        if(!$access) {
//
//            $access = new Access();
//            $access->user_id = $user->id;
//            $access->account_id = $user->account->id;
//        }
//
//        $access->service_name = 'amocrm';
//        $access->client_secret = $request->client_secret;
//        $access->client_id = $request->client_id;
//        $access->subdomain = explode($request->referer, '.amocrm.')[0];
//        //$access->state = $request->post('state');
//        $access->save();
    }

    public function off(Request $request)
    {
        Log::info(__METHOD__, $request->toArray());
    }
}
