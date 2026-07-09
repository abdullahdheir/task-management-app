<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     *
     * @param DashboardService $service
     * @return \Illuminate\View\View
     */
    public function index(DashboardService $service)
    {
        $user = auth()->user();

        $stats = $service->stats($user);
        $upcomingTasks = $service->upcomingTasks($user);
        $projects = $service->activeProjectsData($user);
        $teamAvatars = $service->teamAvatars($user);
        $remainingMembers = max(0, 4 - count($teamAvatars));
        $activeProjectsCount = count($projects);
        $recentActivity = $service->recentActivityFormatted($user, 4);

        return view('dashboard.index', compact(
            'stats',
            'upcomingTasks',
            'projects',
            'teamAvatars',
            'remainingMembers',
            'activeProjectsCount',
            'recentActivity'
        ));
    }
}
