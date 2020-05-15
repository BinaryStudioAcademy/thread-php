<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LikeIsUniqueForUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // user can like smth only once
        Schema::table('likes', function(Blueprint $blueprint) {
            $blueprint->unique(['user_id', 'likeable_id', 'likeable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function(Blueprint $blueprint) {
            // need to drop foreign key before we can drop unique index
            $blueprint->dropForeign('likes_user_id_foreign');
            $blueprint->dropUnique(['user_id', 'likeable_id', 'likeable_type']);
            $blueprint
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }
}
