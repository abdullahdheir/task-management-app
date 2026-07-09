<?php

namespace App\Services;

use App\Models\User;

class SettingsService
{
    /**
     * Get user settings.
     *
     * @param User $user
     * @return array
     */
    public function getSettings(User $user): array
    {
        return [
            'email_notifications' => $user->email_notifications ?? true,
            'push_notifications' => $user->push_notifications ?? true,
            'theme' => $user->theme ?? 'light',
            'language' => $user->language ?? 'en',
            'timezone' => $user->timezone ?? 'UTC',
        ];
    }

    /**
     * Update user settings.
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateSettings(User $user, array $data): User
    {
        $user->update($data);
        return $user->fresh();
    }
}
