<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BizonController;
use App\Http\Controllers\Api\CronController;
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

/* AMOCRM */
Route::get('/install', [AuthController::class, 'installAction']);

Route::post('/amocrm/secrets', [AuthController::class, 'secrets']);

/* BIZON */
Route::post('/bizon/hook/{account:endpoint}', [BizonController::class, 'hook']);//TODO user::endpoint

Route::post('/bizon/cron/viewers', [BizonController::class, 'cron']);

/* CRON */
Route::post('/cron/tariff', [CronController::class, 'tariff']);

Route::get('/test', [CronController::class, 'test']);
