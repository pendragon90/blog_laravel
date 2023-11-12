<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 150),
            'title' => $title = fake()->sentence(5),
            'slug' => Str::slug($title . '-' . Str::random(4)),
            'category_id' => rand(1, 4),
            'img' => '',
            'content' => fake()->sentence(25)
        ];
    }
}
