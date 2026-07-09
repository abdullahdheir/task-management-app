<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ActivityService
{
    public static function log(User $user, Model $subject, string $action, array $meta = []): Activity
    {
        return Activity::create([
            'user_id' => $user->id,
            'subject_type' => get_class($subject),
            'subject_id' => $subject->id,
            'action' => $action,
            'meta' => $meta ?: null,
        ]);
    }

    public static function logTaskPriorityChanged(User $user, Model $task, string $from, string $to): Activity
    {
        return self::log($user, $task, 'task.priority_changed', ['from' => $from, 'to' => $to]);
    }

    public static function logAttachmentUploaded(User $user, Model $task, Model $attachment): Activity
    {
        return self::log($user, $task, 'attachment.uploaded', ['filename' => $attachment->filename]);
    }

    public static function logProjectMemberAdded(User $user, Model $project, User $member): Activity
    {
        return self::log($user, $project, 'project.member_added', ['member_id' => $member->id]);
    }

    public static function logProjectMemberRemoved(User $user, Model $project, User $member): Activity
    {
        return self::log($user, $project, 'project.member_removed', ['member_id' => $member->id]);
    }
}
