<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
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

        foreach ($tweets as $tweet) {
            foreach ($users->random(3) as $user) {
                Comment::factory()
                    ->for($tweet)
                    ->for($user, 'author')
                    ->create();
            }
        }
    }
}
