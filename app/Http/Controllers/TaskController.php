<?php

namespace App\Http\Controllers;

use App\Actions\Tasks\CompleteTask;
use App\Actions\Tasks\CreateTask;
use App\Actions\Tasks\ReopenTask;
use App\Actions\Tasks\UpdateTask;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request, TaskService $service)
    {
        $user = auth()->user();
        $filters = $request->only(['priority', 'category', 'status', 'project_id', 'due_from', 'due_to']);

        $tasks = $service->listForUser($user, $filters);
        $tasks = $service->transformTasksForView($tasks);

        $weeklyStats = $service->getWeeklyStats($user);
        $categories = $service->getCategoryBreakdown($user);
        $remainingCount = $service->getRemainingTodayCount($user);

        return view('tasks.index', compact(
            'tasks',
            'categories',
            'remainingCount'
        ) + $weeklyStats);
    }

    public function create()
    {
        $user = auth()->user();
        $projects = Project::forUser($user)->get();

        return view('tasks.create', compact('projects'));
    }

    public function store(StoreTaskRequest $request)
    {
        $task = (new CreateTask)($request->validated(), auth()->user());
        return redirect()->route('tasks.show', $task)->with('success', 'Task created.');
    }

    public function show(Task $task)
    {
        $user = auth()->user();
        if ($task->user_id !== $user->id && $task->assignee_id !== $user->id) {
            abort(403);
        }

        $subtasks = $task->subtasks()->with('assignee')->get();
        $comments = $task->comments()->with('user')->get();
        $activities = $task->activities()->with('user')->orderBy('created_at', 'desc')->get();
        $attachments = $task->attachments()->with('uploader')->get();

        return view('tasks.show', compact('task', 'subtasks', 'comments', 'activities', 'attachments'));
    }

    public function edit(Task $task)
    {
        $user = auth()->user();
        if ($task->user_id !== $user->id && $task->assignee_id !== $user->id) {
            abort(403);
        }

        $projects = Project::forUser($user)->get();
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $user = auth()->user();
        if ($task->user_id !== $user->id && $task->assignee_id !== $user->id) {
            abort(403);
        }

        $task = (new UpdateTask)($task, $request->validated(), auth()->user());

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Task updated.',
                'data' => $task,
            ]);
        }

        return redirect()->route('tasks.show', $task)->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $user = auth()->user();
        if ($task->user_id !== $user->id && $task->assignee_id !== $user->id) {
            abort(403);
        }

        $task->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Task deleted.',
            ]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

    public function complete(Task $task)
    {
        $user = auth()->user();
        if ($task->user_id !== $user->id && $task->assignee_id !== $user->id) {
            abort(403);
        }

        if ($task->is_completed) {
            $task = (new ReopenTask)($task, auth()->user());
        } else {
            $task = (new CompleteTask)($task, auth()->user());
        }

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => $task->is_completed ? 'Task marked complete.' : 'Task reopened.',
                'data' => [
                    'is_completed' => $task->is_completed,
                ],
            ]);
        }

        return back()->with('success', 'Task marked complete.');
    }

    public function storeSubtask(StoreTaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $data['parent_id'] = $task->id;

        $subtask = (new CreateTask)($data, auth()->user());
        return redirect()->route('tasks.show', $task)->with('success', 'Subtask created.');
    }

    public function comments(Task $task)
    {
        $comments = $task->comments()->with('user')->get();
        return view('partials.comments-list', compact('comments'))->render();
    }
}
