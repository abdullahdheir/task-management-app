<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    /**
     * Display a user's profile (own or another user's).
     */
    public function show(ProfileService $service, ?User $user = null)
    {
        $authUser = auth()->user();
        // If no user param, show own profile
        $user = $user ?? $authUser;

        $stats = $service->getProfileStats($user);

        return view('profile.show', compact('user', 'stats'));
    }

    public function edit()
    {
        $user = auth()->user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the authenticated user's profile.
     */
    public function update(UpdateProfileRequest $request, ProfileService $service)
    {
        $user = auth()->user();
        $data = $request->validated();

        // Handle avatar upload separately
        if ($request->hasFile('avatar')) {
            $user = $service->updateAvatar($user, $request->file('avatar'));
            unset($data['avatar']);
        }

        // Update profile fields
        if (!empty($data)) {
            $user = $service->updateProfile($user, $data);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
