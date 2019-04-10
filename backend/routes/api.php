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
        });
    });
});