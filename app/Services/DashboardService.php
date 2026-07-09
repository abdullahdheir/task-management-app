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

    /**
     * Get user statistics for dashboard.
     *
     * @param User $user
     * @return array
     */
    public function stats(User $user): array
    {
        $today = Carbon::today();
        $totalToday = Task::forUser($user)
            ->whereDate('due_date', $today)
            ->count();

        $completedToday = Task::forUser($user)
            ->whereDate('due_date', $today)
            ->where('status', 'completed')
            ->count();

        $progress = $totalToday > 0 ? round(($completedToday / $totalToday) * 100) : 0;

        return [
            'progress' => $progress,
            'completedToday' => $completedToday,
            'totalToday' => $totalToday,
        ];
    }

    /**
     * Get active projects with progress data for dashboard.
     *
     * @param User $user
     * @return array
     */
    public function activeProjectsData(User $user): array
    {
        $projects = Project::active()
            ->forUser($user)
            ->orderBy('progress', 'desc')
            ->limit(3)
            ->get();

        $projectData = [];
        $colors = ['bg-secondary', 'bg-primary', 'bg-tertiary-container'];

        foreach ($projects as $index => $project) {
            $projectData[] = [
                'name' => $project->name,
                'progress' => $project->progress ?? 0,
                'color' => $colors[$index] ?? 'bg-surface-variant',
            ];
        }

        return $projectData;
    }

    /**
     * Get team avatars for dashboard.
     *
     * @param User $user
     * @return array
     */
    public function teamAvatars(User $user): array
    {
        // Get team members' avatars
        $members = $user->teams()
            ->with('members')
            ->get()
            ->pluck('members')
            ->flatten()
            ->unique('id')
            ->take(4);

        $avatars = [];
        foreach ($members as $member) {
            if ($member->avatar) {
                $avatars[] = asset('storage/' . $member->avatar);
            } else {
                // Generate initials avatar URL or placeholder
                $avatars[] = 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&background=random';
            }
        }

        return $avatars;
    }

    /**
     * Get recent activity formatted for dashboard.
     *
     * @param User $user
     * @param int $limit
     * @return array
     */
    public function recentActivityFormatted(User $user, int $limit = 4): array
    {
        $activities = Activity::where('user_id', $user->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

        $formatted = [];
        foreach ($activities as $activity) {
            $formatted[] = $this->formatActivity($activity);
        }

        return $formatted;
    }

    /**
     * Format a single activity for dashboard display.
     *
     * @param Activity $activity
     * @return array
     */
    private function formatActivity(Activity $activity): array
    {
        $iconMap = [
            'task.completed' => ['icon' => 'check_circle', 'color' => 'bg-secondary-container', 'iconColor' => 'text-secondary'],
            'comment.added' => ['icon' => 'add_comment', 'color' => 'bg-primary-container', 'iconColor' => 'text-on-primary'],
            'task.created' => ['icon' => 'add_task', 'color' => 'bg-tertiary-fixed', 'iconColor' => 'text-tertiary'],
            'attachment.uploaded' => ['icon' => 'attach_file', 'color' => 'bg-primary-container', 'iconColor' => 'text-on-primary'],
            'task.priority_changed' => ['icon' => 'priority_high', 'color' => 'bg-error-container', 'iconColor' => 'text-error'],
        ];

        $defaultIcon = ['icon' => 'history', 'color' => 'bg-surface-container', 'iconColor' => 'text-on-surface-variant'];
        $iconData = $iconMap[$activity->action] ?? $defaultIcon;

        $title = $this->getActivityTitle($activity);
        $desc = $this->getActivityDescription($activity);

        return [
            'icon' => $iconData['icon'],
            'color' => $iconData['color'],
            'iconColor' => $iconData['iconColor'],
            'title' => $title,
            'desc' => $desc,
        ];
    }

    /**
     * Get activity title.
     *
     * @param Activity $activity
     * @return string
     */
    private function getActivityTitle(Activity $activity): string
    {
        return match ($activity->action) {
            'task.completed' => 'Task Completed',
            'comment.added' => 'New Comment',
            'task.created' => 'Task Created',
            'attachment.uploaded' => 'File Uploaded',
            'task.priority_changed' => 'Priority Changed',
            'project.member_added' => 'Member Added',
            default => 'Activity',
        };
    }

    /**
     * Get activity description.
     *
     * @param Activity $activity
     * @return string
     */
    private function getActivityDescription(Activity $activity): string
    {
        if ($activity->user) {
            $userName = $activity->user->name;
        } else {
            $userName = 'System';
        }

        return match ($activity->action) {
            'task.completed' => "Task completed by {$userName}",
            'comment.added' => "Comment added by {$userName}",
            'task.created' => "New task created by {$userName}",
            'attachment.uploaded' => "File uploaded by {$userName}",
            'task.priority_changed' => "Priority changed by {$userName}",
            'project.member_added' => "Member added to project by {$userName}",
            default => "Activity logged by {$userName}",
        };
    }
}
