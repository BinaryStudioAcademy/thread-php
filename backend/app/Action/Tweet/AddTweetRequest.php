<?php

declare(strict_types=1);

namespace App\Action\Tweet;

final class AddTweetRequest
{
    private $text;
    private $imageUrl;

    public function __construct(string $text, ?string $imageUrl)
    {
        $this->text = $text;
        $this->imageUrl = $imageUrl;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }
}