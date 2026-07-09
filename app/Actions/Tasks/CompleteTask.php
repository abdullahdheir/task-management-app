<?php

namespace App\Actions\Tasks;

use App\Events\TaskCompleted;
use App\Models\Task;
use App\Models\User;

class CompleteTask
{
    public function __invoke(Task $task, User $user): Task
    {
        if ($task->is_completed) {
            return $task;
        }

        $task->markComplete();

        TaskCompleted::dispatch($task, $user);

        // If this is a subtask, and all siblings are complete, mark parent complete
        if ($task->parent) {
            $pending = $task->parent->subtasks()->pending()->count();
            if ($pending === 0) {
                $task->parent->markComplete();
            }
        }

        return $task->refresh();
    }
}
