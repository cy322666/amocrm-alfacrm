<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

use App\Orchid\Screens\Integrations\Bizon\ViewerIndexScreen;
use App\Orchid\Screens\Integrations\Bizon\WebinarIndexScreen;
use App\Orchid\Screens\Integrations\Bizon\BizonConnectScreen;
use App\Orchid\Screens\Integrations\Bizon\BizonAnalyticsScreen;
use App\Orchid\Screens\Integrations\Bizon\BizonSettingScreen;
use App\Orchid\Screens\LogAmoCRMScreen;
use App\Orchid\Screens\LogErrorsScreen;
use App\Orchid\Screens\AccountIndexScreen;
use App\Orchid\Screens\Integrations\Bizon\ViewerDetailScreen;
use App\Orchid\Screens\AccountIndexPay;

use App\Orchid\Controllers\AuthController;

//Route::middleware(['auth'])->group(function () {

//Route::screen('/notifications', PlatformScreen::class)->name('platform.main');

Route::get('/', function () {
    return view('site.index');
});

Route::get('lock', [AuthController::class, 'resetCookieLockMe'])->name('login.lock');
//});

Route::get('drop', [AuthController::class, 'drop'])->name('auth.drop');

Route::get('login', [AuthController::class, 'loginForm'])->name('auth.login');

Route::post('login-check', [AuthController::class, 'login'])->name('auth.check');

Route::post('signup/register', [AuthController::class, 'signupRegister'])->name('auth.register');

Route::get('unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');

Route::get('signup', [AuthController::class, 'signupForm'])->name('auth.signup');

Route::get('reset', [AuthController::class, 'resetForm'])->name('auth.reset');

Route::get('password', [AuthController::class, 'resetForm'])->name('password.update');

Route::post('switch-logout', [AuthController::class, 'switchLogout'])->name('switch.logout');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');