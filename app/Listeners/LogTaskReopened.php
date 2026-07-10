<?php

namespace App\Listeners;

use App\Events\TaskReopened;
use App\Services\ActivityService;

class LogTaskReopened
{
    public function handle(TaskReopened $event): void
    {
        ActivityService::log(
            user: $event->user,
            subject: $event->task,
            action: 'task.reopened',
            meta: ['title' => $event->task->title]
        );
    }
}
