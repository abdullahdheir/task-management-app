<?php

namespace App\Actions\Teams;

use App\Models\Team;
use App\Models\User;

class InviteMember
{
    public function __invoke(Team $team, User $user, string $role = 'member'): void
    {
        $team->members()->syncWithoutDetaching([
            $user->id => ['role' => $role, 'status' => 'invited'],
        ]);
    }
}
