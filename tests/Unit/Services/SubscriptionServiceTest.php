<?php

use App\Models\Subscription;
use App\Services\SubscriptionService;
use Braintree\Exception\NotFound;
use Braintree\Result\Successful;
use Braintree\Result\Error;

beforeEach(fn () => $this->service = app(SubscriptionService::class));

it('will return null when the users subscription does not exist in braintree or the database', function () {
    expect($this->service->externalSubscriptionToEloquentModel())->toBeNull();
});

it('will return the right eloquent model when the users subscription does exist in braintree', function () {
    $subscription = Subscription::factory()->create([
        'external_subscription_id' => config('braintree.braintree.pro_yearly_plan_id'),
    ]);

    expect($this->service->externalSubscriptionToEloquentModel())
        ->id
        ->toBe($subscription->id)
        ->price
        ->toBe($subscription->price)
        ->external_subscription_id
        ->toBe($subscription->external_subscription_id);
});

it('will return null when the plan stored in the database does not exist', function () {
    Subscription::factory()->create(['external_subscription_id' => fake()->randomNumber()]);

    expect($this->service->externalSubscriptionToEloquentModel())->toBeNull();
});

it('will return null when the user does not exist in braintree', function () {
    config()->set('braintree.gateway.sandbox_customer_id');

    expect($this->service->getUsersSubscription())->toBeNull();
});

it('will create a subscription against a user as expected when using a valid external_subscription_id', function () {
    $subscription = Subscription::factory()->create();

    expect($this->service->setUserSubscription($subscription->external_subscription_id))->toBeInstanceOf(Successful::class);
});

it('will fail to create a subscription against a user when the external_subscription_id is invalid', function () {
    expect($this->service->setUserSubscription(fake()->uuid()))->toBeInstanceOf(Error::class);
});

it('will cancel a users subscription as expected when using a valid external_subscription_id', function () {
    $subscription = Subscription::factory()->create([
        'external_subscription_id' => config('braintree.braintree.pro_yearly_plan_id'),
    ]);

    expect($this->service->setUserSubscription($subscription->external_subscription_id))
        ->toBeInstanceOf(Successful::class)
        ->and($this->service->cancelUserSubscription($subscription->external_subscription_id))
        ->toBeInstanceOf(Successful::class);

})->skip('Facing issues with cancellation here, will need to spend more time on mocking Braintree to resolve');

it('will fail to cancel a users subscription as expected when the external_subscription_id is invalid', function () {
    $this->service->cancelUserSubscription(fake()->uuid());
})->throws(NotFound::class);
