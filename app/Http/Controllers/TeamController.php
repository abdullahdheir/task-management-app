<?php

namespace App\Http\Controllers;

use App\Actions\Teams\AcceptInvite;
use App\Actions\Teams\CreateTeam;
use App\Actions\Teams\InviteMember;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use App\Models\User;
use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function overview(TeamService $service)
    {
        $user = auth()->user();
        $teams = $service->listForUser($user);

        return view('teams.overview', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(StoreTeamRequest $request)
    {
        $team = (new CreateTeam)($request->validated(), auth()->user());
        return redirect()->route('teams.show', $team)->with('success', 'Team created.');
    }

    public function show(Team $team)
    {
        $user = auth()->user();
        if ($team->owner_id !== $user->id && !$team->members()->where('user_id', $user->id)->where('status', 'active')->exists()) {
            abort(403);
        }

        $members = $team->members()->with('pivot')->get();
        $projects = $team->projects()->with('owner', 'members')->get();
        $recentActivity = $team->activities()->with('user')->orderBy('created_at', 'desc')->limit(10)->get();

        return view('teams.show', compact('team', 'members', 'projects', 'recentActivity'));
    }

    public function edit(Team $team)
    {
        $user = auth()->user();
        if ($team->owner_id !== $user->id) {
            abort(403);
        }

        return view('teams.edit', compact('team'));
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        $user = auth()->user();
        if ($team->owner_id !== $user->id) {
            abort(403);
        }

        $team = (new UpdateTeam)($team, $request->validated());

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Team updated.',
                'data' => $team,
            ]);
        }

        return redirect()->route('teams.show', $team)->with('success', 'Team updated.');
    }

    public function destroy(Team $team)
    {
        $user = auth()->user();
        if ($team->owner_id !== $user->id) {
            abort(403);
        }

        $team->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Team deleted.',
            ]);
        }

        return redirect()->route('teams.overview')->with('success', 'Team deleted.');
    }

    public function invite(Request $request, Team $team)
    {
        $user = auth()->user();
        if ($team->owner_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'role' => ['nullable', 'in:admin,member,guest'],
        ]);

        $invitee = User::where('email', $request->email)->first();
        (new InviteMember)($team, $invitee, $request->role ?? 'member');

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Invitation sent.',
                'data' => $invitee,
            ]);
        }

        return back()->with('success', 'Invitation sent.');
    }

    public function acceptInvite(Team $team)
    {
        $user = auth()->user();
        (new AcceptInvite)($team, $user);

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Invitation accepted.',
            ]);
        }

        return redirect()->route('teams.show', $team)->with('success', 'Invitation accepted.');
    }

    public function directory(Team $team)
    {
        $user = auth()->user();
        if ($team->owner_id !== $user->id && !$team->members()->where('user_id', $user->id)->where('status', 'active')->exists()) {
            abort(403);
        }

        $members = $team->members()->with('pivot')->get();
        return view('teams.directory', compact('team', 'members'));
    }

    public function settings(Team $team)
    {
        $user = auth()->user();
        if ($team->owner_id !== $user->id) {
            abort(403);
        }

        return view('teams.settings', compact('team'));
    }
}
