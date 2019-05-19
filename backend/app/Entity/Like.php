<?php

declare(strict_types=1);

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use InvalidArgumentException;

/**
 * Class Like
 *
 * Polymorphic entity
 *
 * @package App\Entity
 *
 * @property int $id
 * @property int $user_id
 * @property User $user
 * @property int $likeable_id
 * @property string $likeable_type
 * @property Carbon $created_at
 */
final class Like extends Model
{
    protected $table = 'likes';

    // no timestamps for likes migration
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type'
    ];

    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::createFromTimeString($this->created_at);
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function forTweet(int $userId, int $tweetId): void
    {
        $this->assertIdIsValid($userId);
        $this->assertIdIsValid($tweetId);

        $this->user_id = $userId;
        $this->likeable_id = $tweetId;
        $this->likeable_type = Tweet::class;
        $this->created_at = Carbon::now();
    }

    /**
     * @param int $id
     * @throws InvalidArgumentException
     */
    private function assertIdIsValid(int $id): void
    {
        if ($id < 1) {
            throw new InvalidArgumentException('Id cannot be less than 1.');
        }
    }
}
