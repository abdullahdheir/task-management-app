@php
    $currentRoute = Route::currentRouteName();
@endphp

<!-- Footer / Mobile Bottom Nav -->
<nav
    class="md:hidden fixed bottom-0 left-0 right-0 bg-surface dark:bg-surface-dark border-t border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark px-6 py-3 flex justify-between items-center z-50">
    <a class="flex flex-col items-center gap-1 {{ $currentRoute === 'dashboard' ? 'text-primary dark:text-primary-dark' : 'text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark' }}"
        href="{{ route('dashboard') }}">
        <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
        <span class="text-label-sm">Dashboard</span>
    </a>
    <a class="flex flex-col items-center gap-1 {{ str_contains($currentRoute, 'projects.') ? 'text-primary dark:text-primary-dark' : 'text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark' }}"
        href="{{ route('projects.overview') }}">
        <span class="material-symbols-outlined" data-icon="workspaces">workspaces</span>
        <span class="text-label-sm font-bold">Tasks</span>
    </a>
    <a href="{{ route('projects.create') }}"
        class="bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark p-3 rounded-full -mt-10 shadow-lg active:scale-95 transition-transform">
        <span class="material-symbols-outlined" data-icon="add">add</span>
    </a>
    <a class="flex flex-col items-center gap-1 {{ $currentRoute === 'calendar.index' ? 'text-primary dark:text-primary-dark' : 'text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark' }}"
        href="{{ route('calendar.index') }}">
        <span class="material-symbols-outlined" data-icon="calendar_month">calendar_month</span>
        <span class="text-label-sm">Calendar</span>
    </a>
    <a class="flex flex-col items-center gap-1 {{ $currentRoute === 'profile.show' ? 'text-primary dark:text-primary-dark' : 'text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark' }}"
        href="{{ route('profile.show') }}">
        <span class="material-symbols-outlined" data-icon="person">person</span>
        <span class="text-label-sm">Profile</span>
    </a>
</nav>
