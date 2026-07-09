<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Services\ActivityService;

class LogTaskCreated
{
    public function handle(TaskCreated $event): void
    {
        ActivityService::log(
            user: $event->user,
            subject: $event->task,
            action: 'task.created',
            meta: ['title' => $event->task->title]
        );
    }
}
