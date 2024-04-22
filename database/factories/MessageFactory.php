<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content'=> fake()->paragraph(2),
            'user1_id'=>rand(1, User::count()),
            'user2_id'=>rand(1, User::count()),
            'article_id'=>rand(1, Article::count())
        ];
    }
}
