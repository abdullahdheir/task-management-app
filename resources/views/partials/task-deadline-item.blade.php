@php
    $priorityClasses = [
        'high' => 'bg-error-container text-on-error-container',
        'medium' => 'bg-tertiary-fixed text-on-tertiary-fixed',
        'low' => 'bg-secondary-container text-on-secondary-fixed-variant',
    ];
    $priorityClass = $priorityClasses[$task->priority ?? 'low'] ?? $priorityClasses['low'];
    $isOverdue = $task->due_date && $task->due_date->isPast() && !$task->completed;
@endphp

<div class="flex items-center gap-4 p-3 rounded-lg border border-outline-variant hover:bg-surface-container-low transition-colors group cursor-pointer">
    <div class="flex-shrink-0">
        <input type="checkbox" id="task-{{ $task->id }}" {{ $task->completed ? 'checked' : '' }}
            class="w-5 h-5 rounded-full border-2 border-outline-variant text-secondary focus:ring-secondary cursor-pointer">
    </div>
    <div class="flex-grow min-w-0">
        <label for="task-{{ $task->id }}"
            class="font-body-md text-body-md text-on-surface block cursor-pointer transition-colors {{ $task->completed ? 'line-through text-outline' : '' }} truncate">
            {{ $task->title }}
        </label>
        <div class="flex items-center gap-2 mt-1">
            <span class="flex items-center gap-1 text-label-sm font-label-sm {{ $isOverdue ? 'text-error' : 'text-on-surface-variant' }}">
                <span class="material-symbols-outlined text-[14px]">{{ $isOverdue ? 'warning' : 'calendar_today' }}</span>
                {{ $task->due_date ? $task->due_date->format('M d') : 'No date' }}
            </span>
            @if($task->category)
                <span
                    class="px-2 py-0.5 bg-surface-container-high text-primary rounded text-[10px] font-bold uppercase tracking-tighter">
                    {{ $task->category }}
                </span>
            @endif
        </div>
    </div>
    <span class="px-2 py-1 {{ $priorityClass }} rounded-lg text-label-sm font-label-sm capitalize flex-shrink-0">
        {{ $task->priority ?? 'low' }}
    </span>
    <button
        class="material-symbols-outlined text-on-surface-variant {{ $task->completed ? '' : 'opacity-0 group-hover:opacity-100' }} transition-opacity flex-shrink-0">
        more_vert
    </button>
</div>
