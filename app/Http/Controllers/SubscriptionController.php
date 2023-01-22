<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Services\SubscriptionService;
use Braintree\Exception\NotFound;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * @param SubscriptionService $subscriptionService
     */
    public function __construct(protected SubscriptionService $subscriptionService)
    {
    }

    /**
     * @param SubscriptionRequest $request
     * @return RedirectResponse
     * @throws NotFound
     */
    public function store(SubscriptionRequest $request): RedirectResponse
    {
        $this->subscriptionService->setUserSubscription($request->plan);

        return redirect()->to('/home');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $this->subscriptionService->cancelUserSubscription($request->plan);

        return redirect()->to('/home');
    }
}
