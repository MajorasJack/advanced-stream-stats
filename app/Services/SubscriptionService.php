<?php

namespace App\Services;

use Braintree\Exception\NotFound;
use Braintree\Gateway;
use Braintree\Result\Error;
use Braintree\Result\Successful;
use Braintree\Subscription;
use App\Models\Subscription as SubscriptionModel;
use InvalidArgumentException;

class SubscriptionService
{
    protected Gateway $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => config('braintree.gateway.merchant_id'),
            'publicKey' => config('braintree.gateway.public_key'),
            'privateKey' => config('braintree.gateway.private_key'),
        ]);

    }

    /**
     * @return SubscriptionModel|null
     * @throws NotFound
     */
    public function externalSubscriptionToEloquentModel(): ?SubscriptionModel
    {
        if (!$this->getUsersSubscription()) {
            return null;
        }

        return SubscriptionModel::where('external_subscription_id', $this->getUsersSubscription()->planId)->first();
    }

    /**
     * @return Subscription|null
     */
    public function getUsersSubscription(): ?Subscription
    {
        try {
            $customer = $this->gateway->customer()->find(auth()->user()->getExternalCustomerId());
        } catch (InvalidArgumentException|NotFound) {
            return null;
        }

        return array_values(
            array_filter($customer->defaultPaymentMethod()->subscriptions, function (Subscription $subscription) {
                return $subscription->status === 'Active';
            })
        )[0] ?? null;
    }

    /**
     * @param string $subscription
     * @return Error|Successful
     * @throws NotFound
     */
    public function setUserSubscription(string $subscription): Error|Successful
    {
        $customer = $this->gateway->customer()->find(auth()->user()->getExternalCustomerId());

        return $this->gateway->subscription()->create([
            'paymentMethodToken' => $customer->defaultPaymentMethod()->token,
            'planId' => $subscription,
        ]);
    }

    /**
     * @param string $subscription
     * @return Error|Successful
     */
    public function cancelUserSubscription(string $subscription): Error|Successful
    {
        return $this->gateway->subscription()->cancel($subscription);
    }
}
