<?php

declare(strict_types=1);

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property User $author
 */
final class Tweet extends Model
{
    protected $table = 'tweets';

    // Relations to eager load on every query.
    protected $with = ['author'];

    // Eager load related comments count each time.
    protected $withCount = ['comments'];

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
        return $this->comments_count;
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
