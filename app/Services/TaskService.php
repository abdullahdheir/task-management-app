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

    /**
     * Get weekly task statistics for a user.
     *
     * @param User $user
     * @return array
     */
    public function getWeeklyStats(User $user): array
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $totalTasks = Task::forUser($user)
            ->whereBetween('due_date', [$startOfWeek, $endOfWeek])
            ->count();

        $completedTasks = Task::forUser($user)
            ->whereBetween('due_date', [$startOfWeek, $endOfWeek])
            ->where('status', 'completed')
            ->count();

        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        return [
            'weeklyProgress' => $progress,
            'weeklyCompleted' => $completedTasks,
            'weeklyTotal' => $totalTasks,
        ];
    }

    /**
     * Get task count by category for a user.
     *
     * @param User $user
     * @return array
     */
    public function getCategoryBreakdown(User $user): array
    {
        $categories = Task::forUser($user)
            ->selectRaw('category, COUNT(*) as count')
            ->whereNotNull('category')
            ->groupBy('category')
            ->get();

        $categoryColors = [
            'work' => 'bg-primary',
            'personal' => 'bg-secondary',
            'health' => 'bg-tertiary',
            'finance' => 'bg-error-container',
            'other' => 'bg-surface-variant',
        ];

        $breakdown = [];
        foreach ($categories as $cat) {
            $breakdown[] = [
                'name' => ucfirst($cat->category),
                'count' => $cat->count,
                'color' => $categoryColors[$cat->category] ?? 'bg-surface-variant',
            ];
        }

        return $breakdown;
    }

    /**
     * Get remaining task count for today.
     *
     * @param User $user
     * @return int
     */
    public function getRemainingTodayCount(User $user): int
    {
        return Task::forUser($user)
            ->whereDate('due_date', now()->toDateString())
            ->where('status', '!=', 'completed')
            ->count();
    }

    /**
     * Transform task collection to array format for view.
     *
     * @param mixed $tasks
     * @return \Illuminate\Support\Collection
     */
    public function transformTasksForView($tasks)
    {
        return $tasks->map(function ($task) {
            return [
                'id' => $task->id,
                'title' => $task->title,
                'due' => $this->formatDueDate($task->due_date, $task->due_time, $task->status),
                'category' => ucfirst($task->category ?? 'other'),
                'priority' => $task->priority ?? 'low',
                'completed' => $task->status === 'completed',
                'model' => $task,
            ];
        });
    }

    /**
     * Format due date for display.
     *
     * @param mixed $dueDate
     * @param mixed $dueTime
     * @param string $status
     * @return string
     */
    private function formatDueDate($dueDate, $dueTime, $status): string
    {
        if ($status === 'completed') {
            return 'Completed';
        }

        if (!$dueDate) {
            return 'No due date';
        }

        $date = \Carbon\Carbon::parse($dueDate);
        $today = \Carbon\Carbon::today();
        $tomorrow = \Carbon\Carbon::tomorrow();

        if ($date->isToday()) {
            $time = $dueTime ? ', ' . \Carbon\Carbon::parse($dueTime)->format('g:i A') : '';
            return 'Today' . $time;
        }

        if ($date->isTomorrow()) {
            return 'Tomorrow';
        }

        if ($date->diffInDays($today) <= 7) {
            return $date->format('l');
        }

        return $date->format('M d, Y');
    }
}
