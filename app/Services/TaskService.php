<?php

namespace App\Services;

use App\Actions\Tasks\CreateTask;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class TaskService
{
    public function listForUser(User $user, array $filters = [])
    {
        $query = Task::forUser($user)->with(['assignee', 'project', 'subtasks'])->topLevel();

        if (!empty($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['project_id'])) {
            $query->where('project_id', $filters['project_id']);
        }

        if (!empty($filters['due_from'])) {
            $query->whereDate('due_date', '>=', $filters['due_from']);
        }

        if (!empty($filters['due_to'])) {
            $query->whereDate('due_date', '<=', $filters['due_to']);
        }

        return $query->orderBy('due_date')->paginate(15);
    }

    public function recalculateProjectProgress(Project $project): void
    {
        $project->recalculateProgress();
    }
}
