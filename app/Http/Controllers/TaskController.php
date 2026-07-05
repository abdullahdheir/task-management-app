<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('owner_id', auth()->id())->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
        ]);

        Task::create([
            'title' => $request->input('title'),
            'owner_id' => auth()->id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'The task has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);
        $request->validate([
            'title' => ['required', 'string'],
        ]);

        $task->update([
            'title' => $request->input('title'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'The task has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        $task->delete();

        return redirect()->back()->with('success', 'The task has been deleted successfully');
    }

    /**
     * Toggle task status: pending -> doing -> completed -> pending
     */
    public function toggleStatus(Task $task)
    {
        $this->authorizeTask($task);

        $newStatus = match ($task->status) {
            TaskStatus::PENDING => TaskStatus::DOING,
            TaskStatus::DOING => TaskStatus::COMPLETED,
            TaskStatus::COMPLETED => TaskStatus::PENDING,
            default => TaskStatus::PENDING,
        };

        $updateData = ['status' => $newStatus];

        if ($newStatus === TaskStatus::DOING) {
            $updateData['started_at'] = now();
        } elseif ($newStatus === TaskStatus::COMPLETED) {
            $updateData['completed_at'] = now();
        } elseif ($newStatus === TaskStatus::PENDING) {
            $updateData['started_at'] = null;
            $updateData['completed_at'] = null;
        }

        $task->update($updateData);

        return redirect()->back()->with('success', 'The task status has been updated successfully');
    }

    /**
     * Authorize that the task belongs to the authenticated user
     */
    private function authorizeTask(Task $task)
    {
        if ($task->owner_id !== auth()->id()) {
            abort(403, 'You do not have permission to access this task.');
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $tasks = Task::where('owner_id', auth()->id())
            ->where('title', 'like', '%' . $query . '%')
            ->get();

        return view('tasks.search', compact('tasks', 'query'));
    }
}
