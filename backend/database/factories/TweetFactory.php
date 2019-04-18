<?php

use App\Entity\Tweet;
use App\Entity\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Tweet::class, function (Faker $faker) {
    $now = Carbon::now();

    return [
        'text' => $faker->text(),
        'author_id' => User::query()->inRandomOrder()->first()->id,
        'image_url' => random_int(0, 1) ? $faker->unique()->imageUrl() : null,
        'created_at' => $now->toDateTimeString(),
    ];
});
