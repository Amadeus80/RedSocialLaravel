<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->unique()->sentence(),
            'img' => 'img/posts/'.$this->faker->image("public/img/posts", 640, 480, null, false),
            'likes' => rand(1, 100),
            'user_id' => User::all()->random()->id,
        ];
    }
}
