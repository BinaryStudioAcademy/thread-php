<?php

declare(strict_types=1);

namespace App\Action\Tweet;

final class UpdateTweetRequest
{
    private $id;
    private $text;
    private $imageUrl;

    public function __construct(int $id, ?string $text, ?string $imageUrl)
    {
        $this->id = $id;
        $this->text = $text;
        $this->imageUrl = $imageUrl;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }
}