<?php

namespace App\Actions\Tasks;

use App\Events\TaskReopened;
use App\Models\Task;
use App\Models\User;

class ReopenTask
{
    public function __invoke(Task $task, User $user): Task
    {
        if (!$task->is_completed) {
            return $task;
        }

        $task->markPending();

        TaskReopened::dispatch($task, $user);

        if ($task->parent && $task->parent->is_completed) {
            $task->parent->markPending();
        }

        return $task->refresh();
    }
}
