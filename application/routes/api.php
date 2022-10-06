<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlfaCRMController;
use App\Http\Controllers\Auth\amoCRMController;
use App\Http\Controllers\BizonController;
use App\Http\Controllers\GetCourseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/amocrm/secrets', [amoCRMController::class, 'secrets']);

/* ALFACRM */
Route::prefix('alfacrm')->group(function () {

    Route::middleware(['api.alfacrm'])->group(function () {

        Route::post('omission/{webhook:uuid}', [AlfaCRMController::class, 'omission'])
            ->name('alfacrm.omission');

        Route::post('record/{webhook:uuid}',   [AlfaCRMController::class, 'record'])
            ->name('alfacrm.record');

        Route::post('came/{webhook:uuid}',     [AlfaCRMController::class, 'came'])
            ->name('alfacrm.came');
    });
});

/* BIZON */
Route::post('/bizon/webinar/{webhook:uuid}', [BizonController::class, 'webinar'])
    ->name('bizon.webinar')
    ->middleware('api.bizon');

/* GETCOURSE */
Route::prefix('getcourse')->group(function () {

    Route::middleware(['api.getcourse'])->group(function () {

        Route::get('forms/{webhook:uuid}', [GetCourseController::class, 'forms'])
            ->name('getcourse.api.forms');

        Route::get('payments/{webhook:uuid}', [GetCourseController::class, 'payments'])
            ->name('getcourse.api.payments');

        Route::get('orders/{webhook:uuid}', [GetCourseController::class, 'orders'])
            ->name('getcourse.api.orders');
    });
});
