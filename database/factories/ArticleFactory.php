<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->word(1),
            'address'=> fake()->city,
            'content' => fake()->paragraph,
            'category_id'=> rand(1, Category::count()),
            'user_id'=> rand(1, User::count()),
            'price' => fake()->randomFloat(2, 10, 9999),
            'created_at'=>fake()->date('Y-m-d'),
        ];
    }
}
