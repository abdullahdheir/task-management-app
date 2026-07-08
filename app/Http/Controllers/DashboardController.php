<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(DashboardService $service)
    {
        $user = auth()->user();

        $upcomingTasks = $service->upcomingTasks($user);
        $activeProjects = $service->activeProjects($user);
        $recentActivity = $service->recentActivity($user);
        $stats = $service->stats($user);

        return view('dashboard.index', compact('upcomingTasks', 'activeProjects', 'recentActivity', 'stats'));
    }
}
