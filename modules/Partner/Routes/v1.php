<?php

use Illuminate\Support\Facades\Route;
use Modules\Partner\Http\Controllers\V1\AuthController;

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

/** @see AuthController::login() */
Route::post('login', [AuthController::class, 'login']);
/** @see AuthController::logout() */
Route::post('logout', [AuthController::class, 'logout']);
