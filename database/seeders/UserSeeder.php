<?php

namespace Database\Seeders;

use \App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * The current password being used by the seeder.
     */
    protected static ?string $password;

    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        //create users
        User::create([
            'lastname' => fake()->lastName,
            'firstname' => fake()->firstName,
            'birthdate' => fake()->date('d/m/Y'),
            'phone' => fake()->phoneNumber,
            'mail' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'picture' => fake()->imageUrl(),
            'banned' => false,
            'password' => static::$password ?: static::$password = Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => fake()->numberBetween(1, 3),
        ]);

        // create random users
        User::factory(20)->create();
    }
}
