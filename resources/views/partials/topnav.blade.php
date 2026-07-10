<header
    class="w-full h-16 bg-surface border-b border-outline-variant flex justify-between items-center px-gutter-desktop max-w-container-max mx-auto sticky top-0 z-40">
    {{-- Search --}}
    <div class="flex items-center gap-stack-lg">
        <div class="relative w-64">
            <span
                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            <form action="{{ route('search.index') }}" class="flex items-center flex-1 max-w-xl relative" method="GET">
                <span
                    class="material-symbols-outlined absolute left-4 text-on-surface-variant text-body-lg">search</span>
                <input
                    class="w-full pl-12 pr-4 py-2 bg-surface-container-lowest border rounded-full text-body-md focus:ring-2 focus:ring-primary/20 transition-all"
                    placeholder="Search tasks, projects, or team..." value="{{ request('q') }}" type="text"
                    name="q" />
            </form>
        </div>
    </div>

    {{-- Right Side --}}
    <div class="flex items-center gap-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('projects.create') }}"
                class="hidden lg:flex bg-primary text-on-primary px-6 py-2 rounded-full font-label-md text-label-md hover:bg-primary-container transition-colors active:scale-95">
                Create Project
            </a>

            {{-- Notifications --}}
            <button
                class="material-symbols-outlined text-on-surface-variant hover:bg-surface-container-low p-2 rounded-full transition-colors">
                notifications
            </button>

            {{-- Profile --}}
            @auth
                <a href="{{ route('profile.show') }}" class="flex items-center gap-2 cursor-pointer group">
                    <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                        alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full border border-outline-variant">
                </a>
            @endauth
        </div>
    </div>
</header>
