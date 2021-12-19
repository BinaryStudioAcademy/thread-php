<?php

declare(strict_types=1);

namespace App\Action\Tweet;

final class UpdateTweetRequest
{
    public function __construct(private int $id, private ?string $text)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }
}
