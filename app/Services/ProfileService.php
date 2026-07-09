<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    /**
     * Update user profile information.
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateProfile(User $user, array $data): User
    {
        $user->update($data);
        return $user->fresh();
    }

    /**
     * Upload and update user avatar.
     *
     * @param User $user
     * @param UploadedFile $avatar
     * @return User
     */
    public function updateAvatar(User $user, UploadedFile $avatar): User
    {
        // Delete old avatar if exists
        if ($user->avatar) {
            $this->deleteAvatar($user);
        }

        $path = $avatar->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        return $user->fresh();
    }

    /**
     * Delete user avatar from storage.
     *
     * @param User $user
     * @return void
     */
    public function deleteAvatar(User $user): void
    {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }
    }

    /**
     * Get user profile statistics.
     *
     * @param User $user
     * @return array
     */
    public function getProfileStats(User $user): array
    {
        $totalCompleted = \App\Models\Task::forUser($user)
            ->where('status', 'completed')
            ->count();

        // Calculate focus hours (placeholder - would need time tracking)
        $focusHours = 0; // This would come from time tracking data

        // Calculate efficiency score
        $totalTasks = \App\Models\Task::forUser($user)->count();
        $efficiency = $totalTasks > 0 ? round(($totalCompleted / $totalTasks) * 100) : 0;

        return [
            'total_completed' => $totalCompleted,
            'focus_hours' => $focusHours,
            'efficiency' => $efficiency,
        ];
    }
}
