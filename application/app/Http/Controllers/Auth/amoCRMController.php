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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\AlfaCRM\Client as alfaApi;

use App\Services\amoCRM\Client as amoApi;

class amoCRMController extends Controller
{
    public function redirect(Request $request, amoApi $amocrm, alfaApi $alfaApi)
    {
        Log::info(__METHOD__, $request->toArray());
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
}
