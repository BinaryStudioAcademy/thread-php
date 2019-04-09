<?php

use App\Entity\Comment;
use App\Entity\Tweet;
use App\Entity\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $now = Carbon::now();

    return [
        'body' => $faker->text(),
        'author_id' => User::query()->inRandomOrder()->first()->id,
        'tweet_id' => Tweet::query()->inRandomOrder()->first()->id,
        'created_at' => $now->toDateTimeString(),
    ];
});
