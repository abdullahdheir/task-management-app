<header
    class="w-full h-16 bg-surface dark:bg-surface-dark border-b border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark flex justify-between items-center px-gutter-desktop max-w-container-max mx-auto sticky top-0 z-40">
    {{-- Search --}}
    <div class="flex items-center gap-stack-lg">
        <div class="relative w-64">
            <span
                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">search</span>
            <form action="{{ route('search.index') }}" class="flex items-center flex-1 max-w-xl relative" method="GET">
                <span
                    class="material-symbols-outlined absolute left-4 text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-body-lg">search</span>
                <input
                    class="w-full pl-12 pr-4 py-2 bg-surface dark:bg-surface-dark-container-lowest border rounded-full text-body-md focus:ring-2 focus:ring-primary dark:focus:ring-primary-dark/20 transition-all"
                    placeholder="Search tasks, projects, or team..." value="{{ request('q') }}" type="text"
                    name="q" />
            </form>
        </div>
    </div>

    {{-- Right Side --}}
    <div class="flex items-center gap-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('projects.create') }}"
                class="hidden lg:flex bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark px-6 py-2 rounded-full font-label-md text-label-md hover:bg-primary dark:bg-primary-dark-container dark:bg-primary dark:bg-primary-dark-container-dark transition-colors active:scale-95">
                Create Project
            </a>

            {{-- Notifications --}}
            <button
                class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark hover:bg-surface dark:bg-surface-dark-container-low p-2 rounded-full transition-colors">
                notifications
            </button>

            {{-- Profile --}}
            @auth
                <a href="{{ route('profile.show') }}" class="flex items-center gap-2 cursor-pointer group">
                    <img src="{{ auth()->user()->avatar_url?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                        alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
                </a>
            @endauth
        </div>
    </div>
</header>
