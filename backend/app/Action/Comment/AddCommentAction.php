<?php

declare(strict_types=1);

namespace App\Action\Comment;

use App\Models\Comment;
use App\Exceptions\TweetNotFoundException;
use App\Repository\CommentRepository;
use App\Repository\TweetRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

final class AddCommentAction
{
    public function __construct(
        private TweetRepository $tweetRepository,
        private CommentRepository $commentRepository
    ) {
    }

    public function execute(AddCommentRequest $request): AddCommentResponse
    {
        try {
            $this->tweetRepository->getById($request->getTweetId());
        } catch (ModelNotFoundException) {
            throw new TweetNotFoundException();
        }

        $comment = new Comment();
        $comment->author_id = Auth::id();
        $comment->tweet_id = $request->getTweetId();
        $comment->body = $request->getBody();

        $comment = $this->commentRepository->save($comment);

        return new AddCommentResponse($comment);
    }
}
