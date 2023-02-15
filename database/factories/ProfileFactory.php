<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{

    protected $model = Profile::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $cont = 0;
    public function definition()
    {
        $this->cont++;
        return [
            'fullname' => $this->faker->name(),
            'location' => $this->faker->randomElement(["Madrid", "Barcelona", "Sevilla", "Málaga", "Huelva", "Cádiz", "Dinamarca", "Galicia"]),
            'age' => rand(16, 100),
            'img' => 'img/profile/'.$this->faker->image("public/img/profile", 640, 480, null, false),
            'user_id' => $this->cont,
        ];
    }
}
