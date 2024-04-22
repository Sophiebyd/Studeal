<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= User::count(); $i++) {
            DB::table('favorites')->insert([
                'user_id' => $i,
                'article_id' => rand(1, Article::count()),
            ]);
        }
    }
}
