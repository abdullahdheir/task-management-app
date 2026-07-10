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
                    @if (auth()->id() === $project->owner_id)
                        <a href="{{ route('projects.edit', $project) }}"
                            class="text-primary font-label-md hover:underline">Edit</a>
                    @endif
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
                        <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}"
                            class="px-3 py-1 bg-primary text-white rounded-md text-label-sm hover:bg-primary-container transition-colors">
                            New Task
                        </a>
                    </div>
                </div>
                <div class="space-y-3">
                    @forelse($tasks as $task)
                        <div x-data="{ completed: {{ $task->is_completed ? 'true' : 'false' }}, open: false }" @click.outside="open = false"
                            class="task-card flex items-center justify-between p-4 rounded-lg transition-all duration-200 group relative"
                            :class="open ? 'z-50 bg-white border border-outline-variant shadow-lg' : (completed ?
                                'bg-surface-container-low border border-transparent opacity-80' :
                                'bg-white border border-outline-variant')">
                            <div class="flex items-center gap-4 flex-1 cursor-pointer"
                                @click="window.location.href = '{{ route('tasks.show', $task) }}'">
                                <div @click.stop="
                                         ajax.post('{{ route('tasks.complete', $task) }}')
                                             .then(res => {
                                                 if(res.status === 'success') {
                                                     completed = res.data.is_completed;
                                                     toast(completed ? 'Task completed!' : 'Task reopened');
                                                 }
                                             });
                                     "
                                    class="w-5 h-5 rounded-full transition-colors flex items-center justify-center cursor-pointer"
                                    :class="completed ? 'bg-secondary text-white' :
                                        'border-2 border-outline hover:border-secondary'">
                                    <span x-show="completed" class="material-symbols-outlined text-[16px]">check</span>
                                </div>
                                <div>
                                    <h4 :class="completed ? 'text-on-surface line-through' : 'text-on-surface'"
                                        class="font-body-lg text-body-lg">
                                        {{ $task->title }}</h4>
                                    <p class="text-label-sm text-on-surface-variant">{{ $task->category ?? 'Task' }} •
                                        {{ $task->due_date?->format('M d') ?? 'No due date' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase"
                                    :class="completed ? 'bg-secondary-container text-on-secondary-container' :
                                        'bg-tertiary-fixed text-on-tertiary-fixed'">
                                    <span
                                        x-text="completed ? 'Done' : '{{ ucfirst($task->priority ?? 'Normal') }}'"></span>
                                </span>
                                @if ($task->assignee)
                                    <a href="{{ route('profile.show.user', $task->assignee) }}"
                                        class="w-8 h-8 rounded-full border-2 border-white -ml-2 ring-1 ring-outline-variant block">
                                        <img class="w-full h-full rounded-full object-cover"
                                            src="{{ $task->assignee->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($task->assignee->name) . '&size=32' }}"
                                            alt="{{ $task->assignee->name }}">
                                    </a>
                                @endif
                                <div class="relative">
                                    <button @click.stop="open = !open"
                                        class="material-symbols-outlined text-on-surface-variant p-1 rounded-full hover:bg-surface-container transition-opacity duration-200 opacity-0 group-hover:opacity-100"
                                        :class="{ 'opacity-100 bg-surface-container': open }"> more_vert
                                    </button>
                                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute right-0 top-8 w-48 bg-surface border border-outline-variant
                                                rounded-xl shadow-xl z-100 overflow-hidden py-1"
                                        style="display:none">
                                        <a href="{{ route('tasks.show', $task) }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-on-surface hover:bg-surface-container
                                                  transition-colors font-label-md text-label-md">
                                            <span
                                                class="material-symbols-outlined text-[18px] text-secondary">open_in_new</span>
                                            View Details
                                        </a>
                                        @can('update', $task)
                                            <a href="{{ route('tasks.edit', $task) }}"
                                                class="flex items-center gap-3 px-4 py-2.5 text-on-surface hover:bg-surface-container
                                                  transition-colors font-label-md text-label-md">
                                                <span class="material-symbols-outlined text-[18px] text-secondary">edit</span>
                                                Edit Task
                                            </a>
                                        @endcan
                                        @can('delete', $task)
                                            <div class="border-t border-outline-variant my-1"></div>
                                            <button
                                                @click="
                                                    open = false;
                                                    if(confirm('Delete this task?')) {
                                                        ajax.delete('{{ route('tasks.destroy', $task) }}')
                                                            .then(res => {
                                                                if(res.status === 'success') {
                                                                    $el.closest('.task-card').remove();
                                                                    toast('Task deleted');
                                                                } else {
                                                                    toast(res.message ?? 'Error', 'error');
                                                                }
                                                            });
                                                    }"
                                                class="w-full flex items-center gap-3 px-4 py-2.5 text-error
                                                   hover:bg-error-container/20 transition-colors font-label-md text-label-md">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                                Delete Task
                                            </button>
                                        @endcan
                                    </div>
                                </div>
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
                        <div x-data="{ open: false }" @click.outside="open = false"
                            class="flex items-center justify-between group">
                            <a href="{{ route('profile.show.user', $member) }}" class="flex items-center gap-3 flex-1">
                                <img class="w-10 h-10 rounded-full object-cover"
                                    src="{{ $member->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&size=40' }}"
                                    alt="{{ $member->name }}">
                                <div>
                                    <p class="font-body-lg text-body-lg text-on-surface leading-tight">{{ $member->name }}
                                    </p>
                                    <p class="text-label-sm text-on-surface-variant">
                                        {{ $member->pivot->role ?? 'Team Member' }}
                                    </p>
                                </div>
                            </a>
                            @if (auth()->id() === $project->owner_id && auth()->id() !== $member->id)
                                <div class="relative">
                                    <button @click.stop="open = !open"
                                        class="material-symbols-outlined text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity p-1 rounded-full hover:bg-surface-container">
                                        more_vert
                                    </button>
                                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute right-0 top-8 w-48 bg-surface border border-outline-variant
                                            rounded-xl shadow-xl z-50 overflow-hidden py-1"
                                        style="display:none">
                                        <a href="{{ route('profile.show.user', $member) }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-on-surface hover:bg-surface-container
                                              transition-colors font-label-md text-label-md">
                                            <span
                                                class="material-symbols-outlined text-[18px] text-secondary">person</span>
                                            View Profile
                                        </a>
                                        <div class="border-t border-outline-variant my-1"></div>
                                        <button
                                            @click="
                                                open = false;
                                                if(confirm('Remove this member?')) {
                                                    ajax.delete('{{ route('projects.members.remove', [$project, $member]) }}')
                                                        .then(res => {
                                                            if(res.status === 'success') {
                                                                $el.closest('.flex.items-center.justify-between').remove();
                                                                toast('Member removed');
                                                            } else {
                                                                toast(res.message ?? 'Error', 'error');
                                                            }
                                                        });
                                                }"
                                            class="w-full flex items-center gap-3 px-4 py-2.5 text-error
                                               hover:bg-error-container/20 transition-colors font-label-md text-label-md">
                                            <span class="material-symbols-outlined text-[18px]">person_remove</span>
                                            Remove Member
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-4 text-on-surface-variant">
                            <p class="text-label-sm">No team members yet</p>
                        </div>
                    @endforelse
                    @php
                        $allUsers = \App\Models\User::where('id', '!=', auth()->id())
                            ->whereNotIn('id', $members->pluck('id'))
                            ->get();
                    @endphp
                    @if (auth()->id() === $project->owner_id)
                        <div x-data="{ showAddMember: false, selectedUserId: '', selectedRole: 'member' }">
                            <button @click="showAddMember = !showAddMember"
                                class="w-full mt-2 py-2 border-2 border-dashed border-outline-variant text-on-surface-variant rounded-lg font-label-md flex items-center justify-center gap-2 hover:border-primary hover:text-primary transition-all">
                                <span class="material-symbols-outlined text-[18px]">person_add</span>
                                Add Member
                            </button>

                            <form x-show="showAddMember" style="display:none"
                                class="mt-4 p-4 border border-outline-variant rounded-lg space-y-3 bg-surface-container-low"
                                method="POST" action="{{ route('projects.members.add', $project) }}">
                                @csrf
                                <div>
                                    <label class="block text-label-sm text-on-surface-variant mb-1">Select User</label>
                                    <select x-model="selectedUserId" name="user_id" required
                                        class="w-full px-3 py-1.5 rounded-lg border border-outline-variant bg-white text-body-md">
                                        <option value="">-- Choose User --</option>
                                        @foreach ($allUsers as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}
                                                ({{ $u->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-label-sm text-on-surface-variant mb-1">Role</label>
                                    <select x-model="selectedRole" name="role"
                                        class="w-full px-3 py-1.5 rounded-lg border border-outline-variant bg-white text-body-md">
                                        <option value="member">Member</option>
                                        <option value="lead">Lead</option>
                                        <option value="viewer">Viewer</option>
                                    </select>
                                </div>
                                <div class="flex justify-end gap-2 pt-2">
                                    <button type="button" @click="showAddMember = false"
                                        class="px-3 py-1.5 border border-outline-variant rounded-lg text-label-md hover:bg-surface-container transition-colors">
                                        Cancel
                                    </button>
                                    <button type="submit" :disabled="!selectedUserId"
                                        :class="!selectedUserId ? 'opacity-50 cursor-not-allowed' : ''"
                                        class="px-4 py-1.5 bg-primary text-white rounded-lg text-label-md hover:bg-primary-container transition-colors">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
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
                                <p class="text-label-sm text-on-surface-variant mt-1">
                                    {{ $activity['time'] ?? 'Recently' }}
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
