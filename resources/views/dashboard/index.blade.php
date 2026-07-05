@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- Hero Welcome Section --}}
    <section class="mb-stack-lg animate-fade-in">
        <div class="flex flex-col md:flex-row justify-between items-end gap-stack-md">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">
                    Good morning, {{ auth()->user()->name ?? 'Alex' }}
                </h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant mt-1">
                    Here's what's happening with your workspace today.
                </p>
            </div>

            {{-- Progress Ring --}}
            <div class="bg-surface-container rounded-xl p-stack-md flex items-center gap-4 card-elevation">
                <div class="relative h-12 w-12 flex items-center justify-center">
                    <svg class="absolute inset-0 w-full h-full transform -rotate-90">
                        <circle class="text-outline-variant" cx="24" cy="24" fill="transparent" r="20"
                            stroke="currentColor" stroke-width="4"></circle>
                        <circle class="text-secondary" cx="24" cy="24" fill="transparent" r="20"
                            stroke="currentColor" stroke-dasharray="125.6"
                            stroke-dashoffset="{{ 125.6 - (125.6 * ($progress ?? 40)) / 100 }}" stroke-width="4"></circle>
                    </svg>
                    <span class="font-label-md text-label-md text-on-surface">{{ $progress ?? 40 }}%</span>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-on-secondary-container font-bold">Today's Progress</p>
                    <p class="font-body-md text-body-md text-on-surface">
                        {{ $completedToday ?? 4 }} of {{ $totalToday ?? 10 }} tasks completed
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Bento Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter-desktop">

        {{-- Upcoming Deadlines --}}
        <section class="md:col-span-8 bg-white p-stack-lg rounded-xl card-elevation border border-outline-variant">
            <div class="flex justify-between items-center mb-stack-lg">
                <h3 class="font-headline-md text-headline-md flex items-center gap-2">
                    <span class="material-symbols-outlined text-error">event_busy</span>
                    Upcoming Deadlines
                </h3>
                <a href="{{ route('tasks.index') }}" class="text-primary font-label-md text-label-md hover:underline">
                    View All
                </a>
            </div>

            <div class="space-y-3">
                @forelse($upcomingTasks ?? [] as $task)
                    @include('partials.task-deadline-item', ['task' => $task])
                @empty
                    {{-- Placeholder items --}}
                    <div
                        class="flex items-center p-4 rounded-lg border border-slate-200 hover:shadow-sm transition-all cursor-pointer">
                        <div class="h-10 w-10 bg-error-container rounded-lg flex items-center justify-center mr-4">
                            <span class="material-symbols-outlined text-error">priority_high</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-body-lg text-body-lg font-bold">Redesign Onboarding Flow</h4>
                            <p class="text-label-sm text-on-surface-variant">Client: Neon Studio</p>
                        </div>
                        <div class="text-right">
                            <p class="text-label-md font-bold text-error">Today, 5:00 PM</p>
                            <span
                                class="text-label-sm bg-error-container text-on-error-container px-2 py-0.5 rounded-full">High</span>
                        </div>
                    </div>

                    <div
                        class="flex items-center p-4 rounded-lg border border-slate-200 hover:shadow-sm transition-all cursor-pointer">
                        <div class="h-10 w-10 bg-surface-container flex items-center justify-center mr-4 rounded-lg">
                            <span class="material-symbols-outlined text-primary">description</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-body-lg text-body-lg font-bold">Quarterly Report Draft</h4>
                            <p class="text-label-sm text-on-surface-variant">Internal Team</p>
                        </div>
                        <div class="text-right">
                            <p class="text-label-md font-bold text-on-surface">Tomorrow, 10:00 AM</p>
                            <span
                                class="text-label-sm bg-surface-container-highest text-on-surface-variant px-2 py-0.5 rounded-full">Medium</span>
                        </div>
                    </div>

                    <div
                        class="flex items-center p-4 rounded-lg border border-slate-200 hover:shadow-sm transition-all cursor-pointer">
                        <div class="h-10 w-10 bg-secondary-container flex items-center justify-center mr-4 rounded-lg">
                            <span class="material-symbols-outlined text-secondary">chat</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-body-lg text-body-lg font-bold">Feedback Call with Stakeholders</h4>
                            <p class="text-label-sm text-on-surface-variant">Project: Focus 2.0</p>
                        </div>
                        <div class="text-right">
                            <p class="text-label-md font-bold text-on-surface">Oct 24, 2:30 PM</p>
                            <span
                                class="text-label-sm bg-secondary-container text-on-secondary-fixed-variant px-2 py-0.5 rounded-full">Low</span>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- Right Column --}}
        <section class="md:col-span-4 space-y-gutter-desktop">

            {{-- Active Projects Card --}}
            <div
                class="bg-primary-container text-on-primary-container p-stack-lg rounded-xl card-elevation relative overflow-hidden group">
                <div class="relative z-10">
                    <p class="font-label-md text-label-md opacity-80 mb-2">Active Projects</p>
                    <h3 class="font-headline-lg text-headline-lg font-bold">{{ $activeProjectsCount ?? 12 }}</h3>
                    <div class="mt-4 flex -space-x-2">
                        @foreach ($teamAvatars ?? [] as $avatar)
                            <img class="h-8 w-8 rounded-full border-2 border-primary-container" src="{{ $avatar }}"
                                alt="Team member">
                        @endforeach
                        @if (($remainingMembers ?? 4) > 0)
                            <div
                                class="h-8 w-8 rounded-full border-2 border-primary-container bg-primary flex items-center justify-center text-label-sm text-on-primary">
                                +{{ $remainingMembers ?? 4 }}
                            </div>
                        @endif
                    </div>
                </div>
                <span
                    class="material-symbols-outlined absolute -right-4 -bottom-4 text-[120px] opacity-10 group-hover:scale-110 transition-transform">
                    folder_managed
                </span>
            </div>

            {{-- Project Overview --}}
            <div class="bg-white p-stack-lg rounded-xl card-elevation border border-outline-variant">
                <h3 class="font-headline-md text-headline-md mb-stack-lg">Project Overview</h3>
                <div class="space-y-6">
                    @foreach ($projects ?? [['name' => 'Design System', 'progress' => 80, 'color' => 'bg-secondary'], ['name' => 'Mobile App Dev', 'progress' => 45, 'color' => 'bg-primary'], ['name' => 'Marketing Deck', 'progress' => 15, 'color' => 'bg-tertiary-container']] as $project)
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-label-md text-label-md font-bold">{{ $project['name'] }}</span>
                                <span class="text-label-sm text-on-surface-variant">{{ $project['progress'] }}%</span>
                            </div>
                            <div class="h-1 bg-surface-container-high rounded-full overflow-hidden">
                                <div class="h-full {{ $project['color'] }}" style="width: {{ $project['progress'] }}%">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button
                    class="w-full mt-6 py-2 border border-outline-variant rounded-lg font-label-md text-label-md hover:bg-surface-container-low transition-colors">
                    Manage Projects
                </button>
            </div>
        </section>

        {{-- Recent Activity --}}
        <section class="md:col-span-12 bg-white p-stack-lg rounded-xl card-elevation border border-outline-variant">
            <div class="flex items-center justify-between mb-stack-lg">
                <h3 class="font-headline-md text-headline-md">Recent Activity</h3>
                <span class="text-label-sm bg-surface-container px-3 py-1 rounded-full text-on-surface">Last 24 hours</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($recentActivity ?? [['icon' => 'check_circle', 'color' => 'bg-secondary-container', 'iconColor' => 'text-secondary', 'title' => 'Task Completed', 'desc' => 'Landing page assets uploaded by Sarah'], ['icon' => 'add_comment', 'color' => 'bg-primary-container', 'iconColor' => 'text-on-primary', 'title' => 'New Comment', 'desc' => 'James left a note on the Budget sheet'], ['icon' => 'schedule', 'color' => 'bg-tertiary-fixed', 'iconColor' => 'text-tertiary', 'title' => 'Meeting Moved', 'desc' => 'Sync-up delayed by 30 mins'], ['icon' => 'report', 'color' => 'bg-error-container', 'iconColor' => 'text-error', 'title' => 'High Priority', 'desc' => 'Bug reported on production site']] as $activity)
                    <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-surface-container-low transition-colors">
                        <div
                            class="w-8 h-8 rounded-full {{ $activity['color'] }} flex items-center justify-center shrink-0">
                            <span
                                class="material-symbols-outlined {{ $activity['iconColor'] }} text-[18px]">{{ $activity['icon'] }}</span>
                        </div>
                        <div>
                            <p class="text-body-md font-bold">{{ $activity['title'] }}</p>
                            <p class="text-label-sm text-on-surface-variant">{{ $activity['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const items = document.querySelectorAll('.animate-fade-in');
            items.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
@endpush
