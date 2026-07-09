<?php

namespace App\Services;

use App\Models\Project;
use App\Models\User;

class ProjectService
{
    public function listForUser(User $user)
    {
        return Project::forUser($user)
            ->with('owner', 'members')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);
    }

    public function getProjectStats(Project $project): array
    {
        $totalTasks = $project->tasks()->count();
        $completedTasks = $project->tasks()->where('is_completed', true)->count();
        $pendingTasks = $totalTasks - $completedTasks;
        $totalMembers = $project->members()->count() + 1; // +1 for owner
        $progress = $totalTasks > 0 ? (int) round(($completedTasks / $totalTasks) * 100) : 0;

        return [
            'total_tasks' => $totalTasks,
            'completed_tasks' => $completedTasks,
            'pending_tasks' => $pendingTasks,
            'total_members' => $totalMembers,
            'progress' => $progress,
        ];
    }

    public function recalculateProgress(Project $project): void
    {
        $project->recalculateProgress();
    }
}
