<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\SubscriptionService;
use Braintree\Exception\NotFound;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * @param SubscriptionService $subscriptionService
     */
    public function __construct(protected SubscriptionService $subscriptionService)
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     * @throws NotFound
     */
    public function index(): Renderable
    {
        return view('home', [
            'subscriptions' => Subscription::all(),
            'currentSubscription' => $this->subscriptionService->getUsersSubscription(),
            'currentSubscriptionModel' => $this->subscriptionService->brainTreeSubscriptionToEloquentModel(),
        ]);
    }
}
