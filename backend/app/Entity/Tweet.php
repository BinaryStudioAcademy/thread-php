<?php

declare(strict_types=1);

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Tweet
 * @package App\Entity
 * @property int $id
 * @property string $text
 * @property string $image_url
 * @property int $author_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Tweet extends Model
{
    protected $table = 'tweets';

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

    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function changeContent(string $text): void
    {
        if (empty($text)) {
            throw new \InvalidArgumentException('Tweet content cannot be empty.');
        }

        $this->text = $text;
    }

    public function changePreviewImage(string $imageUrl): void
    {
        if (empty($imageUrl)) {
            throw new \InvalidArgumentException('Empty image url.');
        }

        $this->image_url = $imageUrl;
    }
}
