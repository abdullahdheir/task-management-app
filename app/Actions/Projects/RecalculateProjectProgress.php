<?php

namespace App\Actions\Projects;

use App\Models\Project;

class RecalculateProjectProgress
{
    public function __invoke(Project $project): void
    {
        $project->recalculateProgress();
    }
}
