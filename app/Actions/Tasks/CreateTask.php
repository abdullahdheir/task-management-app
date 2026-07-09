<?php

namespace App\Actions\Tasks;

use App\Events\TaskCreated;
use App\Models\Task;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class CreateTask
{
    public function __invoke(array $data, User $user): Task
    {
        if (!empty($data['parent_id'])) {
            $parent = Task::find($data['parent_id']);
            if (!$parent) {
                throw ValidationException::withMessages(['parent_id' => 'Parent task not found.']);
            }
            if (!is_null($parent->parent_id)) {
                throw ValidationException::withMessages(['parent_id' => 'Subtasks may only be one level deep.']);
            }
        }

        $data['user_id'] = $user->id;

        $task = Task::create($data);

        TaskCreated::dispatch($task, $user);

        return $task;
    }
}
