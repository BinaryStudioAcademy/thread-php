<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\TweetController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/me', [AuthController::class, 'me']);
        Route::put('/me', [AuthController::class, 'update']);
        Route::post('/me/image', [AuthController::class, 'uploadProfileImage']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['prefix' => '/users'], function () {
            Route::get('/', [UserController::class, 'getUserCollection']);
            Route::get('/{id}', [UserController::class, 'getUserById']);
            Route::get('/{id}/tweets', [TweetController::class, 'getTweetCollectionByUserId']);
        });

        Route::group(['prefix' => '/tweets'], function () {
            Route::get('/', [TweetController::class, 'getTweetCollection']);
            Route::post('/', [TweetController::class, 'addTweet']);
            Route::get('/{id}', [TweetController::class, 'getTweetById']);
            Route::get('/{id}/comments', [CommentController::class, 'getCommentCollectionByTweetId']);
            Route::post('/{id}/image', [TweetController::class, 'uploadTweetImage']);
            Route::put('/{id}', [TweetController::class, 'updateTweetById']);
            Route::delete('/{id}', [TweetController::class, 'deleteTweetById']);
            Route::put('/{id}/like', [LikeController::class, 'likeOrDislikeTweet']);
        });

        Route::group(['prefix' => '/comments'], function () {
            Route::get('/', [CommentController::class, 'getCommentCollection']);
            Route::get('/{id}', [CommentController::class, 'getCommentById']);
            Route::post('/', [CommentController::class, 'newComment']);
        });
    });
});
