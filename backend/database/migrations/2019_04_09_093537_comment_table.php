<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->longText('body');
            $blueprint->unsignedBigInteger('author_id');
            $blueprint->unsignedBigInteger('tweet_id');
            $blueprint->timestamps();

            $blueprint
                ->foreign('author_id')
                ->references('id')
                ->on('users');

            $blueprint
                ->foreign('tweet_id')
                ->references('id')
                ->on('tweets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
