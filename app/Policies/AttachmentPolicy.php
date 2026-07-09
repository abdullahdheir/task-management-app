<?php

namespace App\Policies;

use App\Models\TaskAttachment;
use App\Models\User;

class AttachmentPolicy
{
    /**
     * Determine if the user can delete the attachment.
     *
     * @param User $user
     * @param TaskAttachment $attachment
     * @return bool
     */
    public function delete(User $user, TaskAttachment $attachment): bool
    {
        return $attachment->user_id === $user->id;
    }

    /**
     * Determine if the user can view the attachment.
     *
     * @param User $user
     * @param TaskAttachment $attachment
     * @return bool
     */
    public function view(User $user, TaskAttachment $attachment): bool
    {
        $task = $attachment->task;
        return $task->user_id === $user->id || $task->assignee_id === $user->id;
    }
}
