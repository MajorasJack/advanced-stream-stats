<?php

use App\Http\Controllers\TwitchAuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TwitchAuthenticationRedirectController;

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

Route::get('/twitch/authenticate', TwitchAuthenticationController::class)
    ->name('twitch.authenticate');

Route::get('/twitch/redirect', TwitchAuthenticationRedirectController::class)
    ->name('twitch.redirect');
