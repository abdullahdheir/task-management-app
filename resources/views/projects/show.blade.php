@extends('layouts.app')

@section('title', "{{ $project->title ?? 'Project Details' }}")

@push('styles')
    <style>
        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0px 4px 6px -1px rgba(0, 0, 0, 0.05), 0px 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
@endpush

@section('content')
    <!-- Project Hero Section -->
    <div class="mb-stack-lg bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm">
        <div class="flex justify-between items-end mb-4">
            <div>
                <h2 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Project
                    Progress</h2>
                <div class="flex items-baseline gap-2">
                    <span class="font-headline-lg text-headline-lg text-primary">{{ $project->progress ?? 0 }}%</span>
                    <span class="text-on-surface-variant font-body-md text-body-md">Completed</span>
                </div>
            </div>
            <div class="text-right">
                @php
                    $completedTasks = $tasks->where('status', 'completed')->count();
                    $totalTasks = $tasks->count();
                @endphp
                <span class="font-label-md text-label-md text-on-surface-variant">{{ $totalTasks - $completedTasks }} of
                    {{ $totalTasks }} tasks remaining</span>
            </div>
        </div>
        <div class="w-full h-2 bg-surface-container rounded-full overflow-hidden">
            <div class="h-full bg-secondary transition-all duration-1000 ease-out"
                style="width: {{ $project->progress ?? 0 }}%;"></div>
        </div>
    </div>
    <!-- Bento Grid Layout -->
    <div class="grid grid-cols-12 gap-gutter-desktop">
        <!-- 1. Overview & Timeline (Left Column) -->
        <div class="col-span-12 lg:col-span-8 space-y-gutter-desktop">
            <div
                class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant hover:shadow-sm transition-all duration-300">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">description</span>
                        Project Overview
                    </h3>
                    <button class="text-primary font-label-md hover:underline">Edit</button>
                </div>
                <p class="text-body-lg font-body-lg text-on-surface-variant leading-relaxed mb-8">
                    {{ $project->description ?? 'No description provided.' }}
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-4 bg-surface-container-low rounded-lg">
                        <span class="text-label-sm text-on-surface-variant block mb-1">Timeline</span>
                        <div class="flex items-center gap-2 text-on-surface font-body-md">
                            <span class="material-symbols-outlined text-primary text-[18px]">calendar_today</span>
                            {{ $project->start_date?->format('M d') ?? 'TBD' }} -
                            {{ $project->end_date?->format('M d') ?? 'TBD' }}
                        </div>
                    </div>
                    <div class="p-4 bg-surface-container-low rounded-lg">
                        <span class="text-label-sm text-on-surface-variant block mb-1">Priority</span>
                        <div class="flex items-center gap-2 text-on-surface font-body-md">
                            <span class="material-symbols-outlined text-error text-[18px]"
                                style="font-variation-settings: 'FILL' 1;">stat_3</span>
                            {{ ucfirst($project->priority ?? 'Normal') }}
                        </div>
                    </div>
                    <div class="p-4 bg-surface-container-low rounded-lg">
                        <span class="text-label-sm text-on-surface-variant block mb-1">Budget</span>
                        <div class="flex items-center gap-2 text-on-surface font-body-md">
                            <span class="material-symbols-outlined text-secondary text-[18px]">payments</span>
                            ${{ number_format($project->budget ?? 0, 2) }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- 3. Task List Section -->
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">checklist</span>
                        Project Tasks
                    </h3>
                    <div class="flex gap-2">
                        <span
                            class="px-3 py-1 bg-surface-container text-on-surface-variant rounded-md text-label-sm cursor-pointer hover:bg-surface-container-high">All</span>
                        <span
                            class="px-3 py-1 text-on-surface-variant rounded-md text-label-sm cursor-pointer hover:bg-surface-container-low">Todo</span>
                        <span
                            class="px-3 py-1 text-on-surface-variant rounded-md text-label-sm cursor-pointer hover:bg-surface-container-low">Review</span>
                    </div>
                </div>
                <div class="space-y-3">
                    @forelse($tasks as $task)
                        <div
                            class="task-card flex items-center justify-between p-4 {{ $task->status === 'completed' ? 'bg-surface-container-low border border-transparent opacity-80' : 'bg-white border border-outline-variant' }} rounded-lg transition-all duration-200">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-5 h-5 rounded-full {{ $task->status === 'completed' ? 'bg-secondary flex items-center justify-center text-white' : 'border-2 border-outline cursor-pointer hover:border-secondary' }} transition-colors">
                                    @if ($task->status === 'completed')
                                        <span class="material-symbols-outlined text-[16px]">check</span>
                                    @endif
                                </div>
                                <div>
                                    <h4
                                        class="font-body-lg text-body-lg {{ $task->status === 'completed' ? 'text-on-surface line-through' : 'text-on-surface' }}">
                                        {{ $task->title }}</h4>
                                    <p class="text-label-sm text-on-surface-variant">{{ $task->category ?? 'Task' }} •
                                        {{ $task->due_date?->format('M d') ?? 'No due date' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span
                                    class="px-2 py-0.5 {{ $task->status === 'completed' ? 'bg-secondary-container text-on-secondary-container' : 'bg-tertiary-fixed text-on-tertiary-fixed' }} rounded text-[10px] font-bold uppercase">{{ $task->status === 'completed' ? 'Done' : ucfirst($task->priority ?? 'Normal') }}</span>
                                @if ($task->assignee)
                                    <div
                                        class="w-8 h-8 rounded-full border-2 border-white -ml-2 ring-1 ring-outline-variant">
                                        <img class="w-full h-full rounded-full object-cover"
                                            src="{{ $task->assignee->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($task->assignee->name) . '&size=32' }}"
                                            alt="{{ $task->assignee->name }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl mb-2">task_alt</span>
                            <p class="text-label-sm">No tasks yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- 2. Team & Activity (Right Column) -->
        <div class="col-span-12 lg:col-span-4 space-y-gutter-desktop">
            <!-- Team Members Card -->
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant">
                <h3 class="font-headline-md text-headline-md text-on-surface mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">groups</span>
                    Team
                </h3>
                <div class="space-y-4">
                    @forelse($members as $member)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img class="w-10 h-10 rounded-full object-cover"
                                    src="{{ $member->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&size=40' }}"
                                    alt="{{ $member->name }}">
                                <div>
                                    <p class="font-body-lg text-body-lg text-on-surface leading-tight">{{ $member->name }}
                                    </p>
                                    <p class="text-label-sm text-on-surface-variant">{{ $member->role ?? 'Team Member' }}
                                    </p>
                                </div>
                            </div>
                            <span class="material-symbols-outlined text-on-surface-variant cursor-pointer">more_vert</span>
                        </div>
                    @empty
                        <div class="text-center py-4 text-on-surface-variant">
                            <p class="text-label-sm">No team members yet</p>
                        </div>
                    @endforelse
                    <button
                        class="w-full mt-2 py-2 border-2 border-dashed border-outline-variant text-on-surface-variant rounded-lg font-label-md flex items-center justify-center gap-2 hover:border-primary hover:text-primary transition-all">
                        <span class="material-symbols-outlined text-[18px]">person_add</span>
                        Add Member
                    </button>
                </div>
            </div>
            <!-- Recent Activity Feed -->
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant">
                <h3 class="font-headline-md text-headline-md text-on-surface mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">history</span>
                    Activity
                </h3>
                <div class="space-y-6 relative">
                    <div class="absolute left-[19px] top-4 bottom-4 w-0.5 bg-surface-container"></div>
                    @forelse($recentActivity as $activity)
                        <div class="relative flex gap-4">
                            <div
                                class="z-10 w-10 h-10 rounded-full bg-white border-2 border-primary-container flex items-center justify-center">
                                <span
                                    class="material-symbols-outlined text-primary text-[18px]">{{ $activity['icon'] ?? 'history' }}</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-body-md text-on-surface">
                                    <span class="font-bold">{{ $activity['user'] ?? 'User' }}</span>
                                    {{ $activity['action'] ?? 'acted' }}
                                </p>
                                <p class="text-label-sm text-on-surface-variant mt-1">{{ $activity['time'] ?? 'Recently' }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-on-surface-variant">
                            <p class="text-label-sm">No recent activity</p>
                        </div>
                    @endforelse
                </div>
                <button
                    class="w-full mt-6 text-primary font-label-md hover:bg-surface-container-low py-2 rounded-lg transition-colors">
                    View Full History
                </button>
            </div>
        </div>
    </div>

    <!-- Floating Action for Mobile / Quick Add -->
    <div class="fixed bottom-gutter-desktop right-gutter-desktop">
        <button
            class="w-14 h-14 bg-primary text-on-primary rounded-full shadow-lg flex items-center justify-center hover:scale-105 active:scale-95 transition-all">
            <span class="material-symbols-outlined text-[28px]">add</span>
        </button>
    </div>
@endsection

@push('scripts')
    <script>
        // Micro-interactions and subtle effects
        document.querySelectorAll('.task-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                // Potential for JS triggered animations
            });
        });

        // Simulating some focus states or interactions
        const progressFill = document.querySelector('.bg-secondary.transition-all');
        window.addEventListener('load', () => {
            progressFill.style.width = '0%';
            setTimeout(() => {
                progressFill.style.width = '68%';
            }, 300);
        });
    </script>
@endpush
