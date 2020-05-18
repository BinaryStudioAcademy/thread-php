<?php

declare(strict_types=1);

namespace Tests\Feature\Api\V1;

use App\Entity\Comment;
use App\Entity\Tweet;
use Tests\Feature\Api\ApiTestCase;

final class CommentApiTest extends ApiTestCase
{
    private const API_URL = 'api/v1/comments';

    public function test_get_comment_collection()
    {
        $this->actingWithToken()->assertCollectionResponse(self::API_URL, self::COMMENT_RESOURCE_STRUCTURE);
    }

    public function test_get_comment_collection_invalid_query_params()
    {
        $this->actingWithToken()->assertCollectionErrorResponse(self::API_URL, ['page' => 0]);
    }

    public function test_get_comment_by_id()
    {
        $comment = Comment::first();

        $this->actingWithToken()
            ->assertItemResponse(
                $this->createResourceItemUri(self::API_URL, $comment->id),
                self::COMMENT_RESOURCE_STRUCTURE
            );
    }

    public function test_get_comment_by_id_not_found()
    {
        $this->actingWithToken()->assertNotFoundResponse($this->createResourceItemUri(self::API_URL, 999));
    }

    public function test_add_comment()
    {
        $tweet = Tweet::first();

        $this->actingWithToken()
            ->assertCreatedResponse(self::API_URL, [
                'body' => 'Text',
                'tweet_id' => $tweet->id
            ]);
    }

    /**
     * Comment body, id request params
     *
     * Should be public
     *
     * @return array
     */
    public function commentInvalidAttributesProvider(): array
    {
        return [
            [
                '', 9999
            ],
            [
                'text', 0
            ]
        ];
    }

    /**
     * @dataProvider commentInvalidAttributesProvider
     * @param string $body
     * @param int $id
     */
    public function test_add_comment_invalid_request_params(string $body, int $id)
    {
        $this->actingWithToken()
            ->assertErrorResponse(self::API_URL, [
                'body' => $body,
                'tweet_id' => $id
            ]);
    }
}
