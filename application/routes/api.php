<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlfaCRMController;
use App\Http\Controllers\Auth\amoCRMController;

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
