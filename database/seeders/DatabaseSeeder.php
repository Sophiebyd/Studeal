<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() 
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            NotificationSeeder::class,
            CategorySeeder::class,
            ArticleSeeder::class,
            PictureSeeder::class,
            FavoriteSeeder::class,
            MessageSeeder::class,
            CommandSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
