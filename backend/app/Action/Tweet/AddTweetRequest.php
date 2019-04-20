<?php

declare(strict_types=1);

namespace App\Action\Tweet;

final class AddTweetRequest
{
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
