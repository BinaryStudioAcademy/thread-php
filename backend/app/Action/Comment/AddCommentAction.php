<?php

declare(strict_types=1);

namespace App\Action\Comment;

use App\Entity\Comment;
use App\Exceptions\TweetNotFoundException;
use App\Exceptions\UserNotFoundException;
use App\Repository\CommentRepository;
use App\Repository\TweetRepository;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class AddCommentAction
{
    private $userRepository;
    private $tweetRepository;
    private $commentRepository;

    public function __construct(
        UserRepository $userRepository,
        TweetRepository $tweetRepository,
        CommentRepository $commentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->tweetRepository = $tweetRepository;
        $this->commentRepository = $commentRepository;
    }

    public function execute(AddCommentRequest $request): AddCommentResponse
    {
        try {
            $this->userRepository->getById($request->getAuthorId());
        } catch (ModelNotFoundException $ex) {
            throw new UserNotFoundException();
        }

        try {
            $this->tweetRepository->getById($request->getTweetId());
        } catch (ModelNotFoundException $ex) {
            throw new TweetNotFoundException();
        }

        $comment = new Comment();
        $comment->author_id = $request->getAuthorId();
        $comment->tweet_id = $request->getTweetId();
        $comment->body = $request->getBody();

        $comment = $this->commentRepository->save($comment);

        return new AddCommentResponse($comment->id);
    }
}
