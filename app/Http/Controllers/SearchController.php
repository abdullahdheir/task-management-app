<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search for tasks, projects, and users
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = $request->input('q');
        $user = auth()->user();

        $tasks = $query
            ? Task::forUser($user)->where('title', 'like', "%{$query}%")->limit(10)->get()
            : collect();

        $projects = $query
            ? Project::forUser($user)->where('name', 'like', "%{$query}%")->limit(10)->get()
            : collect();

        return view('search.index', compact('query', 'tasks', 'projects'));
    }

    /**
     * Search for users by name or email
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function users(Request $request)
    {
        $query = $request->input('q');
        $currentUser = auth()->user();

        if (!$query || strlen($query) < 2) {
            return response()->json(['data' => []]);
        }

        $users = User::where('id', '!=', $currentUser->id)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%");
            })
            ->limit(10)
            ->get(['id', 'name', 'email', 'avatar']);

        return response()->json(['data' => $users]);
    }
}
