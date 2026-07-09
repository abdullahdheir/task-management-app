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
     * @param string|null $month
     * @return \Illuminate\View\View
     */
    public function index(CalendarService $service, ?string $month = null)
    {
        $user = auth()->user();

        // Parse the month parameter or use current month
        $currentMonth = $month
            ? Carbon::parse($month)->startOfMonth()
            : now()->startOfMonth();

        $startOfMonth = $currentMonth->copy()->startOfMonth()->format('Y-m-d');
        $endOfMonth = $currentMonth->copy()->endOfMonth()->format('Y-m-d');

        $tasks = $service->getTasksForDateRange($user, $startOfMonth, $endOfMonth)
            ->groupBy(fn($task) => $task->due_date->format('Y-m-d'));

        $monthLabel = $currentMonth->format('F Y');
        $prevMonth = $currentMonth->copy()->subMonth()->format('Y-m');
        $nextMonth = $currentMonth->copy()->addMonth()->format('Y-m');

        // Build calendar days array
        $calendarDays = [];
        $daysInMonth = $currentMonth->daysInMonth;
        $firstDayOfWeek = $currentMonth->copy()->startOfMonth()->dayOfWeek; // 0 = Sunday, 6 = Saturday

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
            $date = $currentMonth->copy()->setDay($day)->format('Y-m-d');
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
                'is_today' => $currentMonth->copy()->setDay($day)->isToday(),
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
