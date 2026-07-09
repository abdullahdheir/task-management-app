<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class SearchController extends Controller
{
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
}
