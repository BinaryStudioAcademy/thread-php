<?php

declare(strict_types=1);

namespace App\Action\Tweet;

final class AddTweetRequest
{
    public function __construct(private string $text)
    {
    }

    public function getText(): string
    {
        return $this->text;
    }
}
