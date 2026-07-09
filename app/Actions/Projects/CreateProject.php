<?php

namespace App\Actions\Projects;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Str;

class CreateProject
{
    public function __invoke(array $data, User $user): Project
    {
        $data['owner_id'] = $user->id;
        $data['slug'] ??= Str::slug($data['name']);
        $data['status'] ??= 'active';
        $data['progress'] ??= 0;

        return Project::create($data);
    }
}
