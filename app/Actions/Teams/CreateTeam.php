<?php

namespace App\Actions\Teams;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Str;

class CreateTeam
{
    public function __invoke(array $data, User $user): Team
    {
        $data['owner_id'] = $user->id;
        $data['slug'] ??= Str::slug($data['name']);
        $data['privacy'] ??= 'private';

        $team = Team::create($data);

        // Owner is automatically an admin member
        $team->members()->attach($user->id, ['role' => 'admin', 'status' => 'active', 'joined_at' => now()]);

        return $team;
    }
}
