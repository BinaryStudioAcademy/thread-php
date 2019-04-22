<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Exceptions\TweetNotFoundException;
use App\Repository\TweetRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\Facades\Auth;

final class UploadTweetImageAction
{
    private const UPLOAD_DIR = 'tweet-images';

    private $tweetRepository;
    private $filesystemManager;

    public function __construct(TweetRepository $tweetRepository, FilesystemManager $filesystemManager)
    {
        $this->tweetRepository = $tweetRepository;
        $this->filesystemManager = $filesystemManager;
    }

    public function execute(UploadTweetImageRequest $request): UploadTweetImageResponse
    {
        try {
            $tweet = $this->tweetRepository->getById($request->getId());
        } catch (ModelNotFoundException $ex) {
            throw new TweetNotFoundException();
        }

        if ($tweet->author_id !== Auth::id()) {
            throw new AuthorizationException();
        }

        $disk = $this->filesystemManager->disk('public');

        $filePath = $disk->putFileAs(
            self::UPLOAD_DIR,
            $request->getImage(),
            $tweet->id,
            'public'
        );
        $tweet->image_url = $disk->url($filePath);

        $tweet = $this->tweetRepository->save($tweet);

        return new UploadTweetImageResponse($tweet);
    }
}
