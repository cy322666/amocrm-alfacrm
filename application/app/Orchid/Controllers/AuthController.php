<?php


namespace App\Orchid\Controllers;

use App\Models\Api\Core\Account;
use App\Models\User;
use App\Notifications\HelloMessage;
use Carbon\Carbon;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Orchid\Platform\Http\Controllers\LoginController;

class AuthController extends LoginController
{
    public function signupForm(Request $request)
    {
        return view('auth.signup');
    }
    
    public function resetForm(Request $request)
    {
        return view('auth.passwords.reset');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:4',
        ]);
        
        $auth = $this->guard->attempt(
            $request->only(['email', 'password']),
            $request->filled('remember')
        );
        
        if ($auth) {
            return $this->sendLoginResponse($request);
        }
        
        throw ValidationException::withMessages([
            'email' => __('Введенный email не найден'),
            'password' => __('Минимум 6 символов'),
        ]);
    }
    
    public function loginForm(Request $request)
    {
        $user = $request->cookie('lockUser');
        
        /** @var EloquentUserProvider $provider */
        $provider = $this->guard->getProvider();
        
        $model = $provider->createModel()->find($user);
        
        return view('auth.login', [
            'isLockUser' => optional($model)->exists ?? false,
            'lockUser'   => $model,
        ]);
    }
    
    public function signupRegister(Request $request)
    {
        $request->validate([
            'name'    => 'required|min:4',
            'email'    => [
                'required',
                Rule::unique(User::class, 'email'),//->ignore($user),
            ],
            'password' => 'required|min:4',
        ]);
        
        $user = User::create([
            'email' => $request->post('email'),
            'name' => $request->post('name'),
            'password' => Hash::make($request->post('password')),
            'permissions' => ['platform.index' => 1],
            'uuid' => User::generateUuid(),
        ]);
        
        $account = $user->account()->create([
            //'redirect_uri'   => env('AMO_REDIRECT_URI'),
            'endpoint'       => Account::generateUuid(),
            'expires_tariff' => Carbon::now()->addDays(7)->format('Y-m-d H:i:s'),
        ]);
        
        $user->account_id = $account->id;
        $user->save();
        
        //$account->setting()->create([]);//TODO потом убрать
        
        $user->notify(new HelloMessage());
        
        return redirect()->route('auth.login');
    }
    
    public function unauthorized()
    {
        return view('exception.401');
    }
    
    public function drop(Request $request)
    {
        return redirect()->route('auth.login')->withCookie(Cookie::forget('lockUser'));//->withCookie(Cookie::forget('cavuser'));
    }
}