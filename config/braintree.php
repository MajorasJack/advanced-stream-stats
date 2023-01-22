<?php

return [
    'braintree' => [
        'starter_plan_id' => env('BRAINTREE_STARTER_PLAN_ID'),
        'pro_monthly_plan_id' => env('BRAINTREE_PRO_MONTHLY_PLAN_ID'),
        'pro_yearly_plan_id' => env('BRAINTREE_PRO_YEARLY_ID'),
    ],
    'gateway' => [
        'merchant_id' => env('BRAINTREE_MERCHANT_ID'),
        'public_key' => env('BRAINTREE_PUBLIC_KEY'),
        'private_key' => env('BRAINTREE_PRIVATE_KEY'),
        'sandbox_customer_id' => env('BRAINTREE_SANDBOX_CUSTOMER_ID'),
    ],
];
