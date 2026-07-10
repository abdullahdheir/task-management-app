<?php

namespace App\Actions\Comments;

use App\Events\CommentPosted;
use App\Models\Comment;

class CreateComment
{
    public function __invoke(array $data): Comment
    {
        $comment = Comment::create($data);

        CommentPosted::dispatch($comment, $comment->user);

        return $comment;
    }
}
