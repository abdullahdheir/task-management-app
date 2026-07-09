<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;

class TeamPolicy
{
    public function viewAny(User $user): bool
    {
        return (bool) $user;
    }

    public function view(User $user, Team $team): bool
    {
        return $user->id === $team->owner_id || $team->members()->where('user_id', $user->id)->where('status', 'active')->exists();
    }

    public function create(User $user): bool
    {
        return (bool) $user;
    }

    public function update(User $user, Team $team): bool
    {
        return $user->id === $team->owner_id || $team->members()->where('user_id', $user->id)->whereIn('role', ['admin'])->exists();
    }

    public function delete(User $user, Team $team): bool
    {
        return $user->id === $team->owner_id;
    }

    public function invite(User $user, Team $team): bool
    {
        return $user->id === $team->owner_id || $team->members()->where('user_id', $user->id)->whereIn('role', ['admin'])->exists();
    }

    public function acceptInvite(User $user, Team $team): bool
    {
        return $team->members()->where('user_id', $user->id)->where('status', 'invited')->exists();
    }
}
