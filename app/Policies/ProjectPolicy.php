<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id || $project->members()->where('user_id', $user->id)->exists();
    }

    public function create(User $user): bool
    {
        return (bool) $user;
    }

    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id || $project->members()->where('user_id', $user->id)->whereIn('role', ['lead', 'admin'])->exists();
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id || $project->members()->where('user_id', $user->id)->whereIn('role', ['lead', 'admin'])->exists();
    }

    public function addMember(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id || $project->members()->where('user_id', $user->id)->whereIn('role', ['lead', 'admin'])->exists();
    }

    public function removeMember(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id || $project->members()->where('user_id', $user->id)->whereIn('role', ['lead', 'admin'])->exists();
    }

    public function create_task(User $user, Project $project): bool
    {
        return $user->id === $project->owner_id || $project->members()->where('user_id', $user->id)->where('role', '!=', 'viewer')->exists();
    }
}
