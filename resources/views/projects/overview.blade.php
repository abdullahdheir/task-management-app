@extends('layouts.app')

@section('title', 'Projects Overview')

@section('content')
    <!-- Canvas Area -->
    <section class="flex-1 overflow-y-auto p-gutter-desktop custom-scrollbar bg-surface dark:bg-surface-dark">
        <div class="max-w-container-max mx-auto">
            <!-- Header Actions -->
            <div class="flex justify-between items-end mb-stack-lg">
                <div>
                    <h2 class="text-headline-lg font-headline-lg text-on-surface dark:text-on-surface-dark mb-2">Projects Overview</h2>
                    <p class="text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Manage your team's initiatives and track
                        real-time progress.</p>
                </div>
                <div class="flex gap-stack-md">
                    <button
                        class="px-4 py-2 border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark rounded-lg font-label-md hover:bg-surface dark:bg-surface-dark-container-low transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">filter_list</span>
                        Filter
                    </button>
                    <a href="{{ route('projects.create') }}"
                        class="px-4 py-2 bg-primary dark:bg-primary-dark text-white rounded-lg font-label-md shadow-lg shadow-primary/20 flex items-center gap-2 active:scale-95 transition-transform">
                        <span class="material-symbols-outlined text-[18px]">add_circle</span>
                        New Project
                    </a>
                </div>
            </div>
            <!-- Stats Overview Bento -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter-desktop mb-stack-lg">
                <div class="p-6 glass-card rounded-xl shadow-sm col-span-1 border-l-4 border-primary dark:border-primary-dark">
                    <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase font-bold tracking-widest mb-1">Total
                        Active</p>
                    <h3 class="text-headline-lg font-headline-lg text-primary dark:text-primary-dark">{{ $stats['totalActive'] ?? 0 }}</h3>
                    <div
                        class="mt-4 flex items-center gap-2 text-on-secondary dark:text-on-secondary-dark-container dark:text-on-secondary dark:text-on-secondary-dark-container-dark bg-secondary dark:bg-secondary-dark-container dark:bg-secondary dark:bg-secondary-dark-container-dark/30 px-2 py-0.5 rounded-full w-fit">
                        <span class="material-symbols-outlined text-xs">trending_up</span>
                        <span class="text-label-sm">Active projects</span>
                    </div>
                </div>
                <div class="p-6 glass-card rounded-xl shadow-sm col-span-1 border-l-4 border-secondary dark:border-secondary-dark">
                    <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase font-bold tracking-widest mb-1">
                        Completed</p>
                    <h3 class="text-headline-lg font-headline-lg text-secondary dark:text-secondary-dark">{{ $stats['totalCompleted'] ?? 0 }}</h3>
                    <div
                        class="mt-4 flex items-center gap-2 text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark bg-surface dark:bg-surface-dark-container-highest px-2 py-0.5 rounded-full w-fit">
                        <span class="material-symbols-outlined text-xs">done_all</span>
                        <span class="text-label-sm">Total completed</span>
                    </div>
                </div>
                <div class="p-6 glass-card rounded-xl shadow-sm col-span-1 border-l-4 border-tertiary-container">
                    <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase font-bold tracking-widest mb-1">
                        Average Velocity</p>
                    <h3 class="text-headline-lg font-headline-lg text-tertiary dark:text-tertiary-dark-container">
                        {{ $stats['averageVelocity'] ?? 0 }}%</h3>
                    <div class="mt-4 w-full bg-surface dark:bg-surface-dark-container h-1 rounded-full overflow-hidden">
                        <div class="h-full bg-tertiary dark:bg-tertiary-dark-container dark:bg-tertiary dark:bg-tertiary-dark-container-dark" style="width: {{ $stats['averageVelocity'] ?? 0 }}%">
                        </div>
                    </div>
                </div>
                <div class="p-6 glass-card rounded-xl shadow-sm col-span-1 bg-primary dark:bg-primary-dark text-white overflow-hidden relative">
                    <div class="relative z-10">
                        <p class="text-label-sm opacity-80 uppercase font-bold tracking-widest mb-1">System Load</p>
                        <h3 class="text-headline-lg font-headline-lg">Optimal</h3>
                        <p class="text-body-md mt-4 opacity-90">All systems operational</p>
                    </div>
                    <span
                        class="material-symbols-outlined absolute -right-4 -bottom-4 text-[100px] opacity-10">cloud_done</span>
                </div>
            </div>
            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter-desktop">
                @forelse($projects as $project)
                    <div x-data="{ open: false }" @click.outside="open = false"
                        class="group bg-white dark:bg-surface-container-low-dark rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-stack-lg flex flex-col h-full relative">
                        <div class="flex justify-between items-start mb-stack-md">
                            <div class="p-2 bg-secondary dark:bg-secondary-dark-container dark:bg-secondary dark:bg-secondary-dark-container-dark/20 rounded-lg text-secondary dark:text-secondary-dark">
                                <span class="material-symbols-outlined">folder</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="px-2 py-1 {{ $project->status === 'completed' ? 'bg-secondary dark:bg-secondary-dark text-white' : ($project->status === 'on_hold' ? 'bg-surface dark:bg-surface-dark-container-highest text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark' : 'bg-secondary dark:bg-secondary-dark-container dark:bg-secondary dark:bg-secondary-dark-container-dark text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant dark:text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant-dark') }} font-label-md text-label-sm rounded-md">{{ ucfirst($project->status ?? 'active') }}</span>
                                <div class="relative">
                                    <button @click.stop="open = !open"
                                        class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark transition-colors p-1 rounded-full hover:bg-surface dark:bg-surface-dark-container">
                                        <span class="material-symbols-outlined">more_vert</span>
                                    </button>
                                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute right-0 top-8 w-48 bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark
                                                rounded-xl shadow-xl z-50 overflow-hidden py-1"
                                        style="display:none">
                                        <a href="{{ route('projects.show', $project) }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-on-surface dark:text-on-surface-dark hover:bg-surface dark:bg-surface-dark-container
                                                  transition-colors font-label-md text-label-md">
                                            <span
                                                class="material-symbols-outlined text-[18px] text-secondary dark:text-secondary-dark">open_in_new</span>
                                            View Details
                                        </a>
                                        @if (auth()->id() === $project->owner_id)
                                            <a href="{{ route('projects.edit', $project) }}"
                                                class="flex items-center gap-3 px-4 py-2.5 text-on-surface dark:text-on-surface-dark hover:bg-surface dark:bg-surface-dark-container
                                                  transition-colors font-label-md text-label-md">
                                                <span
                                                    class="material-symbols-outlined text-[18px] text-secondary dark:text-secondary-dark">edit</span>
                                                Edit Project
                                            </a>
                                            <div class="border-t border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark my-1"></div>
                                            <button
                                                @click="
                                                    open = false;
                                                    if(confirm('Delete this project?')) {
                                                        ajax.delete('{{ route('projects.destroy', $project) }}')
                                                            .then(res => {
                                                                if(res.status === 'success') {
                                                                    $el.closest('.group').remove();
                                                                    toast('Project deleted');
                                                                } else {
                                                                    toast(res.message ?? 'Error', 'error');
                                                                }
                                                            });
                                                    }"
                                                class="w-full flex items-center gap-3 px-4 py-2.5 text-error dark:text-error-dark
                                                   hover:bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark/20 transition-colors font-label-md text-label-md">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                                Delete Project
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('projects.show', $project) }}" class="flex-1 flex flex-col">
                            <h4
                                class="text-headline-md font-headline-md text-on-surface dark:text-on-surface-dark mb-2 group-hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark transition-colors">
                                {{ $project->name }}</h4>
                            <p class="text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-6 flex-1">
                                {{ $project->description ?? 'No description' }}</p>
                        </a>
                        <div class="mb-4 {{ $project->status === 'on_hold' ? 'opacity-60' : '' }}">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-label-md font-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Progress</span>
                                <span
                                    class="text-label-md font-bold {{ $project->status === 'completed' ? 'text-secondary dark:text-secondary-dark' : 'text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark' }}">{{ $project->progress ?? 0 }}%</span>
                            </div>
                            <div class="w-full h-1.5 bg-surface dark:bg-surface-dark-container rounded-full overflow-hidden">
                                <div class="h-full {{ $project->status === 'completed' ? 'bg-secondary dark:bg-secondary-dark' : 'bg-secondary dark:bg-secondary-dark' }} transition-all duration-1000"
                                    style="width: {{ $project->progress ?? 0 }}%">
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pt-stack-md border-t border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark/30">
                            <div class="flex -space-x-2">
                                @if ($project->owner)
                                    <img class="w-8 h-8 rounded-full border-2 border-white object-cover"
                                        src="{{ $project->owner->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($project->owner->name) . '&size=32' }}"
                                        alt="{{ $project->owner->name }}">
                                @endif
                            </div>
                            <span
                                class="text-label-sm {{ $project->status === 'completed' ? 'text-secondary dark:text-secondary-dark font-bold' : 'text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark' }} flex items-center gap-1">
                                <span
                                    class="material-symbols-outlined text-sm">{{ $project->status === 'completed' ? 'check_circle' : 'schedule' }}</span>
                                {{ $project->status === 'completed' ? 'Finished' : 'Active' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-3 flex items-center justify-center py-12 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark bg-surface dark:bg-surface-dark-container-low">
                        <div class="text-center">
                            <span class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-5xl mb-3">folder_open</span>
                            <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-body-md">No projects yet</p>
                            <a href="{{ route('projects.create') }}"
                                class="text-primary dark:text-primary-dark font-label-md hover:underline mt-2 inline-block">Create your first
                                project</a>
                        </div>
                    </div>
                @endforelse
                <!-- New Project Empty State / Call to Action -->
                @if (!$projects->isEmpty())
                    <a href="{{ route('projects.create') }}"
                        class="group bg-surface dark:bg-surface-dark-container-low border-2 border-dashed border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-xl hover:border-primary dark:border-primary-dark hover:bg-white dark:bg-surface-container-low-dark transition-all duration-300 p-stack-lg flex flex-col items-center justify-center h-full text-center cursor-pointer">
                        <div
                            class="w-16 h-16 rounded-full bg-white dark:bg-surface-container-low-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark flex items-center justify-center mb-4 group-hover:bg-primary dark:bg-primary-dark group-hover:text-white transition-colors duration-300">
                            <span class="material-symbols-outlined text-[32px]">add</span>
                        </div>
                        <h4 class="text-headline-md font-headline-md text-on-surface dark:text-on-surface-dark mb-2">Start Something New</h4>
                        <p class="text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark px-8">Define goals, assemble your team, and
                            launch your next big idea.</p>
                        <div
                            class="mt-6 px-6 py-2 bg-surface dark:bg-surface-dark-container-highest rounded-full text-label-md font-bold text-primary dark:text-primary-dark group-hover:bg-primary dark:bg-primary-dark group-hover:text-white transition-colors">
                            Launch Project
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Micro-interactions Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Placeholder for interactivity
            const cards = document.querySelectorAll('.group');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    // Logic for card hover effects could go here
                });
            });

            // Smooth entrance for progress bars
            const progressBars = document.querySelectorAll('.bg-secondary dark:bg-secondary-dark');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 100);
            });
        });
    </script>
@endpush
