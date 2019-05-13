<?php

namespace Tests\Feature\Api;

use App\Entity\Comment;
use App\Entity\Tweet;
use App\Entity\User;
use App\Exceptions\ErrorCode;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;
use Tests\CreatesApplication;

abstract class ApiTestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected const AUTH_PREFIX = 'Bearer';

    protected const ROOT_RESPONSE_KEY = 'data';

    /**
     * @var array
     *
     * User response item structure
     */
    protected const USER_RESOURCE_STRUCTURE = [
        'id',
        'first_name',
        'last_name',
        'nickname',
        'email',
        'avatar'
    ];

    /**
     * @var array
     *
     * Tweet response item structure
     */
    protected const TWEET_RESOURCE_STRUCTURE = [
        'id',
        'text',
        'image_url',
        'author' => self::USER_RESOURCE_STRUCTURE,
        'comments_count',
        'likes_count'
    ];

    /**
     * @var array
     *
     * Comment response item structure
     */
    protected const COMMENT_RESOURCE_STRUCTURE = [
        'id',
        'body',
        'author_id',
        'created_at',
        'updated_at',
        'author' => self::USER_RESOURCE_STRUCTURE
    ];

    /**
     * @var string
     */
    private $jwtToken;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedFakeData();
    }

    protected function seedFakeData(int $itemsAmount = 5): void
    {
        factory(User::class, $itemsAmount)->create();
        factory(Tweet::class, $itemsAmount)->create();
        factory(Comment::class, $itemsAmount)->create();
    }

    /**
     * Override call method
     *
     * Appends jwt auth header
     *
     * @param string $method
     * @param string $uri
     * @param array $parameters
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param null $content
     * @return TestResponse
     */
    public function call($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        if ($this->jwtToken) {
            // append token auth header
            $this->withHeader('AUTHORIZATION', self::AUTH_PREFIX . " {$this->jwtToken}");
        }

        return parent::call($method, $uri, $parameters, $cookies, $files, $server, $content);
    }

    private function authenticate(Authenticatable $user): void
    {
        // Auth::login() returns jwt token from JWTGuard class
        $this->jwtToken = Auth::login($user);
    }

    protected function actingWithToken(Authenticatable $user = null): self
    {
        $user = $user ?? factory(User::class)->create();

        $this->authenticate($user);

        return $this->actingAs($user, 'api');
    }

    private function assertUriIsValid(string $uri): void
    {
        if (empty($uri)) {
            throw new InvalidArgumentException('Request URI cannot be empty.');
        }
    }

    protected function assertCollectionResponse(string $uri, array $jsonStructure, array $queryParams = []): void
    {
        $this->assertUriIsValid($uri);

        $response = $this->call('GET', $uri, $queryParams)->assertOk();

        // assert response data key doesn't contain empty array
        $this->assertNotEmpty($response->json('data'));

        $response->assertJsonStructure([
            // * means to assert each array item for same structure
            self::ROOT_RESPONSE_KEY => ['*' => $jsonStructure]
        ]);
    }

    protected function assertCollectionErrorResponse(string $uri, array $queryParams = []): void
    {
        $this->assertUriIsValid($uri);

        $this->call('GET', $uri, $queryParams)->assertJsonStructure(['errors' => []]);
    }

    protected function assertItemResponse(string $uri, array $jsonStructure): void
    {
        $this->assertUriIsValid($uri);

        $this->get($uri)
            ->assertOk()
            ->assertJsonStructure([self::ROOT_RESPONSE_KEY => $jsonStructure]);
    }

    protected function assertNotFoundResponse(string $uri): void
    {
        $this->assertUriIsValid($uri);

        $this->get($uri)
            ->assertNotFound()
            ->assertExactJson([
                'errors' => [
                    [
                        'code' => ErrorCode::NOT_FOUND,
                        'message' => 'Resource not found.'
                    ]
                ]
            ]);
    }

    protected function assertDeleteNotFoundResponse(string $uri): void
    {
        $this->assertUriIsValid($uri);

        $this->delete($uri)
            ->assertNotFound()
            ->assertExactJson([
                'errors' => [
                    [
                        'code' => ErrorCode::NOT_FOUND,
                        'message' => 'Resource not found.'
                    ]
                ]
            ]);
    }

    protected function assertDeleteForbidden(string $uri): void
    {
        $this->assertUriIsValid($uri);

        $this->delete($uri)
            ->assertForbidden();
    }

    protected function assertErrorResponse(string $uri, array $attributes = [], string $httpMethod = 'POST'): void
    {
        $this->assertUriIsValid($uri);

        $this->json($httpMethod, $uri, $attributes)
            ->assertStatus(400)
            ->assertJsonStructure(['errors' => []]);
    }

    protected function assertCreatedResponse(string $uri, array $attributes): void
    {
        $this->assertUriIsValid($uri);
        $this->assertAttributesIsValid($attributes);

        $this->json('POST', $uri, $attributes)
            ->assertStatus(201)
            ->assertJsonStructure(['data' => ['id']]);
    }

    protected function assertUpdatedResponse(string $uri, array $attributes): void
    {
        $this->assertUriIsValid($uri);
        $this->assertAttributesIsValid($attributes);

        $this->json('PUT', $uri, $attributes)->assertStatus(200);
    }

    protected function assertDeletedResponse(string $uri): void
    {
        $this->assertUriIsValid($uri);

        $this->json('DELETE', $uri)->assertStatus(204);
    }

    protected function createResourceItemUri(string $uri, int $id): string
    {
        $this->assertUriIsValid($uri);

        return $uri . '/' . $id;
    }

    private function assertAttributesIsValid(array $attributes): void
    {
        if (empty($attributes)) {
            throw new InvalidArgumentException('Request attributes are empty.');
        }
    }
}
