<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'file' => ['required', 'file', 'max:10240'], // 10MB max
        ]);

        $file = $request->file('file');
        $path = $file->store('task-attachments', 'public');

        $attachment = TaskAttachment::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        return back()->with('success', 'Attachment uploaded.');
    }

    public function destroy(TaskAttachment $attachment)
    {
        $user = auth()->user();
        if ($attachment->user_id !== $user->id) {
            abort(403);
        }

        Storage::disk('public')->delete($attachment->path);
        $attachment->delete();

        return back()->with('success', 'Attachment deleted.');
    }
}
