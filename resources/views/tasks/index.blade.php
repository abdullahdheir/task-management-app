@extends('layouts.app')

@section('title', 'Task List')

@section('content')

    {{-- Header --}}
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface dark:text-on-surface-dark">Task List</h2>
            <p class="font-body-md text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">
                You have {{ $remainingCount }} tasks remaining for today.
            </p>
        </div>
        <div class="flex gap-stack-md">
            <a href="{{ route('tasks.create') }}"
                class="px-4 py-2 bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark rounded-lg font-label-md text-label-md flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all shadow-md">
                <span class="material-symbols-outlined text-[18px]">add</span>
                Add Task
            </a>
        </div>
    </div>

    {{-- Filter Chips --}}
    <div class="flex flex-wrap gap-stack-md mb-8">
        <div class="flex items-center gap-2 pr-4 border-r border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
            <span class="text-label-sm font-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase tracking-wider">Priority</span>
            <a href="{{ request()->fullUrlWithQuery(['priority' => 'high']) }}"
                class="px-3 py-1 rounded-full text-label-sm font-label-sm transition-all
                    {{ request('priority') === 'high' ? 'bg-error dark:bg-error-dark text-on-error dark:text-on-error-dark' : 'bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark text-on-error dark:text-on-error-dark-container dark:text-on-error dark:text-on-error-dark-container-dark hover:brightness-95' }}">
                High
            </a>
            <a href="{{ request()->fullUrlWithQuery(['priority' => 'medium']) }}"
                class="px-3 py-1 rounded-full text-label-sm font-label-sm transition-all
                    {{ request('priority') === 'medium' ? 'bg-outline text-white' : 'bg-surface dark:bg-surface-dark-variant text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant dark:text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant-dark hover:brightness-95' }}">
                Medium
            </a>
            <a href="{{ request()->fullUrlWithQuery(['priority' => 'low']) }}"
                class="px-3 py-1 rounded-full text-label-sm font-label-sm transition-all
                    {{ request('priority') === 'low' ? 'bg-secondary dark:bg-secondary-dark text-on-secondary dark:text-on-secondary-dark' : 'bg-secondary dark:bg-secondary-dark-container dark:bg-secondary dark:bg-secondary-dark-container-dark text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant dark:text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant-dark hover:brightness-95' }}">
                Low
            </a>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-label-sm font-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase tracking-wider">Category</span>
            @foreach ($categories as $cat)
                <a href="{{ request()->fullUrlWithQuery(['category' => strtolower($cat['name'])]) }}"
                    class="px-3 py-1 rounded-full text-label-sm font-label-sm transition-all
                    {{ request('category') === strtolower($cat['name']) ? 'bg-primary dark:bg-primary-dark text-white' : 'bg-surface dark:bg-surface-dark-container-highest text-primary dark:text-primary-dark hover:bg-primary dark:bg-primary-dark hover:text-white' }}">
                    {{ $cat['name'] }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Bento Grid --}}
    <div class="grid grid-cols-12 gap-gutter-desktop">

        {{-- Task List --}}
        <div class="col-span-12 lg:col-span-8 space-y-4">
            @forelse($tasks as $task)
                @include('partials.task-item', ['task' => $task])
            @empty
                <div
                    class="flex items-center justify-center py-12 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark bg-surface dark:bg-surface-dark-container-low">
                    <div class="text-center">
                        <span class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-5xl mb-3">check_circle</span>
                        <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-body-md">No tasks found</p>
                        <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-label-sm mt-1">Create a new task to get started</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Right Column --}}
        <div class="col-span-12 lg:col-span-4 space-y-gutter-desktop">

            {{-- Weekly Goal --}}
            <div class="bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark rounded-2xl p-6 shadow-lg relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="font-headline-md text-headline-md mb-2">Weekly Goal</h3>
                    <p class="font-body-md text-body-md opacity-90 mb-6">
                        You've completed {{ $weeklyProgress }}% of your tasks this week. Keep it up!
                    </p>
                    <div class="w-full bg-white dark:bg-surface-container-low-dark/20 h-2 rounded-full mb-2">
                        <div class="bg-secondary dark:bg-secondary-dark-fixed dark:bg-secondary dark:bg-secondary-dark-fixed-dark h-full rounded-full" style="width: {{ $weeklyProgress }}%">
                        </div>
                    </div>
                    <span class="text-label-sm font-label-sm">{{ $weeklyCompleted }}/{{ $weeklyTotal }} tasks
                        finished</span>
                </div>
                <div class="absolute -right-4 -bottom-4 opacity-10">
                    <span class="material-symbols-outlined text-[120px]"
                        style="font-variation-settings: 'FILL' 1;">insights</span>
                </div>
            </div>

            {{-- Category Breakdown --}}
            <div class="bg-surface dark:bg-surface-dark-container-low rounded-2xl p-6 border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
                <h3 class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase tracking-widest mb-4">
                    Focus by Category
                </h3>
                <div class="space-y-4">
                    @forelse($categories as $cat)
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 rounded-full {{ $cat['color'] }}"></span>
                                <span class="font-body-md text-body-md">{{ $cat['name'] }}</span>
                            </div>
                            <span class="font-label-md text-label-md">{{ $cat['count'] }} Tasks</span>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-label-sm">No categories yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.task-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const label = this.closest('div').querySelector('label');
                if (this.checked) {
                    label?.classList.add('line-through', 'text-outline dark:text-outline-dark');
                    this.closest('.task-row')?.classList.add('opacity-60');
                } else {
                    label?.classList.remove('line-through', 'text-outline dark:text-outline-dark');
                    this.closest('.task-row')?.classList.remove('opacity-60');
                }
            });
        });
    </script>
@endpush
