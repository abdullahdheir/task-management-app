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
                @forelse($upcomingTasks as $task)
                    @include('partials.task-deadline-item', ['task' => $task])
                @empty
                    <div
                        class="flex items-center justify-center p-8 rounded-lg border border-outline-variant bg-surface-container-low">
                        <div class="text-center">
                            <span
                                class="material-symbols-outlined text-on-surface-variant text-4xl mb-2">event_available</span>
                            <p class="text-on-surface-variant font-body-md">No upcoming deadlines</p>
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
                    <div class="flex -space-x-2">
                        @foreach ($teamAvatars as $avatar)
                            <img class="h-8 w-8 rounded-full border-2 border-primary-container" src="{{ $avatar }}"
                                alt="Team member">
                        @endforeach
                        @if ($remainingMembers > 0)
                            <div
                                class="h-8 w-8 rounded-full border-2 border-primary-container bg-primary flex items-center justify-center text-label-sm text-on-primary">
                                +{{ $remainingMembers }}
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
                    @forelse($projects as $project)
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
                    @empty
                        <div class="text-center py-8">
                            <span class="material-symbols-outlined text-on-surface-variant text-4xl mb-2">folder_open</span>
                            <p class="text-on-surface-variant font-body-md">No active projects</p>
                        </div>
                    @endforelse
                </div>
                <a href="{{ route('projects.index') }}"
                    class="block w-full mt-6 py-2 border border-outline-variant rounded-lg font-label-md text-label-md hover:bg-surface-container-low transition-colors text-center">
                    Manage Projects
                </a>
            </div>
        </section>

        {{-- Recent Activity --}}
        <section class="md:col-span-12 bg-white p-stack-lg rounded-xl card-elevation border border-outline-variant">
            <div class="flex items-center justify-between mb-stack-lg">
                <h3 class="font-headline-md text-headline-md">Recent Activity</h3>
                <span class="text-label-sm bg-surface-container px-3 py-1 rounded-full text-on-surface">Last 24 hours</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($recentActivity as $activity)
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
                @empty
                    <div class="col-span-full text-center py-8">
                        <span class="material-symbols-outlined text-on-surface-variant text-4xl mb-2">history</span>
                        <p class="text-on-surface-variant font-body-md">No recent activity</p>
                    </div>
                @endforelse
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
