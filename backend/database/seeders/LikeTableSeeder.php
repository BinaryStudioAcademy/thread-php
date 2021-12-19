<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $tweets = Tweet::all();
        $comments = Comment::all();

        foreach ($tweets->random(20) as $tweet) {
            foreach ($users->random(10) as $user) {
                Like::factory()
                    ->for($user)
                    ->for($tweet, 'likeable')
                    ->create();
            }
        }

        foreach ($comments->random(20) as $comment) {
            foreach ($users->random(10) as $user) {
                Like::factory()
                    ->for($user)
                    ->for($comment, 'likeable')
                    ->create();
            }
        }
    }
}
