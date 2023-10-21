<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('en_PH');
        return [
            'firstname' => $faker->firstNameMale(),
            'lastname' => $faker->lastName(),
            'middlename' => $faker->lastName(),
            'email' => $faker->unique()->safeEmail(),
            'phone_number' => $faker->mobileNumber(),
            'country' => $faker->country(),
            'city' => $faker->city(),
            'address' => $faker->address(),
            'role' => 'member',
            'status' => 'active',
            'email_verified_at' => now(),
            'password' => '$2y$10$2BAv1ZMktIOvin8NphwQwOT5Em1mj7nKnX3LLSjpi5gM42jqCou9.', // password123#
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
