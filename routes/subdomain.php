<?php

use Illuminate\Support\Facades\Route;
use Modules\Partner\Http\Controllers\V1\AuthController;

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

/** @see AuthController::redirectToProvider() */
Route::get('/login/{provider}', [AuthController::class, 'redirectToProvider'])
    ->name('provider.login')
    ->where('provider', 'line');

/** @see AuthController::socialLogin() */
Route::get('/login/{provider}/callback', [AuthController::class, 'socialLogin'])
    ->name('provider.callback')
    ->where('provider', 'line');
