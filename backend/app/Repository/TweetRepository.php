<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Tweet;

final class TweetRepository
{
    public function getById(int $id): Tweet
    {
        return Tweet::findOrFail($id);
    }
}
