<?php

use App\Entity\Comment;
use App\Entity\Like;
use App\Entity\Tweet;
use App\Entity\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikesSeeder extends Seeder
{
    private const LIKES_COUNT = 5;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tweets = Tweet::all();
        $users = User::all();
        $comments = Comment::all();

        $tweetLikes = $tweets->map(
            function(Tweet $tweet) use($users) {
                return factory(Like::class, self::LIKES_COUNT)->make([
                    'user_id' => $users->random()->id,
                    'likeable_id' => $tweet->id,
                    'likeable_type' => Tweet::class,
                ]);
            }
        );

        $commentLikes = $comments->map(
            function(Comment $comment) use($users) {
                return factory(Like::class, self::LIKES_COUNT)->make([
                    'user_id' => $users->random()->id,
                    'likeable_id' => $comment->id,
                    'likeable_type' => Comment::class,
                ]);
            }
        );

        DB::table('likes')->insert($tweetLikes->flatten()->merge($commentLikes->flatten())->toArray());
    }
}
