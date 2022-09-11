<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('site.index');
})->name('site');

Route::post('form', [\App\Http\Controllers\SiteController::class, 'form'])->name('form');

Route::get('platform/login', [AuthController::class, 'showLoginForm'])->name('auth.login');

Route::middleware('throttle:60,1')
    ->post('login', [AuthController::class, 'login'])
    ->name('login.auth');

Route::get('lock', [AuthController::class, 'resetCookieLockMe'])->name('login.lock');

Route::get('drop', [AuthController::class, 'drop'])->name('auth.drop');

Route::post('login-check', [AuthController::class, 'loginForm'])->name('auth.check');//TODO login

Route::post('signup/register', [AuthController::class, 'signupRegister'])->name('auth.register');

Route::get('unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');

Route::get('platform/signup', [AuthController::class, 'signupForm'])->name('auth.signup');

Route::get('reset', [AuthController::class, 'resetForm'])->name('auth.reset');

Route::get('password', [AuthController::class, 'resetForm'])->name('password.update');

Route::post('switch-logout', [AuthController::class, 'switchLogout'])->name('switch.logout');

Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('switch-logout', [AuthController::class, 'switchLogout']);
Route::post('switch-logout', [AuthController::class, 'switchLogout'])->name('switch.logout');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('amocrm/redirect', [\App\Http\Controllers\Auth\amoCRMController::class, 'redirect']);
