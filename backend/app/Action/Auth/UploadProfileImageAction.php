<?php

declare(strict_types=1);

namespace App\Action\Auth;

use App\Repository\UserRepository;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Auth;

final class UploadProfileImageAction
{
    private const UPLOAD_DIR = 'profile-images';

    private $userRepository;
    private $filesystemManager;

    public function __construct(UserRepository $userRepository, FilesystemManager $filesystemManager)
    {
        $this->userRepository = $userRepository;
        $this->filesystemManager = $filesystemManager;
    }

    public function execute(UploadProfileImageRequest $request): UploadProfileImageResponse
    {
        $user = Auth::user();

        $disk = $this->filesystemManager->disk('public');

        $filePath = $disk->putFileAs(
            self::UPLOAD_DIR,
            $request->getImage(),
            $user->id,
            'public'
        );
        $user->profile_image = $disk->url($filePath);

        $user = $this->userRepository->save($user);

        return new UploadProfileImageResponse($user);
    }
}
