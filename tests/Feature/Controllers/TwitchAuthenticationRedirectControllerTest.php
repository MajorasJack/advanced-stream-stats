<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Socialite\Facades\Socialite;

uses(WithFaker::class);

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
    $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');

    $name = $this->faker->name();
    $email = $this->faker->email();

    $abstractUser
        ->shouldReceive('getId')
        ->andReturn(rand())
        ->shouldReceive('getName')
        ->andReturn($name)
        ->shouldReceive('getEmail')
        ->andReturn($email)
        ->shouldReceive('getAvatar')
        ->andReturn($this->faker->url());

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
        ->assertSee('You are logged in!');
});
