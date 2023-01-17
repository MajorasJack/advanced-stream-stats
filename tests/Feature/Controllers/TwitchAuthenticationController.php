<?php

use Illuminate\Http\RedirectResponse;

it('will redirect the user to twitch authentication as expected', function () {
    expect($this->get(route('twitch.authenticate')))
        ->baseResponse
        ->toBeInstanceOf(RedirectResponse::class)
        ->isRedirection()
        ->toBeTrue();
});
