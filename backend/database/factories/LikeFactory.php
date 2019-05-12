<?php

/* @var $factory Factory */

use App\Entity\Like;
use App\Entity\Tweet;
use App\Entity\Comment;
use App\Entity\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Like::class, function (Faker $faker) {
    $now = Carbon::now();

    // return likeable entity randomly to create any like
    $entity = $faker->randomElement([new Tweet(), new Comment()]);

    return [
        'user_id' => User::query()->inRandomOrder()->first()->id,
        'likeable_id' => $entity->query()->inRandomOrder()->first()->id,
        'likeable_type' => get_class($entity),
        'created_at' => $now->toDateTimeString()
    ];
});
