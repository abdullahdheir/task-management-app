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

    /**
     * Get overview statistics for projects.
     *
     * @param User $user
     * @return array
     */
    public function getOverviewStats(User $user): array
    {
        $totalActive = Project::forUser($user)
            ->where('status', 'active')
            ->count();

        $totalCompleted = Project::forUser($user)
            ->where('status', 'completed')
            ->count();

        // Calculate average velocity (average progress across active projects)
        $activeProjects = Project::forUser($user)
            ->where('status', 'active')
            ->get();

        $averageVelocity = 0;
        if ($activeProjects->count() > 0) {
            $totalProgress = $activeProjects->sum('progress');
            $averageVelocity = round($totalProgress / $activeProjects->count());
        }

        return [
            'totalActive' => $totalActive,
            'totalCompleted' => $totalCompleted,
            'averageVelocity' => $averageVelocity,
        ];
    }
}
