<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttachmentRequest;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Services\AttachmentService;

class AttachmentController extends Controller
{
    /**
     * Store a newly created attachment in storage.
     *
     * @param StoreAttachmentRequest $request
     * @param Task $task
     * @param AttachmentService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAttachmentRequest $request, Task $task, AttachmentService $service)
    {
        $user = auth()->user();

        // Check if user has access to the task
        if ($task->user_id !== $user->id && $task->assignee_id !== $user->id) {
            abort(403);
        }

        $service->upload($task, $user, $request->file('file'));

        return back()->with('success', 'Attachment uploaded.');
    }

    /**
     * Remove the specified attachment from storage.
     *
     * @param TaskAttachment $attachment
     * @param AttachmentService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TaskAttachment $attachment, AttachmentService $service)
    {
        $user = auth()->user();

        // Check if user is the uploader
        if ($attachment->user_id !== $user->id) {
            abort(403);
        }

        $service->delete($attachment);

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Attachment deleted.',
            ]);
        }

        return back()->with('success', 'Attachment deleted.');
    }
}
