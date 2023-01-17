<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class TwitchAuthenticationRedirectController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        try {
            $socialiteUser = Socialite::driver('twitch')->user();

            $user = User::firstOrCreate([
                'name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
            ]);

            auth()->login($user);

            return redirect()->to('/home');
        } catch (InvalidStateException) {
            return redirect()->to('/');
        }
    }
}
