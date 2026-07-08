<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class DashboardService
{
    public function upcomingTasks(User $user, int $days = 7)
    {
        $end = Carbon::today()->addDays($days)->toDateString();

        return Task::forUser($user)
            ->pending()
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [Carbon::today()->toDateString(), $end])
            ->orderBy('due_date')
            ->get();
    }

    public function activeProjects(User $user)
    {
        return Project::active()
            ->forUser($user)
            ->orderBy('progress', 'desc')
            ->limit(10)
            ->get();
    }

    public function recentActivity(User $user, int $limit = 10)
    {
        return Activity::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function stats(User $user): array
    {
        $overdue = Task::forUser($user)->overdue()->count();
        $dueToday = Task::forUser($user)->dueToday()->count();
        $pending = Task::forUser($user)->pending()->count();

        return [
            'overdue' => $overdue,
            'dueToday' => $dueToday,
            'pending' => $pending,
        ];
    }
}
