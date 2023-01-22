<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse as IlluminateRedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TwitchAuthenticationController extends Controller
{
    /**
     * @return RedirectResponse|IlluminateRedirectResponse
     */
    public function __invoke(): RedirectResponse|IlluminateRedirectResponse
    {
        return Socialite::driver('twitch')->redirect();
    }
}
