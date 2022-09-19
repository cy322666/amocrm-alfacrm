<?php

namespace App\Http\Controllers\Auth;

use App\Models\Account;
use App\Models\AlfaCRM\Setting;
use App\Models\User;
use App\Notifications\HelloMessage;
use App\Services\ManagerClients\AlfaCRMManager;
use App\Services\ManagerClients\BizonManager;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Orchid\Platform\Http\Controllers\LoginController;

class AuthController extends LoginController
{
    /**
     * Create a new controller instance.
     *
//     * @param \Illuminate\Contracts\Auth\Factory $auth
     */
    public function __construct()
    {
        $this->guard = Auth::guard(config('platform.guard'));

        $this->middleware('guest', [
            'except' => [
                'logout',
                'switchLogout',
            ],
        ]);
    }

    public function signupForm(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.signup');
    }

    public function resetForm(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.passwords.reset');
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse|RedirectResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $auth = $this->guard->attempt(
            $request->only(['email', 'password']),
            $request->filled('remember')
        );

        if ($auth) {
            return $this->sendLoginResponse($request);
        }

        throw ValidationException::withMessages([
            'email'    => __('Введенный email не найден'),
            'password' => __('Минимум 6 символов'),
        ]);
    }

    public function loginForm(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
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

    public function signupRegister(Request $request): RedirectResponse
    {
        $request->validate([
            'name'  => 'required|min:4',
            'email' => [
                'required',
                Rule::unique(User::class, 'email'),//->ignore($user),
            ],
            'password' => 'required|min:6',
        ]);

        $user = User::query()->create([
            'email'    => $request->post('email'),
            'name'     => $request->post('name'),
            'password' => Hash::make($request->post('password')),
            'permissions' => ['platform.index' => true],
        ]);

        $user->amoAccount()->create([
            'name' => 'amocrm',
            'client_secret' => Config::get('services.amocrm.client_secret'),
        ]);

        AlfaCRMManager::register($user);

        BizonManager::register($user);

        $user->notify(new HelloMessage());

        return redirect()->route('auth.login');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function showLoginForm(Request $request): Factory|View
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

    public function unauthorized()
    {
        return view('exception.401');
    }

    public function drop(Request $request)
    {
        return redirect()->route('auth.login')->withCookie(Cookie::forget('lockUser'));//->withCookie(Cookie::forget('cavuser'));
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        return redirect()
            ->route('auth.login')
            ->withCookie(Cookie::forget('lockUser'))
            ->withCookie(Cookie::forget('cavuser'));
    }
}
