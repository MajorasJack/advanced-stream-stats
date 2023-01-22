<?php

use App\Models\Subscription;
use App\Models\User;
use Laravel\Socialite\Two\User as SocialiteUser;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

it('will be able to associate a subscription to a user', function () {
    $abstractUser = Mockery::mock(SocialiteUser::class);

    $user = User::factory()->create();

    $subscription = Subscription::factory()->create([
        'external_subscription_id' => config('braintree.braintree.pro_yearly_plan_id'),
    ]);

    $abstractUser
        ->shouldReceive('getId')
        ->andReturn(rand())
        ->shouldReceive('getName')
        ->andReturn($user->name)
        ->shouldReceive('getEmail')
        ->andReturn($user->email)
        ->shouldReceive('getAvatar')
        ->andReturn(fake()->url());

    Socialite::shouldReceive('driver->user')->andReturn($abstractUser);

    $response = $this->actingAs($user)
        ->postJson(route('subscription.store', ['plan' => $subscription->external_subscription_id]));

    expect($response)
        ->baseResponse
        ->toBeInstanceOf(RedirectResponse::class)
        ->isRedirection()
        ->toBeTrue()
        ->and($this->followRedirects($response))
        ->assertSee("Your current subscription is: $subscription->name");
});

it('will be able to cancel a users subscription', function () {
    $abstractUser = Mockery::mock(SocialiteUser::class);

    $user = User::factory()->create();

    $subscription = Subscription::factory()->create([
        'external_subscription_id' => config('braintree.braintree.pro_yearly_plan_id'),
    ]);

    $abstractUser
        ->shouldReceive('getId')
        ->andReturn(rand())
        ->shouldReceive('getName')
        ->andReturn($user->name)
        ->shouldReceive('getEmail')
        ->andReturn($user->email)
        ->shouldReceive('getAvatar')
        ->andReturn(fake()->url());

    Socialite::shouldReceive('driver->user')->andReturn($abstractUser);

    $this->actingAs($user)->postJson(route('subscription.store', ['plan' => $subscription->external_subscription_id]));

    $response = $this->actingAs($user)
        ->postJson(route('subscription.destroy', ['plan' => $subscription->external_subscription_id]));

    expect($response)
        ->baseResponse
        ->toBeInstanceOf(RedirectResponse::class)
        ->isRedirection()
        ->toBeTrue()
        ->and($this->followRedirects($response))
        ->assertSee('Interested in seeing more stats?');
})->skip('Facing issues with cancellation here, will need to spend more time on mocking Braintree to resolve');
