<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:web')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Tasks
    Route::resource('tasks', TaskController::class);

    // Projects
    Route::get('projects/overview', [ProjectController::class, 'overview'])->name('projects.overview');
    Route::resource('projects', ProjectController::class)->except(['index']);

    // Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Profile
    Route::get('/help', [HelpController::class, 'index'])->name('help.index');

    // Search
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/settings/account', [SettingsController::class, 'account'])->name('settings.account');
});
