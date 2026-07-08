<?php

namespace App\Actions\Tasks;

use App\Models\Task;
use App\Models\User;

class UpdateTask
{
    public function __invoke(Task $task, array $data, User $user): Task
    {
        $original = $task->replicate();

        $task->update($data);

        // If marking completed via update
        if (($data['is_completed'] ?? null) === true && !$original->is_completed) {
            $task->markComplete();
        }

        // If this is a subtask update, check parent completion
        if ($task->parent) {
            $pending = $task->parent->subtasks()->pending()->count();
            if ($pending === 0) {
                $task->parent->markComplete();
            }
        }

        return $task->refresh();
    }
}
