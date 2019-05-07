<?php

declare(strict_types=1);

namespace App\Action\Tweet;

use App\Exceptions\TweetNotFoundException;
use App\Repository\TweetRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

final class UploadTweetImageAction
{
    private $tweetRepository;

    public function __construct(TweetRepository $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
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

        $filePath = Storage::putFileAs(
            Config::get('filesystems.tweet_images_dir'),
            $request->getImage(),
            $request->getImage()->hashName(),
            'public'
        );

        $tweet->image_url = Storage::url($filePath);

        $tweet = $this->tweetRepository->save($tweet);

        return new UploadTweetImageResponse($tweet);
    }
}
