<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TweetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->text(),
            'author_id' => User::factory(),
            'image_url' => $this->faker->randomElement([true, false])
                ? $this->faker->unique()->picsumUrl()
                : null,
        ];
    }
}
