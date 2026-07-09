<?php

namespace App\Http\Controllers;

use App\Actions\Projects\CreateProject;
use App\Actions\Projects\UpdateProject;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Services\ActivityService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(ProjectService $service)
    {
        $user = auth()->user();
        $projects = $service->listForUser($user);
        $stats = $service->getOverviewStats($user);

        return view('projects.overview', compact('projects', 'stats'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $project = (new CreateProject)($request->validated(), auth()->user());
        return redirect()->route('projects.show', $project)->with('success', 'Project created.');
    }

    public function show(Project $project)
    {
        $user = auth()->user();
        if ($project->owner_id !== $user->id && !$project->members()->where('users.id', $user->id)->exists()) {
            abort(403);
        }

        $members = $project->members()->with('pivot')->get();
        $tasks = $project->tasks()->with(['assignee', 'subtasks'])->topLevel()->orderBy('due_date')->get();
        $recentActivity = $project->activities()->with('user')->orderBy('created_at', 'desc')->limit(10)->get();

        return view('projects.show', compact('project', 'members', 'tasks', 'recentActivity'));
    }

    public function edit(Project $project)
    {
        $user = auth()->user();
        if ($project->owner_id !== $user->id) {
            abort(403);
        }

        return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $user = auth()->user();
        if ($project->owner_id !== $user->id) {
            abort(403);
        }

        $project = (new UpdateProject)($project, $request->validated());
        return redirect()->route('projects.show', $project)->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        $user = auth()->user();
        if ($project->owner_id !== $user->id) {
            abort(403);
        }

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted.');
    }

    public function addMember(Request $request, Project $project)
    {
        $user = auth()->user();
        if ($project->owner_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'role' => ['nullable', 'in:lead,member,viewer'],
        ]);

        $member = User::find($request->user_id);
        $project->members()->syncWithoutDetaching([
            $request->user_id => ['role' => $request->role ?? 'member'],
        ]);

        ActivityService::logProjectMemberAdded($user, $project, $member);

        return back()->with('success', 'Member added.');
    }

    public function removeMember(Project $project, User $user)
    {
        $authUser = auth()->user();
        if ($project->owner_id !== $authUser->id) {
            abort(403);
        }

        $project->members()->detach($user->id);
        ActivityService::logProjectMemberRemoved($authUser, $project, $user);

        return back()->with('success', 'Member removed.');
    }
}
