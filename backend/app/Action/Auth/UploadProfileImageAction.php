<?php

declare(strict_types=1);

namespace App\Action\Auth;

use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

final class UploadProfileImageAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function execute(UploadProfileImageRequest $request): UploadProfileImageResponse
    {
        $user = Auth::user();

        $filePath = Storage::putFileAs(
            Config::get('filesystems.profile_images_dir'),
            $request->getImage(),
            $request->getImage()->hashName(),
            'public'
        );

        $user->profile_image = Storage::url($filePath);

        $user = $this->userRepository->save($user);

        return new UploadProfileImageResponse($user);
    }
}
