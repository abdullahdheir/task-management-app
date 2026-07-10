@php
    $priorityClasses = [
        'high' => 'bg-error-container text-on-error-container',
        'medium' => 'bg-surface-variant text-on-secondary-fixed-variant',
        'low' => 'bg-secondary-container text-on-secondary-fixed-variant',
    ];
    $dueIcon = $task['completed'] ?? false ? 'check_circle' : 'calendar_today';
    $priorityClass = $priorityClasses[$task['priority'] ?? 'low'] ?? $priorityClasses['low'];
    $taskId = $task['id'] ?? null;
    $taskRoute = $taskId ? route('tasks.show', $taskId) : '#';
    $completeRoute = $taskId ? route('tasks.complete', $taskId) : '#';
    $editRoute = $taskId ? route('tasks.edit', $taskId) : '#';
    $deleteRoute = $taskId ? route('tasks.destroy', $taskId) : '#';
@endphp

<div x-data="{ completed: {{ $task['completed'] ?? false ? 'true' : 'false' }}, open: false }" data-task-row @click.outside="open = false"
    class="task-row bg-surface-container-lowest border border-outline-variant rounded-xl p-4 flex items-center gap-4 hover:shadow-sm transition-all group {{ $task['completed'] ?? false ? 'opacity-60' : '' }}">
    <input type="checkbox" id="task-{{ $taskId }}" :checked="completed" @click.stop
        @change="
               ajax.post('{{ $completeRoute }}')
                   .then(res => {
                       if(res.status === 'success') {
                           completed = res.data.is_completed;
                           toast(completed ? 'Task completed!' : 'Task reopened');
                       }
                   }).catch(() => toast('Something went wrong', 'error'))
           "
        class="task-checkbox w-5 h-5 rounded-full border-2 border-outline-variant text-secondary focus:ring-secondary cursor-pointer">

    <div class="flex-grow cursor-pointer" @click="window.location.href = '{{ $taskRoute }}'">
        <label for="task-{{ $taskId }}"
            class="font-body-lg text-body-lg text-on-surface block cursor-pointer transition-colors {{ $task['completed'] ?? false ? 'line-through text-outline' : '' }}">
            {{ $task['title'] }}
        </label>
        <div class="flex items-center gap-4 mt-1">
            <span class="flex items-center gap-1 text-label-sm font-label-sm text-on-surface-variant">
                <span class="material-symbols-outlined text-[14px]">{{ $dueIcon }}</span>
                {{ $task['due'] ?? '' }}
            </span>
            <span
                class="px-2 py-0.5 bg-surface-container-high text-primary rounded text-[10px] font-bold uppercase tracking-tighter">
                {{ $task['category'] ?? '' }}
            </span>
        </div>
    </div>

    <span class="px-2 py-1 {{ $priorityClass }} rounded-lg text-label-sm font-label-sm capitalize">
        {{ $task['priority'] ?? 'low' }}
    </span>

    <div class="relative">
        <button @click.stop="open = !open"
            class="material-symbols-outlined text-on-surface-variant {{ $task['completed'] ?? false ? '' : 'opacity-0 group-hover:opacity-100' }} transition-opacity p-1 rounded-full hover:bg-surface-container">
            more_vert
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 top-8 w-48 bg-surface border border-outline-variant
                    rounded-xl shadow-xl z-50 overflow-hidden py-1"
            style="display:none">
            <a href="{{ $taskRoute }}"
                class="flex items-center gap-3 px-4 py-2.5 text-on-surface hover:bg-surface-container
                      transition-colors font-label-md text-label-md">
                <span class="material-symbols-outlined text-[18px] text-secondary">open_in_new</span>
                View Details
            </a>
            <a href="{{ $editRoute }}"
                class="flex items-center gap-3 px-4 py-2.5 text-on-surface hover:bg-surface-container
                      transition-colors font-label-md text-label-md">
                <span class="material-symbols-outlined text-[18px] text-secondary">edit</span>
                Edit Task
            </a>
            <div class="border-t border-outline-variant my-1"></div>
            <button
                @click="
                        open = false;
                        if(confirm('Delete this task?')) {
                            ajax.delete('{{ $deleteRoute }}')
                                .then(res => {
                                    if(res.status === 'success') {
                                        $el.closest('[data-task-row]').remove();
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
        </div>
    </div>
</div>
