@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')

    <div class="w-full max-w-[700px] mx-auto">

        {{-- Header --}}
        <div class="mb-stack-lg text-center">
            <h2 class="font-headline-lg text-headline-lg text-on-surface dark:text-on-surface-dark">Edit Task</h2>
            <p class="font-body-md text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mt-2">
                Update the details of your task.
            </p>
        </div>

        {{-- Form Card --}}
        <div class="bg-surface dark:bg-surface-dark-container-lowest border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-xl p-stack-lg form-card">
            <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-stack-lg">
                @csrf
                @method('PUT')

                {{-- Task Title --}}
                <div>
                    <label for="title"
                        class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark block mb-stack-sm uppercase tracking-wider">
                        Task Title
                    </label>
                    <input id="title" name="title" type="text" value="{{ old('title', $task->title) }}"
                        placeholder="What needs to be done?"
                        class="w-full bg-transparent border-b-2 border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark-container py-3 font-headline-md text-headline-md outline-none transition-all placeholder:text-outline dark:text-outline-dark @error('title') border-error dark:border-error-dark @enderror"
                        required>
                    @error('title')
                        <p class="text-label-sm text-error dark:text-error-dark mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark block mb-stack-sm">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="3" placeholder="Add some details or notes..."
                        class="w-full rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark-container focus:ring-1 focus:ring-primary dark:focus:ring-primary-dark-container p-3 font-body-md text-body-md bg-white dark:bg-surface-container-low-dark transition-all outline-none resize-none">{{ old('description', $task->description) }}</textarea>
                </div>

                {{-- Date & Time --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-lg">
                    <div>
                        <label for="due_date" class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark block mb-stack-sm">
                            Due Date
                        </label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline dark:text-outline-dark group-focus-within:text-primary dark:text-primary-dark-container">event</span>
                            <input id="due_date" name="due_date" type="date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark-container focus:ring-1 focus:ring-primary dark:focus:ring-primary-dark-container font-body-md text-body-md bg-white dark:bg-surface-container-low-dark outline-none transition-all">
                        </div>
                    </div>
                    <div>
                        <label for="due_time" class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark block mb-stack-sm">
                            Time
                        </label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline dark:text-outline-dark group-focus-within:text-primary dark:text-primary-dark-container">schedule</span>
                            <input id="due_time" name="due_time" type="time" value="{{ old('due_time', $task->due_time ? \Carbon\Carbon::parse($task->due_time)->format('H:i') : '') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark-container focus:ring-1 focus:ring-primary dark:focus:ring-primary-dark-container font-body-md text-body-md bg-white dark:bg-surface-container-low-dark outline-none transition-all">
                        </div>
                    </div>
                </div>

                {{-- Priority & Category --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-lg">

                    {{-- Priority --}}
                    <div>
                        <label
                            class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark block mb-stack-sm">Priority</label>
                        <input type="hidden" name="priority" id="priority-input" value="{{ old('priority', $task->priority ?? 'low') }}">
                        <div class="flex p-1 bg-surface dark:bg-surface-dark-container rounded-lg gap-1">
                            @foreach (['low' => 'text-secondary dark:text-secondary-dark', 'medium' => 'text-tertiary dark:text-tertiary-dark', 'high' => 'text-error dark:text-error-dark'] as $level => $color)
                                <button type="button" id="btn-{{ $level }}"
                                    onclick="setPriority('{{ $level }}')"
                                    class="priority-btn flex-1 py-1.5 rounded-md text-label-md font-label-md transition-all
                                    {{ old('priority', $task->priority ?? 'low') === $level ? 'bg-white dark:bg-surface-container-low-dark shadow-sm font-bold ' . $color : 'text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark hover:bg-surface dark:bg-surface-dark-container-high' }}">
                                    {{ ucfirst($level) }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Category --}}
                    <div>
                        <label for="category" class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark block mb-stack-sm">
                            Category
                        </label>
                        <select id="category" name="category"
                            class="w-full px-4 py-2.5 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark-container focus:ring-1 focus:ring-primary dark:focus:ring-primary-dark-container font-body-md text-body-md bg-white dark:bg-surface-container-low-dark outline-none transition-all appearance-none cursor-pointer">
                            <option value="work" {{ old('category', $task->category) === 'work' ? 'selected' : '' }}>💼 Work</option>
                            <option value="personal" {{ old('category', $task->category) === 'personal' ? 'selected' : '' }}>🏠 Personal</option>
                            <option value="health" {{ old('category', $task->category) === 'health' ? 'selected' : '' }}>🧘 Health</option>
                            <option value="finance" {{ old('category', $task->category) === 'finance' ? 'selected' : '' }}>💳 Finance</option>
                            <option value="other" {{ old('category', $task->category) === 'other' ? 'selected' : '' }}>✨ Other</option>
                        </select>
                    </div>
                </div>

                {{-- Project selection --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-lg">
                    <div>
                        <label for="project_id" class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark block mb-stack-sm">
                            Project
                        </label>
                        <select id="project_id" name="project_id"
                            class="w-full px-4 py-2.5 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark-container focus:ring-1 focus:ring-primary dark:focus:ring-primary-dark-container font-body-md text-body-md bg-white dark:bg-surface-container-low-dark outline-none transition-all appearance-none cursor-pointer">
                            <option value="">None (Personal Task)</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>📁 {{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="pt-stack-md flex flex-col sm:flex-row items-center justify-end gap-stack-md">
                    <a href="{{ route('tasks.show', $task) }}"
                        class="w-full sm:w-auto px-6 py-2.5 font-label-md text-label-md text-primary dark:text-primary-dark-container hover:bg-surface dark:bg-surface-dark-container transition-colors rounded-lg text-center">
                        Cancel
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-primary dark:bg-primary-dark-container dark:bg-primary dark:bg-primary-dark-container-dark text-on-primary dark:text-on-primary-dark-container dark:text-on-primary dark:text-on-primary-dark-container-dark hover:bg-primary dark:bg-primary-dark transition-all rounded-lg font-headline-md text-headline-md active:scale-95 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">save</span>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const priorityColors = {
            low: 'text-secondary dark:text-secondary-dark',
            medium: 'text-tertiary dark:text-tertiary-dark',
            high: 'text-error dark:text-error-dark',
        };

        function setPriority(level) {
            document.getElementById('priority-input').value = level;

            document.querySelectorAll('.priority-btn').forEach(btn => {
                btn.classList.remove('bg-white dark:bg-surface-container-low-dark', 'shadow-sm', 'font-bold', ...Object.values(priorityColors));
                btn.classList.add('text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark', 'hover:bg-surface dark:bg-surface-dark-container-high');
            });

            const active = document.getElementById('btn-' + level);
            active.classList.remove('text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark', 'hover:bg-surface dark:bg-surface-dark-container-high');
            active.classList.add('bg-white dark:bg-surface-container-low-dark', 'shadow-sm', 'font-bold', priorityColors[level]);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const card = document.querySelector('.form-card');
            card.style.opacity = '0';
            card.style.transform = 'translateY(10px)';
            card.style.transition = 'all 0.4s ease-out';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
@endpush
