<?php

namespace App\Http\Controllers;

use App\Services\SettingsService;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @param SettingsService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SettingsService $service)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'email_notifications' => ['nullable', 'boolean'],
            'push_notifications' => ['nullable', 'boolean'],
            'theme' => ['nullable', 'in:light,dark'],
            'language' => ['nullable', 'string', 'max:5'],
            'timezone' => ['nullable', 'string', 'max:50'],
            'dark_mode' => ['nullable', 'boolean'],
            'two_factor_enabled' => ['nullable', 'boolean'],
            'share_usage_data' => ['nullable', 'boolean'],
        ]);

        $service->updateSettings($user, $validated);

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Settings updated.',
                'data' => $validated,
            ]);
        }

        return back()->with('success', 'Settings updated.');
    }
}
