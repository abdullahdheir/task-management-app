<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AttachmentService
{
    /**
     * Upload and store an attachment for a task.
     *
     * @param Task $task The task to attach the file to
     * @param User $user The user uploading the file
     * @param UploadedFile $file The uploaded file
     * @return TaskAttachment The created attachment record
     */
    public function upload(Task $task, User $user, UploadedFile $file): TaskAttachment
    {
        $path = $file->store('task-attachments', 'public');

        $attachment = TaskAttachment::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        // Log activity
        ActivityService::logAttachmentUploaded($user, $task, $attachment);

        return $attachment;
    }

    /**
     * Delete an attachment and its file from storage.
     *
     * @param TaskAttachment $attachment The attachment to delete
     * @return void
     */
    public function delete(TaskAttachment $attachment): void
    {
        // Delete file from storage
        if (Storage::disk('public')->exists($attachment->path)) {
            Storage::disk('public')->delete($attachment->path);
        }

        // Delete database record
        $attachment->delete();
    }
}
