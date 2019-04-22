<?php

declare(strict_types=1);

namespace App\Action\Tweet;

final class UpdateTweetRequest
{
    private $id;
    private $text;

    public function __construct(int $id, ?string $text)
    {
        $this->id = $id;
        $this->text = $text;
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
