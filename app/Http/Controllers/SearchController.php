<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        // Perform search logic here, e.g., querying the database for tasks, projects, or teams
        // For demonstration purposes, we'll just return the query back to the view
        return view('search.index', compact('query'));
    }
}
