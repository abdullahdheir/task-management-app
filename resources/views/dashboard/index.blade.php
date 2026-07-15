@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $progress = $stats['progress'] ?? 0;
        $completedToday = $stats['completedToday'] ?? 0;
        $totalToday = $stats['totalToday'] ?? 0;
    @endphp
    {{-- Hero Welcome Section --}}
    <section class="mb-stack-lg animate-fade-in">
        <div class="flex flex-col md:flex-row justify-between items-end gap-stack-md">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface dark:text-on-surface-dark">
                    Good morning, {{ auth()->user()->name ?? 'Alex' }}
                </h2>
                <p class="font-body-lg text-body-lg text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mt-1">
                    Here's what's happening with your workspace today.
                </p>
            </div>

            {{-- Progress Ring --}}
            <div class="bg-surface dark:bg-surface-dark-container rounded-xl p-stack-md flex items-center gap-4 card-elevation">
                <div class="relative h-12 w-12 flex items-center justify-center">
                    <svg class="absolute inset-0 w-full h-full transform -rotate-90">
                        <circle class="text-outline dark:text-outline-dark-variant dark:text-outline dark:text-outline-dark-variant-dark" cx="24" cy="24" fill="transparent" r="20"
                            stroke="currentColor" stroke-width="4"></circle>
                        <circle class="text-secondary dark:text-secondary-dark" cx="24" cy="24" fill="transparent" r="20"
                            stroke="currentColor" stroke-dasharray="125.6"
                            stroke-dashoffset="{{ 125.6 - (125.6 * ($progress ?? 40)) / 100 }}" stroke-width="4"></circle>
                    </svg>
                    <span class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark">{{ $progress ?? 40 }}%</span>
                </div>
                <div>
                    <p class="font-label-md text-label-md text-on-secondary dark:text-on-secondary-dark-container dark:text-on-secondary dark:text-on-secondary-dark-container-dark font-bold">Today's Progress</p>
                    <p class="font-body-md text-body-md text-on-surface dark:text-on-surface-dark">
                        {{ $completedToday ?? 4 }} of {{ $totalToday ?? 10 }} tasks completed
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Bento Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter-desktop">

        {{-- Upcoming Deadlines --}}
        <section class="md:col-span-8 bg-white dark:bg-surface-container-low-dark p-stack-lg rounded-xl card-elevation border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
            <div class="flex justify-between items-center mb-stack-lg">
                <h3 class="font-headline-md text-headline-md flex items-center gap-2">
                    <span class="material-symbols-outlined text-error dark:text-error-dark">event_busy</span>
                    Upcoming Deadlines
                </h3>
                <a href="{{ route('tasks.index') }}" class="text-primary dark:text-primary-dark font-label-md text-label-md hover:underline">
                    View All
                </a>
            </div>

            <div class="space-y-3">
                @forelse($upcomingTasks as $task)
                    @include('partials.task-deadline-item', ['task' => $task])
                @empty
                    <div
                        class="flex items-center justify-center p-8 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark bg-surface dark:bg-surface-dark-container-low">
                        <div class="text-center">
                            <span
                                class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-4xl mb-2">event_available</span>
                            <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-body-md">No upcoming deadlines</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- Right Column --}}
        <section class="md:col-span-4 space-y-gutter-desktop">

            {{-- Active Projects Card --}}
            <div
                class="bg-primary dark:bg-primary-dark-container dark:bg-primary dark:bg-primary-dark-container-dark text-on-primary dark:text-on-primary-dark-container dark:text-on-primary dark:text-on-primary-dark-container-dark p-stack-lg rounded-xl card-elevation relative overflow-hidden group">
                <div class="relative z-10">
                    <p class="font-label-md text-label-md opacity-80 mb-2">Active Projects</p>
                    <h3 class="font-headline-lg text-headline-lg font-bold">{{ $activeProjectsCount ?? 12 }}</h3>
                    <div class="flex -space-x-2">
                        @foreach ($teamAvatars as $avatar)
                            <img class="h-8 w-8 rounded-full border-2 border-primary dark:border-primary-dark-container" src="{{ $avatar }}"
                                alt="Team member">
                        @endforeach
                        @if ($remainingMembers > 0)
                            <div
                                class="h-8 w-8 rounded-full border-2 border-primary dark:border-primary-dark-container bg-primary dark:bg-primary-dark flex items-center justify-center text-label-sm text-on-primary dark:text-on-primary-dark">
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
            <div class="bg-white dark:bg-surface-container-low-dark p-stack-lg rounded-xl card-elevation border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
                <h3 class="font-headline-md text-headline-md mb-stack-lg">Project Overview</h3>
                <div class="space-y-6">
                    @forelse($projects as $project)
                        <a href="{{ route('projects.show', $project->id) }}" class="block">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-label-md text-label-md font-bold">{{ $project->name }}</span>
                                <span class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">{{ $project->progress }}%</span>
                            </div>
                            <div class="h-1 bg-surface dark:bg-surface-dark-container-high rounded-full overflow-hidden">
                                <div class="h-full"
                                    style="width: {{ $project->progress }}%; background-color: {{ $project->color ?? 'bg-primary dark:bg-primary-dark' }}">
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-8">
                            <span class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-4xl mb-2">folder_open</span>
                            <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-body-md">No active projects</p>
                        </div>
                    @endforelse
                </div>
                <a href="{{ route('projects.overview') }}"
                    class="block w-full mt-6 py-2 border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg font-label-md text-label-md hover:bg-surface dark:bg-surface-dark-container-low transition-colors text-center">
                    Manage Projects
                </a>
            </div>
        </section>

        {{-- Recent Activity --}}
        <section class="md:col-span-12 bg-white dark:bg-surface-container-low-dark p-stack-lg rounded-xl card-elevation border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
            <div class="flex items-center justify-between mb-stack-lg">
                <h3 class="font-headline-md text-headline-md">Recent Activity</h3>
                <span class="text-label-sm bg-surface dark:bg-surface-dark-container px-3 py-1 rounded-full text-on-surface dark:text-on-surface-dark">Last 24 hours</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($recentActivity as $activity)
                    <a href="{{ $activity['url'] }}"
                        class="flex items-start gap-3 p-3 rounded-lg hover:bg-surface dark:bg-surface-dark-container-low transition-colors">
                        <div
                            class="w-8 h-8 rounded-full {{ $activity['color'] }} flex items-center justify-center shrink-0">
                            <span
                                class="material-symbols-outlined {{ $activity['iconColor'] }} text-[18px]">{{ $activity['icon'] }}</span>
                        </div>
                        <div>
                            <p class="text-body-md font-bold">{{ $activity['title'] }}</p>
                            <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">{{ $activity['desc'] }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-8">
                        <span class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-4xl mb-2">history</span>
                        <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-body-md">No recent activity</p>
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
