<?php

namespace App\Http\Controllers;

use App\Services\SettingsService;

class SettingsController extends Controller
{
    /**
     * Display the settings index page.
     *
     * @param SettingsService $service
     * @return \Illuminate\View\View
     */
    public function index(SettingsService $service)
    {
        $user = auth()->user();
        $settings = $service->getSettings($user);

        return view('settings.index', compact('settings'));
    }

    /**
     * Update user settings.
     *
     * @param \Illuminate\Http\Request $request
     * @param SettingsService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(\Illuminate\Http\Request $request, SettingsService $service)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'email_notifications' => ['nullable', 'boolean'],
            'push_notifications' => ['nullable', 'boolean'],
            'theme' => ['nullable', 'in:light,dark'],
            'language' => ['nullable', 'string', 'max:5'],
            'timezone' => ['nullable', 'string', 'max:50'],
        ]);

        $service->updateSettings($user, $validated);

        return back()->with('success', 'Settings updated.');
    }
}
