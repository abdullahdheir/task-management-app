@php
    $currentRoute = Route::currentRouteName();
@endphp

<aside
    class="hidden md:flex h-screen w-64 fixed left-0 top-0 bg-surface-container-low shadow-sm flex-col py-stack-lg px-stack-md z-50">
    {{-- Brand --}}
    <div class="mb-stack-lg px-2">
        <h1 class="text-headline-md font-headline-md font-black text-primary">{{ ucfirst(config('app.name')) }}</h1>
        <p class="text-label-sm font-label-sm text-on-surface-variant">Productivity Workspace</p>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 space-y-2">
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                {{ $currentRoute === 'dashboard' ? 'text-primary font-bold bg-surface-container-highest' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="font-label-md text-label-md">Dashboard</span>
        </a>

        <a href="{{ route('projects.overview') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                {{ str_contains($currentRoute, 'projects.') ? 'text-primary font-bold bg-surface-container-highest' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
            <span class="material-symbols-outlined">workspaces</span>
            <span class="font-label-md text-label-md">Projects</span>
        </a>

        <a href="{{ route('teams.overview') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                {{ str_contains($currentRoute, 'teams.') ? 'text-primary font-bold bg-surface-container-highest' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
            <span class="material-symbols-outlined">groups</span>
            <span class="font-label-md text-label-md">Teams</span>
        </a>

        <a href="{{ route('tasks.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                {{ str_contains($currentRoute, 'tasks.') ? 'text-primary font-bold bg-surface-container-highest' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
            <span class="material-symbols-outlined">format_list_bulleted</span>
            <span class="font-label-md text-label-md">Tasks</span>
        </a>

        <a href="{{ route('calendar.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                {{ $currentRoute === 'calendar.index' ? 'text-primary font-bold bg-surface-container-highest' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
            <span class="material-symbols-outlined">calendar_month</span>
            <span class="font-label-md text-label-md">Calendar</span>
        </a>

        <a href="{{ route('profile.show') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                {{ $currentRoute === 'profile.show' ? 'text-primary font-bold bg-surface-container-highest' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
            <span class="material-symbols-outlined">person</span>
            <span class="font-label-md text-label-md">Profile</span>
        </a>
    </nav>

    {{-- Create Project Button --}}
    <a href="{{ route('projects.create') }}"
        class="mx-2 bg-primary text-on-primary font-bold py-3 rounded-lg flex items-center justify-center gap-2 active:scale-95 transition-transform">
        <span class="material-symbols-outlined text-[20px]">add</span>
        <span class="font-label-md text-label-md">Create Project</span>
    </a>

    {{-- Bottom Links --}}
    <div class="mt-4 space-y-2 border-t border-outline-variant pt-stack-lg">
        <a href="{{ route('settings.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ $currentRoute === 'settings.index' ? 'text-primary font-bold bg-surface-container-highest' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
            <span class="material-symbols-outlined">settings</span>
            <span class="font-label-md text-label-md">Settings</span>
        </a>
        <a href="{{ route('help.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ $currentRoute === 'help.index' ? 'text-primary font-bold bg-surface-container-highest' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }}">
            <span class="material-symbols-outlined">help</span>
            <span class="font-label-md text-label-md">Help</span>
        </a>
    </div>
</aside>
