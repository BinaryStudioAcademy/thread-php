<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use Illuminate\Http\UploadedFile;

final class UploadTweetImageRequest
{
    public function __construct(private int $id, private UploadedFile $image)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getImage(): UploadedFile
    {
        return $this->image;
    }
}
