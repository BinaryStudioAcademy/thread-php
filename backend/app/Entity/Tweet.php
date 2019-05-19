<?php

declare(strict_types=1);

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use InvalidArgumentException;

/**
 * Class Tweet
 * @package App\Entity
 * @property int $id
 * @property string $text
 * @property string $image_url
 * @property int $author_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $comments_count
 * @property int $likes_count
 * @property User $author
 */
final class Tweet extends Model
{
    protected $table = 'tweets';

    // Relations to eager load on every query.
    protected $with = ['author', 'likes'];

    // Eager load related entities count each time.
    protected $withCount = ['comments', 'likes'];

    protected $fillable = [
        'text',
        'image_url',
        'author_id',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getCommentsCount(): int
    {
        // cast to int, because if tweet doesn't have comments null will be returned
        return (int)$this->comments_count;
    }

    public function getLikesCount(): int
    {
        return (int)$this->likes_count;
    }

    public function changeContent(string $text): void
    {
        if (empty($text)) {
            throw new InvalidArgumentException('Tweet content cannot be empty.');
        }

        $this->text = $text;
    }

    public function changePreviewImage(string $imageUrl): void
    {
        if (empty($imageUrl)) {
            throw new InvalidArgumentException('Empty image url.');
        }

        $this->image_url = $imageUrl;
    }
}
