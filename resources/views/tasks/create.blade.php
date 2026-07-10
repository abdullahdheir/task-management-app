@extends('layouts.app')

@section('title', 'Create Task')

@section('content')

    <div class="w-full max-w-[700px] mx-auto">

        {{-- Header --}}
        <div class="mb-stack-lg text-center">
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Create New Task</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2">
                Break your goals down into manageable steps.
            </p>
        </div>

        {{-- Form Card --}}
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg form-card">
            <form action="{{ route('tasks.store') }}" method="POST" class="space-y-stack-lg">
                @csrf

                {{-- Task Title --}}
                <div>
                    <label for="title"
                        class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm uppercase tracking-wider">
                        Task Title
                    </label>
                    <input id="title" name="title" type="text" value="{{ old('title') }}"
                        placeholder="What needs to be done?"
                        class="w-full bg-transparent border-b-2 border-outline-variant focus:border-primary-container py-3 font-headline-md text-headline-md outline-none transition-all placeholder:text-outline @error('title') border-error @enderror"
                        required>
                    @error('title')
                        <p class="text-label-sm text-error mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="3" placeholder="Add some details or notes..."
                        class="w-full rounded-lg border border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container p-3 font-body-md text-body-md bg-white transition-all outline-none resize-none">{{ old('description') }}</textarea>
                </div>

                {{-- Date & Time --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-lg">
                    <div>
                        <label for="due_date" class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm">
                            Due Date
                        </label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary-container">event</span>
                            <input id="due_date" name="due_date" type="date" value="{{ old('due_date') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container font-body-md text-body-md bg-white outline-none transition-all">
                        </div>
                    </div>
                    <div>
                        <label for="due_time" class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm">
                            Time
                        </label>
                        <div class="relative group">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary-container">schedule</span>
                            <input id="due_time" name="due_time" type="time" value="{{ old('due_time') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container font-body-md text-body-md bg-white outline-none transition-all">
                        </div>
                    </div>
                </div>

                {{-- Priority & Category --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-lg">

                    {{-- Priority --}}
                    <div>
                        <label
                            class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm">Priority</label>
                        <input type="hidden" name="priority" id="priority-input" value="{{ old('priority', 'low') }}">
                        <div class="flex p-1 bg-surface-container rounded-lg gap-1">
                            @foreach (['low' => 'text-secondary', 'medium' => 'text-tertiary', 'high' => 'text-error'] as $level => $color)
                                <button type="button" id="btn-{{ $level }}"
                                    onclick="setPriority('{{ $level }}')"
                                    class="priority-btn flex-1 py-1.5 rounded-md text-label-md font-label-md transition-all
                                    {{ old('priority', 'low') === $level ? 'bg-white shadow-sm font-bold ' . $color : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                                    {{ ucfirst($level) }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Category --}}
                    <div>
                        <label for="category" class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm">
                            Category
                        </label>
                        <select id="category" name="category"
                            class="w-full px-4 py-2.5 rounded-lg border border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container font-body-md text-body-md bg-white outline-none transition-all appearance-none cursor-pointer">
                            <option value="work" {{ old('category') === 'work' ? 'selected' : '' }}>💼 Work</option>
                            <option value="personal" {{ old('category') === 'personal' ? 'selected' : '' }}>🏠 Personal
                            </option>
                            <option value="health" {{ old('category') === 'health' ? 'selected' : '' }}>🧘 Health</option>
                            <option value="finance" {{ old('category') === 'finance' ? 'selected' : '' }}>💳 Finance
                            </option>
                            <option value="other" {{ old('category') === 'other' ? 'selected' : '' }}>✨ Other</option>
                        </select>
                    </div>
                </div>

                {{-- Project selection --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-lg">
                    <div>
                        <label for="project_id" class="font-label-md text-label-md text-on-surface-variant block mb-stack-sm">
                            Project
                        </label>
                        <select id="project_id" name="project_id"
                            class="w-full px-4 py-2.5 rounded-lg border border-outline-variant focus:border-primary-container focus:ring-1 focus:ring-primary-container font-body-md text-body-md bg-white outline-none transition-all appearance-none cursor-pointer">
                            <option value="">None (Personal Task)</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>📁 {{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="pt-stack-md flex flex-col sm:flex-row items-center justify-end gap-stack-md">
                    <a href="{{ route('tasks.index') }}"
                        class="w-full sm:w-auto px-6 py-2.5 font-label-md text-label-md text-primary-container hover:bg-surface-container transition-colors rounded-lg text-center">
                        Cancel
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-primary-container text-on-primary-container hover:bg-primary transition-all rounded-lg font-headline-md text-headline-md active:scale-95 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">add_task</span>
                        Create Task
                    </button>
                </div>
            </form>
        </div>

        {{-- Pro tip --}}
        <div class="mt-stack-lg flex items-center justify-center gap-2 text-on-surface-variant">
            <span class="material-symbols-outlined text-[20px]">lightbulb</span>
            <span class="text-label-sm font-label-sm italic">
                Pro-tip: Tasks with due times send notifications 15 minutes before.
            </span>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const priorityColors = {
            low: 'text-secondary',
            medium: 'text-tertiary',
            high: 'text-error',
        };

        function setPriority(level) {
            document.getElementById('priority-input').value = level;

            document.querySelectorAll('.priority-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'shadow-sm', 'font-bold', ...Object.values(priorityColors));
                btn.classList.add('text-on-surface-variant', 'hover:bg-surface-container-high');
            });

            const active = document.getElementById('btn-' + level);
            active.classList.remove('text-on-surface-variant', 'hover:bg-surface-container-high');
            active.classList.add('bg-white', 'shadow-sm', 'font-bold', priorityColors[level]);
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
