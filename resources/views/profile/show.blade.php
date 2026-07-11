@extends('layouts.app')

@section('title', 'Profile')

@push('styles')
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: transform 0.2s ease;
        }

        .glass-card:hover {
            transform: translateY(-2px);
        }
    </style>
@endpush

@section('content')

    <div class="max-w-container-max mx-auto space-y-stack-lg">

        {{-- Profile Header --}}
        <div class="glass-card rounded-xl p-8 flex flex-col md:flex-row items-center gap-8">
            <div class="relative group">
                <img src="{{ auth()->user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'User') . '&size=128' }}"
                    alt="{{ $user->name ?? 'User' }}"
                    class="w-32 h-32 rounded-full border-4 border-white shadow-md object-cover transition-transform group-hover:scale-105">
            </div>

            <div class="text-center md:text-left flex-1">
                <h2 class="font-headline-lg text-headline-lg text-on-surface mb-1">
                    {{ $user->name ?? (auth()->user()->name ?? 'Alexander Wright') }}
                </h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-4">
                    {{ $user->email ?? (auth()->user()->email ?? 'alex@focus.app') }}
                </p>
                <div class="flex flex-wrap justify-center md:justify-start gap-2">
                    <span
                        class="px-3 py-1 bg-secondary-container text-on-secondary-fixed-variant rounded-full text-label-md font-label-md">
                        Pro Member
                    </span>
                    <span
                        class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full text-label-md font-label-md">
                        {{ $user->location ?? 'New York, US' }}
                    </span>
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('settings.index') }}"
                    class="px-6 py-2.5 bg-primary text-white rounded-lg font-label-md hover:opacity-90 active:scale-95 transition-all">
                    Edit Profile
                </a>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter-desktop">
            <div class="md:col-span-2 glass-card rounded-xl p-6 flex flex-col justify-between">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-3 bg-primary-container/10 rounded-lg text-primary">
                        <span class="material-symbols-outlined">task_alt</span>
                    </div>
                    <span class="text-on-secondary-fixed-variant font-label-md bg-secondary-container px-2 py-1 rounded-md">
                        +12% this week
                    </span>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Total Tasks
                        Completed</p>
                    <h3 class="font-headline-lg text-headline-lg text-on-surface">{{ $stats->total_completed ?? 450 }}</h3>
                </div>
                <div class="mt-4 w-full bg-surface-container h-1.5 rounded-full overflow-hidden">
                    <div class="bg-secondary h-full" style="width: 75%"></div>
                </div>
            </div>

            <div class="glass-card rounded-xl p-6 flex flex-col justify-between">
                <div class="mb-6">
                    <div class="p-3 bg-tertiary-fixed-dim/20 rounded-lg text-tertiary w-fit">
                        <span class="material-symbols-outlined">timer</span>
                    </div>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Focus Hours</p>
                    <h3 class="font-headline-lg text-headline-lg text-on-surface">{{ $stats->focus_hours ?? 120 }}</h3>
                </div>
                <p class="text-label-sm font-label-sm text-on-surface-variant mt-2">Avg. 4.2h / day</p>
            </div>

            <div class="glass-card rounded-xl p-6 flex flex-col justify-between">
                <div class="mb-6">
                    <div class="p-3 bg-secondary-container/30 rounded-lg text-secondary w-fit">
                        <span class="material-symbols-outlined">trending_up</span>
                    </div>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Efficiency Score
                    </p>
                    <h3 class="font-headline-lg text-headline-lg text-on-surface">{{ $stats->efficiency ?? 94 }}%</h3>
                </div>
                <p class="text-label-sm font-label-sm text-on-surface-variant mt-2">Top 5% of users</p>
            </div>
        </div>

        {{-- Settings & Preferences --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter-desktop">

            {{-- Preferences --}}
            <div class="lg:col-span-2 space-y-stack-lg">
                <div class="glass-card rounded-xl overflow-hidden">
                    <div class="p-6 border-b border-outline-variant">
                        <h4 class="font-headline-md text-headline-md text-on-surface">Preferences</h4>
                    </div>
                    <div class="divide-y divide-outline-variant">

                        {{-- Notifications --}}
                        <div
                            class="p-6 flex items-center justify-between hover:bg-surface-container-low transition-colors group cursor-pointer">
                            <div class="flex gap-4 items-center">
                                <div
                                    class="p-2 bg-surface-container text-on-surface-variant rounded-lg group-hover:bg-primary group-hover:text-white transition-colors">
                                    <span class="material-symbols-outlined">notifications_active</span>
                                </div>
                                <div>
                                    <p class="font-body-lg text-body-lg text-on-surface">Push Notifications</p>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant">Manage how you receive
                                        alerts and updates</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-outline-variant rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                </div>
                            </label>
                        </div>

                        {{-- Theme --}}
                        <div
                            class="p-6 flex items-center justify-between hover:bg-surface-container-low transition-colors group cursor-pointer">
                            <div class="flex gap-4 items-center">
                                <div
                                    class="p-2 bg-surface-container text-on-surface-variant rounded-lg group-hover:bg-primary group-hover:text-white transition-colors">
                                    <span class="material-symbols-outlined">contrast</span>
                                </div>
                                <div>
                                    <p class="font-body-lg text-body-lg text-on-surface">App Theme</p>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant">Switch between Light,
                                        Dark, or System mode</p>
                                </div>
                            </div>
                            <div class="flex bg-surface-container p-1 rounded-lg">
                                <button
                                    class="px-3 py-1 bg-white shadow-sm rounded-md text-label-sm font-label-md">Light</button>
                                <button
                                    class="px-3 py-1 text-on-surface-variant text-label-sm font-label-md hover:text-on-surface">Dark</button>
                            </div>
                        </div>

                        {{-- Focus Mode --}}
                        <div
                            class="p-6 flex items-center justify-between hover:bg-surface-container-low transition-colors group cursor-pointer">
                            <div class="flex gap-4 items-center">
                                <div
                                    class="p-2 bg-surface-container text-on-surface-variant rounded-lg group-hover:bg-primary group-hover:text-white transition-colors">
                                    <span class="material-symbols-outlined">do_not_disturb_on</span>
                                </div>
                                <div>
                                    <p class="font-body-lg text-body-lg text-on-surface">Auto Focus Mode</p>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant">Automatically enable DND
                                        during scheduled hours</p>
                                </div>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-outline-variant rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Security + Upgrade --}}
            <div class="space-y-stack-lg">
                <div class="glass-card rounded-xl p-6">
                    <h4 class="font-headline-md text-headline-md text-on-surface mb-6">Security</h4>
                    <div class="space-y-4">
                        <button
                            class="w-full flex items-center justify-between p-3 rounded-lg border border-outline-variant hover:bg-surface-container transition-all">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">key</span>
                                <span class="font-label-md text-label-md">Change Password</span>
                            </div>
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                        </button>
                        <button
                            class="w-full flex items-center justify-between p-3 rounded-lg border border-outline-variant hover:bg-surface-container transition-all">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">verified_user</span>
                                <span class="font-label-md text-label-md">Two-Factor Auth</span>
                            </div>
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                        </button>
                    </div>
                </div>

                <div class="bg-primary-container p-6 rounded-xl text-white relative overflow-hidden group">
                    <div class="relative z-10">
                        <h4 class="font-headline-md text-headline-md mb-2">Upgrade to Team</h4>
                        <p class="font-body-md text-body-md opacity-80 mb-4">Collaborate with your team and unlock advanced
                            workflows.</p>
                        <button
                            class="bg-white text-primary px-4 py-2 rounded-lg font-label-md hover:shadow-xl transition-shadow">
                            Learn More
                        </button>
                    </div>
                    <div
                        class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700">
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="flex justify-between items-center pt-stack-lg border-t border-outline-variant text-on-surface-variant">
            <p class="font-label-sm text-label-sm">Last login: 2 hours ago from Chrome (macOS)</p>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="text-error font-label-md flex items-center gap-2 hover:bg-error-container/20 px-4 py-2 rounded-lg transition-colors">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                    Sign Out
                </button>
            </form>
        </div>
    </div>

@endsection
