<?php

namespace Database\Seeders;

use \App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        //create admin
        User::create([
            'last_name' => 'Sophie',
            'first_name' => 'Byd',
            'birthday' => '1995-08-02',
            'phone' => fake()->phoneNumber(),
            'email' => 'sbouyaud@arinfo.fr',
            'email_verified_at' => now(),
            'picture' => 'default.png',
            'banned' => false,
            'password' => '123arinfo@',
            'remember_token' => Str::random(10),
            'role_id' => 1,
        ]);

        //create user
        User::create([
            'last_name' => 'John',
            'first_name' => 'Doe',
            'birthday' => '1995-08-02',
            'phone' => fake()->phoneNumber(),
            'email' => 'johndoe@arinfo.fr',
            'email_verified_at' => now(),
            'picture' => 'default.png',
            'banned' => false,
            'password' => '456arinfo@',
            'remember_token' => Str::random(10),
            'role_id' => 2,
        ]);

        User::create([
            'last_name' => 'Joseph',
            'first_name' => 'Doe',
            'birthday' => '1995-08-02',
            'phone' => fake()->phoneNumber(),
            'email' => 'josephdoe@arinfo.fr',
            'email_verified_at' => now(),
            'picture' => 'default.png',
            'banned' => false,
            'password' => '789arinfo@',
            'remember_token' => Str::random(10),
            'role_id' => 3,
        ]);

        // create random users
        User::factory(80)->create();
    }
}
