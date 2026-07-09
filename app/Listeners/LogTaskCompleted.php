<?php

namespace App\Listeners;

use App\Events\TaskCompleted;
use App\Services\ActivityService;

class LogTaskCompleted
{
    public function handle(TaskCompleted $event): void
    {
        ActivityService::log(
            user: $event->user,
            subject: $event->task,
            action: 'task.completed',
            meta: ['title' => $event->task->title]
        );
    }
}
