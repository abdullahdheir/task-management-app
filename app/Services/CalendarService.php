<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Collection;

class CalendarService
{
    /**
     * Get tasks grouped by due date for calendar view.
     *
     * @param User $user
     * @return Collection Tasks grouped by due date
     */
    public function getTasksByDueDate(User $user): Collection
    {
        $tasks = Task::forUser($user)
            ->with(['assignee', 'project'])
            ->whereNotNull('due_date')
            ->orderBy('due_date')
            ->get();

        return $tasks->groupBy(function ($task) {
            return $task->due_date->format('Y-m-d');
        });
    }

    /**
     * Get tasks for a specific date range.
     *
     * @param User $user
     * @param string $startDate
     * @param string $endDate
     * @return Collection
     */
    public function getTasksForDateRange(User $user, string $startDate, string $endDate): Collection
    {
        return Task::forUser($user)
            ->with(['assignee', 'project'])
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [$startDate, $endDate])
            ->orderBy('due_date')
            ->get();
    }
}
