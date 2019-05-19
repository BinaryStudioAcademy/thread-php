<?php

declare(strict_types=1);

namespace Tests\Feature\Api;

use App\Entity\Tweet;
use App\Entity\User;

final class TweetApiTest extends ApiTestCase
{
    private const API_URL = 'api/v1/tweets';

    public function test_get_tweet_collection()
    {
        $this->actingWithToken()->assertCollectionResponse(self::API_URL, self::TWEET_RESOURCE_STRUCTURE);
    }

    public function test_get_tweet_collection_invalid_query_params()
    {
        $this->actingWithToken()->assertCollectionErrorResponse(self::API_URL, ['page' => 0]);
    }

    public function test_get_tweet_by_id()
    {
        $tweet = Tweet::first();

        $this->actingWithToken()
            ->assertItemResponse(
                $this->createResourceItemUri(self::API_URL, $tweet->id),
                self::TWEET_RESOURCE_STRUCTURE
            );
    }

    public function test_get_tweet_by_id_not_found()
    {
        $this->actingWithToken()->assertNotFoundResponse($this->createResourceItemUri(self::API_URL, 999));
    }

    public function test_add_tweet()
    {
        $this->actingWithToken()
            ->assertCreatedResponse(self::API_URL, [
                'text' => 'Text'
            ]);
    }

    public function test_add_tweet_invalid_request_params()
    {
        $this->actingWithToken()
            ->assertErrorResponse(self::API_URL, [
                'text' => ''
            ]);
    }

    public function test_update_tweet_by_id()
    {
        $tweet = Tweet::first();
        $user = User::find(
            $tweet->getAuthorId()
        );

        $this->actingWithToken($user)
            ->assertUpdatedResponse(
                $this->createResourceItemUri(self::API_URL, $tweet->id), [
                'text' => 'Text'
            ]);
    }

    public function test_delete_tweet_by_id()
    {
        $tweet = Tweet::first();
        $user = User::find(
            $tweet->getAuthorId()
        );

        $this->actingWithToken($user)
            ->assertDeletedResponse(
                $this->createResourceItemUri(self::API_URL, $tweet->id)
            );
    }

    public function test_delete_tweet_by_id_not_found()
    {
        $this->actingWithToken()
            ->assertDeleteNotFoundResponse(
                $this->createResourceItemUri(
                    self::API_URL,
                    999
                )
            );
    }

    public function test_delete_tweet_by_id_forbidden()
    {
        $user = User::first();
        $tweet = Tweet::where('author_id', '!=', $user->id)->first();

        $this->actingWithToken($user)
            ->assertDeleteForbidden(
                $this->createResourceItemUri(
                    self::API_URL,
                    $tweet->id
                )
            );
    }
}
