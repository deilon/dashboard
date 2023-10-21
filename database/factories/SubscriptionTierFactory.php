<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionTier>
 */
class SubscriptionTierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'subscription_plan_id' => 16, // Replace with the actual subscription plan ID
            // 'tier_name' => '2 Months',
            // 'price' => 1500,
            // 'status' => 'active',

            // 'subscription_plan_id' => 16, // Replace with the actual subscription plan ID
            // 'tier_name' => '3 Months',
            // 'price' => 2200,
            // 'status' => 'active',

            // 'subscription_plan_id' => 16, // Replace with the actual subscription plan ID
            // 'tier_name' => '6 Months',
            // 'price' => 2900,
            // 'status' => 'active',

            'subscription_plan_id' => 16, // Replace with the actual subscription plan ID
            'tier_name' => 'Annual',
            'price' => 5000,
            'status' => 'active',
        ];
    }
}
