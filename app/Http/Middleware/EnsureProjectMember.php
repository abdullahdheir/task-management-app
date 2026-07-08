<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;

class EnsureProjectMember
{
    public function handle(Request $request, Closure $next)
    {
        $projectId = $request->route('project') ?? $request->input('project_id');

        if (!$projectId) {
            return $next($request);
        }

        $project = Project::find($projectId);
        if (!$project) {
            abort(404);
        }

        $user = $request->user();
        if ($project->owner_id === $user->id) {
            return $next($request);
        }

        $isMember = $project->members()->where('users.id', $user->id)->exists();
        if (!$isMember) {
            abort(403);
        }

        return $next($request);
    }
}
