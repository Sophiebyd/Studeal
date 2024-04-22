<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'birthday' => fake()->date('d/m/Y'),
            'picture' => fake()->imageUrl(),
            'phone' => fake()->phoneNumber,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'banned' => fake()->randomElement([true, false]),
            'password' => static::$password ?: static::$password = Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => fake()->numberBetween(1, 3),
        ];
    }
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
