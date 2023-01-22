<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TwitchAuthenticationController;
use App\Http\Controllers\TwitchAuthenticationRedirectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', fn () => view('login'))->name('login');

Route::get('/twitch/authenticate', TwitchAuthenticationController::class)
    ->name('twitch.authenticate');

Route::get('/twitch/redirect', TwitchAuthenticationRedirectController::class)
    ->name('twitch.redirect');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
