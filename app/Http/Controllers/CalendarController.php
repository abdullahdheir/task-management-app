<?php

namespace App\Http\Controllers;

use App\Services\CalendarService;
use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Display calendar view with tasks grouped by due date.
     *
     * @param CalendarService $service
     * @return \Illuminate\View\View
     */
    public function index(CalendarService $service)
    {
        $user = auth()->user();
        $currentMonth = now()->startOfMonth();
        $startOfMonth = $currentMonth->format('Y-m-d');
        $endOfMonth = $currentMonth->endOfMonth()->format('Y-m-d');

        $tasks = $service->getTasksForDateRange($user, $startOfMonth, $endOfMonth)
            ->groupBy(fn($task) => $task->due_date->format('Y-m-d'));

        $monthLabel = $currentMonth->format('F Y');
        $prevMonth = $currentMonth->subMonth()->format('Y-m');
        $nextMonth = $currentMonth->addMonth()->format('Y-m');

        // Build calendar days array
        $calendarDays = [];
        $daysInMonth = now()->daysInMonth;
        $firstDayOfWeek = now()->startOfMonth()->dayOfWeek; // 0 = Sunday, 6 = Saturday

        // Add empty days for padding at start of month
        for ($i = 0; $i < $firstDayOfWeek; $i++) {
            $calendarDays[] = [
                'day' => '',
                'current_month' => false,
                'is_today' => false,
                'events' => [],
            ];
        }

        // Add actual days
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = now()->setDay($day)->format('Y-m-d');
            $dayTasks = $tasks->get($date, collect());

            $events = [];
            foreach ($dayTasks as $task) {
                $events[] = [
                    'title' => $task->title,
                    'color' => $this->getTaskColor($task->priority),
                ];
            }

            $calendarDays[] = [
                'day' => $day,
                'current_month' => true,
                'is_today' => $day == now()->day,
                'events' => $events,
            ];
        }

        return view('calendar.index', compact('monthLabel', 'prevMonth', 'nextMonth', 'calendarDays'));
    }

    /**
     * Get color class based on task priority.
     *
     * @param string|null $priority
     * @return string
     */
    private function getTaskColor(?string $priority): string
    {
        return match ($priority) {
            'high' => 'bg-error-container text-on-error-container',
            'medium' => 'bg-primary-container text-white',
            'low' => 'bg-secondary-container text-on-secondary-fixed-variant',
            default => 'bg-surface-container-highest text-on-surface-variant',
        };
    }
}
