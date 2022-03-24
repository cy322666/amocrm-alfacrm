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

Route::screen('/main', PlatformScreen::class)->name('platform.main');

Route::screen('profile', UserProfileScreen::class)->name('platform.profile');

Route::screen('users/{user}/edit', UserEditScreen::class)->name('platform.systems.users.edit');

Route::screen('users/create', UserEditScreen::class)->name('platform.systems.users.create');

Route::screen('users', UserListScreen::class)->name('platform.systems.users');

Route::screen('roles/{roles}/edit', RoleEditScreen::class)->name('platform.systems.roles.edit');

Route::screen('roles/create', RoleEditScreen::class)->name('platform.systems.roles.create');

Route::screen('roles', RoleListScreen::class)->name('platform.systems.roles');

Route::screen('roles', RoleListScreen::class)->name('users.roles');


Route::screen('example', ExampleScreen::class)->name('platform.example');
Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');


Route::screen('bizon/orders/webinars', WebinarIndexScreen::class)->name('bizon.orders.webinars');

Route::screen('bizon/orders/{webinar}/viewers', ViewerIndexScreen::class)->name('bizon.orders.viewers');

Route::screen('bizon/orders/{viewer}', ViewerDetailScreen::class)->name('bizon.orders.viewers.detail');

Route::screen('bizon/analytics', BizonAnalyticsScreen::class)->name('bizon.analytics.index');

Route::screen('bizon/connect', BizonConnectScreen::class)->name('bizon.connect.index');

Route::screen('bizon/settings', BizonSettingScreen::class)->name('bizon.setting.index');

Route::screen('logs/amocrm', LogAmoCRMScreen::class)->name('logs.amocrm.index');

Route::screen('logs/errors', LogErrorsScreen::class)->name('logs.errors.index');

Route::screen('account', AccountIndexScreen::class)->name('account.index');

Route::screen('account/pay', AccountIndexPay::class)->name('account.pay');

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