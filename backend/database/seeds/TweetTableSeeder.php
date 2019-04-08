<?php

use App\Entity\Tweet;
use App\Entity\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TweetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $tweets = $users->map(
            function (User $user) {
                // create 2 tweets for each fake user
                return factory(Tweet::class, 2)->make([
                    'author_id' => $user->id
                ]);
            }
        );

        // insert all data in one db query to speed up performance a bit
        DB::table('tweets')->insert($tweets->flatten()->toArray());
    }
}
