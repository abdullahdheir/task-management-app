<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use App\Services\ActivityService;

class LogCommentPosted
{
    public function handle(CommentPosted $event): void
    {
        ActivityService::log(
            user: $event->user,
            subject: $event->comment->commentable,
            action: 'comment.added',
            meta: ['body' => str()->limit($event->comment->body, 100)]
        );
    }
}
