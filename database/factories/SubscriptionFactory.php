<?php

namespace Database\Factories;

use App\Types\SubscriptionTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(SubscriptionTypes::PLAN_STRING_MAP),
            'price' => fake()->randomNumber(2),
            'braintree_id' => fake()->randomElement([
                config('braintree.braintree.starter_plan_id'),
                config('braintree.braintree.pro_monthly_plan_id'),
                config('braintree.braintree.pro_yearly_plan_id'),
            ]),
            'yearly' => fake()->boolean(),
        ];
    }
}
