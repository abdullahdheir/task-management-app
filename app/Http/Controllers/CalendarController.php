<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $tasks = Task::forUser($user)
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [$startOfMonth, $endOfMonth])
            ->with(['project', 'assignee'])
            ->get()
            ->groupBy(fn($task) => $task->due_date->format('Y-m-d'));

        $daysInMonth = Carbon::now()->daysInMonth;
        $weeks = collect();

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create(null, null, $day)->format('Y-m-d');
            $weeks->push([
                'date' => $date,
                'tasks' => $tasks->get($date, collect()),
            ]);
        }

        return view('calendar.index', compact('tasks', 'weeks'));
    }
}
