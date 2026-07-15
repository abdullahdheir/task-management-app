@php
    $priorityClasses = [
        'high' => 'bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark text-on-error dark:text-on-error-dark-container dark:text-on-error dark:text-on-error-dark-container-dark',
        'medium' => 'bg-tertiary dark:bg-tertiary-dark-fixed dark:bg-tertiary dark:bg-tertiary-dark-fixed-dark text-on-tertiary dark:text-on-tertiary-dark-fixed',
        'low' => 'bg-secondary dark:bg-secondary-dark-container dark:bg-secondary dark:bg-secondary-dark-container-dark text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant dark:text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant-dark',
    ];
    $priorityClass = $priorityClasses[$task->priority ?? 'low'] ?? $priorityClasses['low'];
    $isOverdue = $task->due_date && $task->due_date->isPast() && !$task->completed;
    $taskRoute = route('tasks.show', $task);
    $completeRoute = route('tasks.complete', $task);
    $editRoute = route('tasks.edit', $task);
    $deleteRoute = route('tasks.destroy', $task);
@endphp

<div x-data="{ completed: {{ $task->completed ? 'true' : 'false' }}, open: false }" @click.outside="open = false"
    class="flex items-center gap-4 p-3 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark hover:bg-surface dark:bg-surface-dark-container-low transition-colors group cursor-pointer"
    :class="completed ? 'opacity-60' : ''"
    @click="window.location.href = '{{ $taskRoute }}'">
    <div class="flex-shrink-0">
        <input type="checkbox" id="task-{{ $task->id }}" :checked="completed" @click.stop
            @change="
                   ajax.post('{{ $completeRoute }}')
                       .then(res => {
                           if(res.status === 'success') {
                               completed = res.data.is_completed;
                               toast(completed ? 'Task completed!' : 'Task reopened');
                           }
                       }).catch(() => toast('Something went wrong', 'error'))
               "
            class="w-5 h-5 rounded-full border-2 border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark text-secondary dark:text-secondary-dark focus:ring-secondary cursor-pointer">
    </div>
    <div class="flex-grow min-w-0">
        <label 
            class="font-body-md text-body-md text-on-surface dark:text-on-surface-dark block cursor-pointer transition-colors truncate"
            :class="completed ? 'line-through text-outline dark:text-outline-dark' : ''">
            {{ $task->title }}
        </label>
        <div class="flex items-center gap-2 mt-1">
            <span
                class="flex items-center gap-1 text-label-sm font-label-sm {{ $isOverdue ? 'text-error dark:text-error-dark' : 'text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark' }}">
                <span
                    class="material-symbols-outlined text-[14px]">{{ $isOverdue ? 'warning' : 'calendar_today' }}</span>
                {{ $task->due_date ? $task->due_date->format('M d') : 'No date' }}
            </span>
            @if ($task->category)
                <span
                    class="px-2 py-0.5 bg-surface dark:bg-surface-dark-container-high text-primary dark:text-primary-dark rounded text-[10px] font-bold uppercase tracking-tighter">
                    {{ $task->category }}
                </span>
            @endif
        </div>
    </div>
    <span class="px-2 py-1 {{ $priorityClass }} rounded-lg text-label-sm font-label-sm capitalize flex-shrink-0">
        {{ $task->priority ?? 'low' }}
    </span>
    <div class="relative flex-shrink-0">
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
            @can('update', $task)
            <a href="{{ $editRoute }}"
                class="flex items-center gap-3 px-4 py-2.5 text-on-surface dark:text-on-surface-dark hover:bg-surface dark:bg-surface-dark-container
                      transition-colors font-label-md text-label-md">
                <span class="material-symbols-outlined text-[18px] text-secondary dark:text-secondary-dark">edit</span>
                Edit Task
            </a>
            @endcan
            @can('delete', $task)
            <div class="border-t border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark my-1"></div>
            <button
                @click="
                        open = false;
                        if(confirm('Delete this task?')) {
                            ajax.delete('{{ $deleteRoute }}')
                                .then(res => {
                                    if(res.status === 'success') {
                                        $el.closest('.flex.items-center').remove();
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
