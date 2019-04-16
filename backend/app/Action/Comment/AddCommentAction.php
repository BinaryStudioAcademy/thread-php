<?php

declare(strict_types=1);

namespace App\Action\Comment;

use App\Entity\Comment;
use App\Exceptions\TweetNotFoundException;
use App\Repository\CommentRepository;
use App\Repository\TweetRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

final class AddCommentAction
{
    private $tweetRepository;
    private $commentRepository;

    public function __construct(
        TweetRepository $tweetRepository,
        CommentRepository $commentRepository
    ) {
        $this->tweetRepository = $tweetRepository;
        $this->commentRepository = $commentRepository;
    }

    public function execute(AddCommentRequest $request): AddCommentResponse
    {
        try {
            $this->tweetRepository->getById($request->getTweetId());
        } catch (ModelNotFoundException $ex) {
            throw new TweetNotFoundException();
        }

        $comment = new Comment();
        $comment->author_id = Auth::id();
        $comment->tweet_id = $request->getTweetId();
        $comment->body = $request->getBody();

        $comment = $this->commentRepository->save($comment);

        return new AddCommentResponse($comment->id);
    }
}
