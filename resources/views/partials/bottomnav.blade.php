@php
    $currentRoute = Route::currentRouteName();
@endphp

<!-- Footer / Mobile Bottom Nav -->
<nav
    class="md:hidden fixed bottom-0 left-0 right-0 bg-surface border-t border-outline-variant px-6 py-3 flex justify-between items-center z-50">
    <a class="flex flex-col items-center gap-1 {{ $currentRoute === 'dashboard' ? 'text-primary' : 'text-on-surface-variant' }}"
        href="{{ route('dashboard') }}">
        <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
        <span class="text-label-sm">Dashboard</span>
    </a>
    <a class="flex flex-col items-center gap-1 {{ str_contains($currentRoute, 'projects.') ? 'text-primary' : 'text-on-surface-variant' }}"
        href="{{ route('projects.overview') }}">
        <span class="material-symbols-outlined" data-icon="workspaces">workspaces</span>
        <span class="text-label-sm font-bold">Tasks</span>
    </a>
    <a href="{{ route('projects.create') }}"
        class="bg-primary text-on-primary p-3 rounded-full -mt-10 shadow-lg active:scale-95 transition-transform">
        <span class="material-symbols-outlined" data-icon="add">add</span>
    </a>
    <a class="flex flex-col items-center gap-1 {{ $currentRoute === 'calendar.index' ? 'text-primary' : 'text-on-surface-variant' }}"
        href="{{ route('calendar.index') }}">
        <span class="material-symbols-outlined" data-icon="calendar_month">calendar_month</span>
        <span class="text-label-sm">Calendar</span>
    </a>
    <a class="flex flex-col items-center gap-1 {{ $currentRoute === 'profile.show' ? 'text-primary' : 'text-on-surface-variant' }}"
        href="{{ route('profile.show') }}">
        <span class="material-symbols-outlined" data-icon="person">person</span>
        <span class="text-label-sm">Profile</span>
    </a>
</nav>
