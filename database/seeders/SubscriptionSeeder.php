<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Types\SubscriptionTypes;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::insert([
            [
                'name' => SubscriptionTypes::STARTER_MONTHLY_STRING,
                'external_subscription_id' => config('payments.braintree.starter_plan_id'),
                'price' => '€3',
                'yearly' => false,
            ],
            [
                'name' => SubscriptionTypes::PRO_MONTHLY_STRING,
                'external_subscription_id' => config('payments.braintree.pro_monthly_plan_id'),
                'price' => '€6',
                'yearly' => false,
            ],
            [
                'name' => SubscriptionTypes::PRO_YEARLY_STRING,
                'external_subscription_id' => config('payments.braintree.pro_yearly_plan_id'),
                'price' => '€60',
                'yearly' => true,
            ]
        ]);
    }
}
