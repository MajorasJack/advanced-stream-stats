<?php

use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;

it('will redirect the user back to the application with an invalid login', function () {
    $response = $this->get(route('twitch.redirect'));

    expect($response)
        ->baseResponse
        ->toBeInstanceOf(RedirectResponse::class)
        ->isRedirection()
        ->toBeTrue()
        ->and($this->followRedirects($response))
        ->assertDontSee('You are logged in!');
});

it('will redirect the user back to the application with a valid login', function () {
    $abstractUser = Mockery::mock(SocialiteUser::class);

    $name = fake()->name();
    $email = fake()->email();

    $abstractUser
        ->shouldReceive('getId')
        ->andReturn(rand())
        ->shouldReceive('getName')
        ->andReturn($name)
        ->shouldReceive('getEmail')
        ->andReturn($email)
        ->shouldReceive('getAvatar')
        ->andReturn(fake()->url());

    Socialite::shouldReceive('driver->user')->andReturn($abstractUser);

    $response = $this->get(route('twitch.redirect'));

    $this->assertDatabaseHas('users', [
        'name' => $name,
        'email' => $email,
    ]);

    expect($response)
        ->baseResponse
        ->toBeInstanceOf(RedirectResponse::class)
        ->isRedirection()
        ->toBeTrue()
        ->and($this->followRedirects($response))
        ->assertSee('Interested in seeing more stats?');
});
