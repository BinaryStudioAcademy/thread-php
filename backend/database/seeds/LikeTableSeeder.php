<?php

use App\Entity\Comment;
use App\Entity\Like;
use App\Entity\Tweet;
use App\Entity\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeTableSeeder extends Seeder
{
    private const MIN_LIKES_COUNT = 1;
    private const MAX_LIKES_COUNT = 5;

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
                $likesCount = random_int(self::MIN_LIKES_COUNT, self::MAX_LIKES_COUNT);

                return factory(Like::class, $likesCount)->make([
                    'user_id' => $users->random()->id,
                    'likeable_id' => $tweet->id,
                    'likeable_type' => Tweet::class,
                ]);
            }
        );

        $commentLikes = $comments->map(
            function(Comment $comment) use($users) {
                $likesCount = random_int(self::MIN_LIKES_COUNT, self::MAX_LIKES_COUNT);

                return factory(Like::class, $likesCount)->make([
                    'user_id' => $users->random()->id,
                    'likeable_id' => $comment->id,
                    'likeable_type' => Comment::class,
                ]);
            }
        );

        DB::table('likes')->insert($tweetLikes->flatten()->merge($commentLikes->flatten())->toArray());
    }
}
