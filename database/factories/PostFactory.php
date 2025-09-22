<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'is_active' => $this->faker->boolean(),
            'views' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'category_id' => Category::factory(),
        ];
    }
}
