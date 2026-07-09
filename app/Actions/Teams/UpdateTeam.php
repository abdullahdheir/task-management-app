<?php

namespace App\Actions\Teams;

use App\Models\Team;

class UpdateTeam
{
    public function __invoke(Team $team, array $data): Team
    {
        $team->update($data);
        return $team->refresh();
    }
}
