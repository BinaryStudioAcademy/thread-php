<?php

use App\Entity\Comment;
use App\Entity\Like;
use App\Entity\Tweet;
use App\Entity\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeTableSeeder extends Seeder
{
    private const LIKES_COUNT = 10;

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
        $now = Carbon::now();

        $tweetLikes = $tweets->map(
            function(Tweet $tweet) use($users, $now) {
                $userIds = $users->shuffle()->shuffle()->take(self::LIKES_COUNT)->pluck('id');

                return $userIds->map(
                    function(int $userId) use($tweet, $now) {
                        return [
                            'user_id' => $userId,
                            'likeable_id' => $tweet->id,
                            'likeable_type' => Tweet::class,
                            'created_at' => $now->toDateTimeString()
                        ];
                    }
                );
            }
        );

        $commentLikes = $comments->map(
            function(Comment $comment) use($users, $now) {
                $userIds = $users->shuffle()->shuffle()->take(self::LIKES_COUNT)->pluck('id');

                return $userIds->map(
                    function(int $userId) use($comment, $now) {
                        return [
                            'user_id' => $userId,
                            'likeable_id' => $comment->id,
                            'likeable_type' => Comment::class,
                            'created_at' => $now->toDateTimeString()
                        ];
                    }
                );
            }
        );

        DB::table('likes')->insert(
            $tweetLikes
                ->flatten(1)
                ->merge($commentLikes->flatten(1))
                ->toArray()
        );
    }
}
