<?php

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
    Route::group(['prefix' => 'auth', 'namespace' => 'Api\\Auth'], function () {
        Route::post('/register', 'AuthController@register');
        Route::post('/login', 'AuthController@login');
        Route::get('/me', 'AuthController@me');
        Route::put('/me', 'AuthController@update');
        Route::post('/me/image', 'AuthController@uploadProfileImage');
        Route::post('/logout', 'AuthController@logout');
    });

    Route::group([
        'middleware' => 'auth:api',
        'namespace' => 'Api\\'
    ], function () {
        Route::group([
            'prefix' => '/users',
        ], function () {
            Route::get('/', 'UserController@getUserCollection');
            Route::get('/{id}', 'UserController@getUserById');
            Route::get('/{id}/tweets', 'TweetController@getTweetCollectionByUserId');
        });

        Route::group([
            'prefix' => '/tweets',
        ], function () {
            Route::get('/', 'TweetController@getTweetCollection');
            Route::post('/', 'TweetController@addTweet');
            Route::get('/{id}', 'TweetController@getTweetById');
            Route::get('/{id}/comments', 'CommentController@getCommentCollectionByTweetId');
            Route::post('/{id}/image', 'TweetController@uploadTweetImage');
            Route::put('/{id}', 'TweetController@updateTweetById');
        });

        Route::group([
            'prefix' => '/comments',
        ], function () {
            Route::get('/', 'CommentController@getCommentCollection');
            Route::get('/{id}', 'CommentController@getCommentById');
            Route::post('/', 'CommentController@newComment');
        });
    });
});
