<?php

declare(strict_types=1);

namespace App\Action\Auth;

use Illuminate\Http\UploadedFile;

final class UploadProfileImageRequest
{
    private $image;

    public function __construct(UploadedFile $image)
    {
        $this->image = $image;
    }

    public function getImage(): UploadedFile
    {
        return $this->image;
    }
}
