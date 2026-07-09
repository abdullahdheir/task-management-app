<?php

namespace App\Services;

use App\Models\Team;
use App\Models\User;

class TeamService
{
    public function listForUser(User $user)
    {
        return Team::where('owner_id', $user->id)
            ->orWhereHas('members', fn($q) => $q->where('user_id', $user->id)->where('status', 'active'))
            ->with('owner', 'members')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);
    }

    public function getTeamStats(Team $team): array
    {
        $totalMembers = $team->members()->count() + 1; // +1 for owner
        $totalProjects = $team->projects()->count();
        $totalTasks = $team->projects()->withCount('tasks')->get()->sum('tasks_count');

        return [
            'total_members' => $totalMembers,
            'total_projects' => $totalProjects,
            'total_tasks' => $totalTasks,
        ];
    }
}
