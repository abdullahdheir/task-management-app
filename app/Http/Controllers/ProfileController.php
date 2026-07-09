<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     *
     * @param ProfileService $service
     * @return \Illuminate\View\View
     */
    public function show(ProfileService $service)
    {
        $user = auth()->user();
        $stats = $service->getProfileStats($user);

        return view('profile.show', compact('user', 'stats'));
    }

    /**
     * Update the user's profile.
     *
     * @param UpdateProfileRequest $request
     * @param ProfileService $service
     * @return \Illuminate\Http\RedirectResponse
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
