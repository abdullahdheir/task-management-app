@extends('layouts.app')

@section('title', 'Task Details')

@push('styles')
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .task-card-active {
            box-shadow: 0px 4px 6px -1px rgba(0, 0, 0, 0.05), 0px 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
    </style>
@endpush

@section('content')
    <!-- Task Detailed View -->
    <div class="max-w-container-max mx-auto p-gutter-desktop" x-data="{ completed: {{ $task->is_completed ? 'true' : 'false' }} }">
        <!-- Breadcrumbs / Navigation Back -->
        <a href="" @click.prevent="history.back();"
            class="flex items-center gap-2 mb-stack-lg text-on-surface-variant hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            <span class="font-label-md text-label-md">Back</span>
        </a>
        <!-- Task Header -->
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-stack-lg mb-stack-lg">
            <div class="space-y-stack-sm">
                <div class="flex items-center gap-stack-md flex-wrap">
                    <span
                        class="px-3 py-1 bg-surface-container-high text-on-secondary-container rounded-full font-label-sm text-label-sm flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">work</span>
                        {{ ucfirst($task->category ?? 'Work') }}
                    </span>
                    <span
                        class="px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-full font-label-sm text-label-sm flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">priority_high</span>
                        {{ ucfirst($task->priority ?? 'medium') }} Priority
                    </span>
                </div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight transition-all"
                    :class="completed ? 'line-through text-outline' : ''">{{ $task->title }}</h2>
            </div>
            <div class="flex items-center gap-2">
                <button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined">share</span>
                </button>
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open"
                        class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined">more_horiz</span>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 top-11 w-48 bg-surface border border-outline-variant
                                rounded-xl shadow-xl z-50 overflow-hidden py-1"
                        style="display:none">
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
                                                    toast('Task deleted');
                                                    window.location.href = '{{ route('tasks.index') }}';
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
                <button
                    @click="
                        ajax.post('{{ route('tasks.complete', $task) }}')
                            .then(res => {
                                if(res.status === 'success') {
                                    completed = res.data.is_completed;
                                    toast(completed ? 'Task completed!' : 'Task reopened');
                                }
                            }).catch(() => toast('Something went wrong', 'error'))
                    "
                    class="px-6 py-2 rounded-lg font-label-md text-label-md flex items-center gap-2 transition-all"
                    :class="completed ? 'bg-secondary-container text-on-secondary-fixed-variant' : 'bg-primary text-on-primary'">
                    <span class="material-symbols-outlined text-[18px]"
                        :style="completed ? '' : 'font-variation-settings: \'FILL\' 1;'">check_circle</span>
                    <span x-text="completed ? 'Reopen Task' : 'Mark Complete'"></span>
                </button>
            </div>
        </div>
        <!-- Bento Layout Content -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-stack-lg">
            <!-- Left Column: Main Info -->
            <div class="lg:col-span-8 space-y-stack-lg">
                <!-- Description Card -->
                <section class="bg-surface-container-lowest p-stack-lg rounded-xl border border-outline-variant/30">
                    <h3 class="font-headline-md text-headline-md mb-stack-md">Description</h3>
                    <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                        {{ $task->description ?? 'No description provided.' }}
                    </p>
                </section>
                <!-- Sub-tasks Checklist -->
                <section class="bg-surface-container-lowest p-stack-lg rounded-xl border border-outline-variant/30">
                    <div class="flex justify-between items-center mb-stack-md">
                        <h3 class="font-headline-md text-headline-md">Sub-tasks</h3>
                        <span
                            class="text-label-md font-label-md text-on-surface-variant">{{ $subtasks->where('is_completed', true)->count() }}
                            of {{ $subtasks->count() }} complete</span>
                    </div>
                    <div class="w-full bg-surface-container rounded-full h-1.5 mb-stack-lg">
                        @php $subtaskProgress = $subtasks->count() > 0 ? ($subtasks->where('is_completed', true)->count() / $subtasks->count()) * 100 : 0; @endphp
                        <div class="bg-secondary h-1.5 rounded-full" style="width: {{ $subtaskProgress }}%"></div>
                    </div>
                    <ul class="space-y-2">
                        @forelse($subtasks as $subtask)
                            <li x-data="{ subcompleted: {{ $subtask->is_completed ? 'true' : 'false' }} }" :class="subcompleted ? 'opacity-60' : ''"
                                class="flex items-center gap-3 p-3 hover:bg-surface-container-low transition-colors rounded-lg group">
                                <input type="checkbox"
                                    class="w-5 h-5 rounded-full border-secondary text-secondary focus:ring-secondary cursor-pointer"
                                    :checked="subcompleted"
                                    @change="
                                        ajax.post('{{ route('tasks.complete', $subtask) }}')
                                            .then(res => {
                                                if(res.status === 'success') {
                                                    subcompleted = res.data.is_completed;
                                                    toast(subcompleted ? 'Subtask completed!' : 'Subtask reopened');
                                                }
                                            }).catch(() => toast('Something went wrong', 'error'))
                                    " />
                                <span :class="subcompleted ? 'text-on-surface-variant line-through' : 'text-on-surface'"
                                    class="font-body-md text-body-md">{{ $subtask->title }}</span>
                            </li>
                        @empty
                            <li class="text-center py-4 text-on-surface-variant text-label-sm">No sub-tasks yet</li>
                        @endforelse
                    </ul>
                    <div x-data="{ showForm: false, title: '' }">
                        <button @click="showForm = !showForm"
                            class="mt-stack-md flex items-center gap-2 text-primary font-label-md text-label-md hover:underline">
                            <span class="material-symbols-outlined text-[16px]">add</span> Add Sub-task
                        </button>

                        <form x-show="showForm" style="display:none" class="mt-4 flex gap-2" method="POST"
                            action="{{ route('tasks.subtasks.store', $task) }}">
                            @csrf
                            <input x-model="title" type="text" name="title" required placeholder="Subtask title"
                                class="flex-grow bg-surface-container-low border border-outline-variant rounded-lg px-3 py-1.5 text-body-md focus:ring-2 focus:ring-primary-container">
                            <button type="submit" :disabled="!title.trim()"
                                :class="!title.trim() ? 'opacity-50 cursor-not-allowed' : ''"
                                class="bg-primary text-on-primary px-4 py-1.5 rounded-lg font-label-sm text-label-sm">
                                Create
                            </button>
                        </form>
                    </div>
                </section>
                {{-- Activity Thread --}}
                <section class="bg-surface-container-lowest p-stack-lg rounded-xl border border-outline-variant/30"
                    x-data="{
                        body: '',
                        loading: false,
                        async submitComment() {
                            if (!this.body.trim()) return;
                            this.loading = true;
                            try {
                                const res = await ajax.post('{{ route('comments.store') }}', {
                                    commentable_type: 'App\\Models\\Task',
                                    commentable_id: '{{ $task->id }}',
                                    body: this.body
                                });
                                if (res.status === 'success') {
                                    toast('Comment added');
                                    this.body = '';
                                    await this.loadComments();
                                } else {
                                    toast(res.message ?? 'Error', 'error');
                                }
                            } catch {
                                toast('Failed to add comment', 'error');
                            } finally {
                                this.loading = false;
                            }
                        },
                        async loadComments() {
                            const res = await fetch('{{ route('tasks.comments', $task) }}', {
                                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
                            });
                            const html = await res.text();
                            this.$refs.commentsList.innerHTML = html;
                        }
                    }">

                    <h3 class="font-headline-md text-headline-md mb-stack-lg">Activity</h3>

                    {{-- Comments List --}}
                    <div class="space-y-stack-lg" x-ref="commentsList">
                        @include('partials.comments-list', ['comments' => $comments])
                    </div>

                    {{-- Comment Box --}}
                    <div class="flex gap-4 items-start pt-stack-md">
                        <div
                            class="w-10 h-10 rounded-full bg-surface-variant flex items-center justify-center text-on-surface-variant">
                            <span class="material-symbols-outlined">account_circle</span>
                        </div>
                        <div class="flex-grow">
                            <textarea x-model="body"
                                class="w-full bg-surface-container-low border border-outline-variant rounded-xl p-3 
                       text-body-md font-body-md focus:ring-2 focus:ring-primary-container h-24 resize-none"
                                placeholder="Write a comment..." @keydown.ctrl.enter="submitComment()"></textarea>
                            <div class="mt-2 flex justify-end">
                                <button @click="submitComment()" :disabled="body.trim() === '' || loading"
                                    :class="body.trim() === '' || loading ? 'opacity-50 cursor-not-allowed' :
                                        'hover:opacity-90'"
                                    class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md 
                               text-label-md transition-all flex items-center gap-2">
                                    <span x-show="loading"
                                        class="material-symbols-outlined text-[16px] animate-spin">progress_activity</span>
                                    <span x-text="loading ? 'Posting...' : 'Post Comment'"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- Right Column: Metadata & Attachments -->
            <div class="lg:col-span-4 space-y-stack-lg">
                <!-- Metadata Card -->
                <aside
                    class="bg-surface-container-lowest p-stack-lg rounded-xl border border-outline-variant/30 space-y-stack-lg">
                    <div>
                        <h4 class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-2">
                            Assignee</h4>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center text-label-md font-bold">
                                {{ substr($task->assignee->name ?? (auth()->user()->name ?? 'U'), 0, 2) }}</div>
                            <span
                                class="font-label-md text-label-md">{{ $task->assignee->name ?? (auth()->user()->name ?? 'Unassigned') }}</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-2">Due
                            Date</h4>
                        <div class="flex items-center gap-3 text-on-surface">
                            <span class="material-symbols-outlined text-primary">calendar_today</span>
                            <span
                                class="font-label-md text-label-md">{{ $task->due_date?->format('F d, Y') ?? 'No due date' }}</span>
                        </div>
                    </div>
                    @if ($task->project)
                        <div>
                            <h4 class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-2">
                                Project</h4>
                            <a class="flex items-center gap-3 text-primary hover:underline"
                                href="{{ route('projects.show', $task->project) }}">
                                <span class="material-symbols-outlined">link</span>
                                <span class="font-label-md text-label-md">{{ $task->project->name }}</span>
                            </a>
                        </div>
                    @endif
                    <div>
                        <h4 class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-2">
                            Labels
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-2 py-0.5 bg-secondary-container text-on-secondary-container rounded font-label-sm text-label-sm">{{ ucfirst($task->category ?? 'Task') }}</span>
                            <span
                                class="px-2 py-0.5 bg-surface-variant text-on-surface-variant rounded font-label-sm text-label-sm">{{ ucfirst($task->priority ?? 'Normal') }}</span>
                        </div>
                    </div>
                </aside>
                <!-- Attachments Card -->
                <section class="bg-surface-container-lowest p-stack-lg rounded-xl border border-outline-variant/30">
                    <div class="flex justify-between items-center mb-stack-md">
                        <h3 class="font-headline-md text-headline-md">Attachments</h3>
                        <button onclick="document.getElementById('attachment-input').click()"
                            class="text-primary material-symbols-outlined">add_circle</button>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        @forelse($attachments as $attachment)
                            <div data-attachment-item
                                class="group relative overflow-hidden rounded-lg border border-outline-variant/50 cursor-pointer">
                                <div onclick="window.open('{{ $attachment->url }}', '_blank')"
                                    class="w-full h-24 bg-surface-container-low flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                    <span
                                        class="material-symbols-outlined text-4xl text-on-surface-variant">description</span>
                                </div>
                                @if (auth()->id() === $attachment->user_id)
                                    <button
                                        @click.stop="
                                                if(confirm('Delete this attachment?')) {
                                                    ajax.delete('{{ route('attachments.destroy', $attachment) }}')
                                                        .then(res => {
                                                            if(res.status === 'success') {
                                                                $el.closest('[data-attachment-item]').remove();
                                                                toast('Attachment deleted');
                                                            }
                                                        });
                                                }
                                            "
                                        class="absolute top-2 right-2 bg-white/80 p-1 rounded-full text-error opacity-0 group-hover:opacity-100 transition-opacity hover:bg-error-container/20">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                    </button>
                                @endif
                                <div class="p-2 bg-white/90 backdrop-blur-sm"
                                    onclick="window.open('{{ $attachment->url }}', '_blank')">
                                    <p class="font-label-sm text-label-sm truncate">{{ $attachment->filename }}</p>
                                    <p class="text-[10px] text-on-surface-variant">{{ $attachment->human_size }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-4 text-on-surface-variant text-label-sm">
                                No attachments yet
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-stack-md space-y-2">
                        <div onclick="document.getElementById('attachment-input').click()"
                            class="flex items-center gap-3 p-2 border border-dashed border-outline-variant rounded-lg hover:bg-surface-container transition-colors cursor-pointer">
                            <span class="material-symbols-outlined text-on-surface-variant">upload_file</span>
                            <span class="font-label-md text-label-md text-on-surface-variant">Drop files here to
                                upload</span>
                        </div>
                    </div>
                    <form id="attachment-form" action="{{ route('attachments.store', $task) }}" method="POST"
                        enctype="multipart/form-data" class="hidden">
                        @csrf
                        <input type="file" name="file" id="attachment-input"
                            onchange="document.getElementById('attachment-form').submit();">
                    </form>
                </section>
                <!-- Atmospheric Animation Element (Subtle) -->
                <div class="relative h-32 rounded-xl overflow-hidden border border-outline-variant/30">

                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                        <span class="material-symbols-outlined text-primary mb-1">auto_awesome</span>
                        <p class="text-label-sm font-label-sm text-primary">Focused Session Active</p>
                        <p class="text-[10px] text-on-surface-variant">Keep your flow state going</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Micro-interaction: Checkbox strike-through trigger
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const textSpan = this.nextElementSibling;
                if (this.checked) {
                    textSpan.classList.add('line-through', 'text-on-surface-variant');
                    textSpan.classList.remove('text-on-surface');
                } else {
                    textSpan.classList.remove('line-through', 'text-on-surface-variant');
                    textSpan.classList.add('text-on-surface');
                }
            });
        });

        // Micro-interaction: Floating labels for textarea (simplified)
        const textarea = document.querySelector('textarea');
        textarea.addEventListener('focus', () => {
            textarea.classList.add('shadow-lg');
        });
        textarea.addEventListener('blur', () => {
            textarea.classList.remove('shadow-lg');
        });
    </script>
@endpush
