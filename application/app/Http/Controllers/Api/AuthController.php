<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Core\Access;
use App\Models\Api\Core\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function redirect(Request $request)
    {
        Log::info(__METHOD__, $request->toArray());
        
        try {

            $account = Auth::user()->account;

            if ($account) {
                $account->client_id = $request->client_id;
                $account->code = $request->code;
                $account->save();

                $this->amoApi->init($access);

                $setting = $account->setting;

                $setting->updateStatuses($this->amoApi);

                $setting->updatePipelines($this->amoApi);

                $setting->updateStaffs($this->amoApi);
            }

//            if($request->get('state') == 'reconnect') {
//
//                $this->amoApi->init($account);
//
//                $setting = $account->account;
//
//                $setting->updateStatuses($this->amoApi);
//
//                $setting->updatePipelines($this->amoApi);
//
//                $setting->updateStaffs($this->amoApi);
//            }

            return view('redirect');

        } catch (\Exception $exception) {
            
            dd($exception->getMessage().' > '.$exception->getFile().' > '.$exception->getLine());
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
}
//TODO пуши в телегу