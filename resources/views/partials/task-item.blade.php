@php
    $priorityClasses = [
        'high' => 'bg-error-container text-on-error-container',
        'medium' => 'bg-surface-variant text-on-secondary-fixed-variant',
        'low' => 'bg-secondary-container text-on-secondary-fixed-variant',
    ];
    $dueIcon = $task['completed'] ?? false ? 'check_circle' : 'calendar_today';
    $priorityClass = $priorityClasses[$task['priority'] ?? 'low'] ?? $priorityClasses['low'];
@endphp

<div
    class="task-row bg-surface-container-lowest border border-outline-variant rounded-xl p-4 flex items-center gap-4 hover:shadow-sm transition-all group {{ $task['completed'] ?? false ? 'opacity-60' : '' }}">
    <input type="checkbox" id="task-{{ $task['id'] }}" {{ $task['completed'] ?? false ? 'checked' : '' }}
        class="task-checkbox w-5 h-5 rounded-full border-2 border-outline-variant text-secondary focus:ring-secondary cursor-pointer">

    <div class="flex-grow">
        <label for="task-{{ $task['id'] }}"
            class="font-body-lg text-body-lg text-on-surface block cursor-pointer transition-colors {{ $task['completed'] ?? false ? 'line-through text-outline' : '' }}">
            {{ $task['title'] }}
        </label>
        <div class="flex items-center gap-4 mt-1">
            <span class="flex items-center gap-1 text-label-sm font-label-sm text-on-surface-variant">
                <span class="material-symbols-outlined text-[14px]">{{ $dueIcon }}</span>
                {{ $task['due'] }}
            </span>
            <span
                class="px-2 py-0.5 bg-surface-container-high text-primary rounded text-[10px] font-bold uppercase tracking-tighter">
                {{ $task['category'] }}
            </span>
        </div>
    </div>

    <span class="px-2 py-1 {{ $priorityClass }} rounded-lg text-label-sm font-label-sm capitalize">
        {{ $task['priority'] ?? 'low' }}
    </span>

    <button
        class="material-symbols-outlined text-on-surface-variant {{ $task['completed'] ?? false ? '' : 'opacity-0 group-hover:opacity-100' }} transition-opacity">
        more_vert
    </button>
</div>
