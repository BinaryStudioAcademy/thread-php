<?php

use App\Entity\Comment;
use App\Entity\Tweet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tweets = Tweet::all();

        $comments = $tweets->map(
            function (Tweet $tweet) {
                return factory(Comment::class, 3)->make([
                    'tweet_id' => $tweet->id
                ]);
            }
        );

        DB::table('comments')->insert($comments->flatten()->toArray());
    }
}
