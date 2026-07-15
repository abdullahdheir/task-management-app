@php
    $priorityClasses = [
        'high' => 'bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark text-on-error dark:text-on-error-dark-container dark:text-on-error dark:text-on-error-dark-container-dark',
        'medium' => 'bg-surface dark:bg-surface-dark-variant text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant dark:text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant-dark',
        'low' => 'bg-secondary dark:bg-secondary-dark-container dark:bg-secondary dark:bg-secondary-dark-container-dark text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant dark:text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant-dark',
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
    class="task-row bg-surface dark:bg-surface-dark-container-lowest border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-xl p-4 flex items-center gap-4 hover:shadow-sm transition-all group"
    :class="completed ? 'opacity-60' : ''">
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
        class="task-checkbox w-5 h-5 rounded-full border-2 border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark text-secondary dark:text-secondary-dark focus:ring-secondary cursor-pointer">

    <div class="flex-grow cursor-pointer" @click="window.location.href = '{{ $taskRoute }}'">
        <label 
            class="font-body-lg text-body-lg text-on-surface dark:text-on-surface-dark block cursor-pointer transition-colors"
            :class="completed ? 'line-through text-outline dark:text-outline-dark' : ''">
            {{ $task['title'] }}
        </label>
        <div class="flex items-center gap-4 mt-1">
            <span class="flex items-center gap-1 text-label-sm font-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">
                <span class="material-symbols-outlined text-[14px]">{{ $dueIcon }}</span>
                {{ $task['due'] ?? '' }}
            </span>
            <span
                class="px-2 py-0.5 bg-surface dark:bg-surface-dark-container-high text-primary dark:text-primary-dark rounded text-[10px] font-bold uppercase tracking-tighter">
                {{ $task['category'] ?? '' }}
            </span>
        </div>
    </div>

    <span class="px-2 py-1 {{ $priorityClass }} rounded-lg text-label-sm font-label-sm capitalize">
        {{ $task['priority'] ?? 'low' }}
    </span>

    <div class="relative">
        <button @click.stop="open = !open"
            class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark transition-opacity p-1 rounded-full hover:bg-surface dark:bg-surface-dark-container"
            :class="completed ? '' : 'opacity-0 group-hover:opacity-100'">
            more_vert
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 top-8 w-48 bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark
                    rounded-xl shadow-xl z-50 overflow-hidden py-1"
            style="display:none">
            <a href="{{ $taskRoute }}"
                class="flex items-center gap-3 px-4 py-2.5 text-on-surface dark:text-on-surface-dark hover:bg-surface dark:bg-surface-dark-container
                      transition-colors font-label-md text-label-md">
                <span class="material-symbols-outlined text-[18px] text-secondary dark:text-secondary-dark">open_in_new</span>
                View Details
            </a>
            @can('update', $task['model'])
            <a href="{{ $editRoute }}"
                class="flex items-center gap-3 px-4 py-2.5 text-on-surface dark:text-on-surface-dark hover:bg-surface dark:bg-surface-dark-container
                      transition-colors font-label-md text-label-md">
                <span class="material-symbols-outlined text-[18px] text-secondary dark:text-secondary-dark">edit</span>
                Edit Task
            </a>
            @endcan
            @can('delete', $task['model'])
            <div class="border-t border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark my-1"></div>
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
                class="w-full flex items-center gap-3 px-4 py-2.5 text-error dark:text-error-dark
                       hover:bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark/20 transition-colors font-label-md text-label-md">
                <span class="material-symbols-outlined text-[18px]">delete</span>
                Delete Task
            </button>
            @endcan
        </div>
    </div>
</div>
