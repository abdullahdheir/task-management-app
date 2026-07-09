<?php

namespace App\Actions\Teams;

use App\Models\Team;
use App\Models\User;

class AcceptInvite
{
    public function __invoke(Team $team, User $user): void
    {
        $team->members()->updateExistingPivot($user->id, [
            'status' => 'active',
            'joined_at' => now(),
        ]);
    }
}
