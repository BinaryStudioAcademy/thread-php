<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $likeable = $this->faker->randomElement([
            Tweet::class,
            Comment::class
        ]);

        return [
            'user_id' => User::factory(),
            'likeable_id' => $likeable::factory(),
            'likeable_type' => $likeable,
            'created_at' => Carbon::now(),
        ];
    }
}
