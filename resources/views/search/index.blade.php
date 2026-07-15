@extends('layouts.app')

@section('title', 'Search Results')

@push('styles')
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .search-focus:focus-within {
            box-shadow: 0 0 0 2px theme('colors.primary');
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: theme('colors.outline-variant');
            border-radius: 10px;
        }
    </style>
@endpush

@section('content')
    <!-- Contextual Search Header -->
    <div class="mb-stack-lg">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-stack-md mb-8">
            <div>
                <h1 class="font-headline-lg text-headline-lg text-on-surface dark:text-on-surface-dark">Search Results</h1>
                <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-body-md mt-1">Found 42 matches for <span
                        class="text-primary dark:text-primary-dark font-semibold">"Quarterly Report"</span></p>
            </div>
            <div class="flex gap-stack-sm">
                <button
                    class="flex items-center gap-2 px-stack-md py-stack-sm border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg font-label-md text-on-surface dark:text-on-surface-dark hover:bg-surface dark:bg-surface-dark-container-low transition-colors">
                    <span class="material-symbols-outlined text-[18px]">filter_list</span>
                    Filters
                </button>
                <button
                    class="flex items-center gap-2 px-stack-md py-stack-sm border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg font-label-md text-on-surface dark:text-on-surface-dark hover:bg-surface dark:bg-surface-dark-container-low transition-colors">
                    <span class="material-symbols-outlined text-[18px]">sort</span>
                    Sort
                </button>
            </div>
        </div>
        <!-- Content Area Search Bar -->
        <div class="relative w-full max-w-3xl search-focus transition-all duration-200 rounded-xl">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline dark:text-outline-dark">search</span>
            <input
                class="w-full pl-12 pr-4 py-4 bg-surface dark:bg-surface-dark-container-lowest border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-xl focus:outline-none focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark font-body-lg text-on-surface dark:text-on-surface-dark shadow-sm transition-all"
                placeholder="Search tasks, projects, or people..." type="text" value="Quarterly Report" />
            <span
                class="absolute right-4 top-1/2 -translate-y-1/2 text-outline dark:text-outline-dark-variant dark:text-outline dark:text-outline-dark-variant-dark font-label-sm border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark px-2 py-0.5 rounded hidden md:block">CMD
                + K</span>
        </div>
    </div>
    <!-- Bento Grid Search Layout -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter-desktop">
        <!-- Tasks Section (Largest Presence) -->
        <section class="md:col-span-8 flex flex-col gap-stack-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-stack-md">
                    <span class="material-symbols-outlined text-primary dark:text-primary-dark bg-primary dark:bg-primary-dark-fixed dark:bg-primary dark:bg-primary-dark-fixed-dark p-2 rounded-lg">check_circle</span>
                    <h2 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark">Tasks</h2>
                </div>
                <a class="text-primary dark:text-primary-dark font-label-md hover:underline" href="#">View All Tasks</a>
            </div>
            <div class="grid grid-cols-1 gap-stack-md">
                <!-- Task Item 1 -->
                <div
                    class="group min-h-[64px] bg-surface dark:bg-surface-dark-container-lowest p-stack-lg rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark hover:shadow-md transition-all duration-200 flex items-center justify-between">
                    <div class="flex items-center gap-stack-lg">
                        <div
                            class="w-5 h-5 rounded-full border-2 border-outline dark:border-outline-dark group-hover:border-primary dark:border-primary-dark cursor-pointer transition-colors">
                        </div>
                        <div>
                            <h3 class="font-body-lg text-on-surface dark:text-on-surface-dark group-hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark transition-colors">Review
                                Quarterly Budget Report</h3>
                            <div class="flex items-center gap-stack-md mt-1">
                                <span class="flex items-center gap-1 text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm">
                                    <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                    Due Oct 24
                                </span>
                                <span
                                    class="bg-secondary dark:bg-secondary-dark-container dark:bg-secondary dark:bg-secondary-dark-container-dark text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant dark:text-on-secondary dark:text-on-secondary-dark-fixed dark:text-on-secondary dark:text-on-secondary-dark-fixed-dark-variant-dark px-2 py-0.5 rounded-full font-label-sm">In
                                    Progress</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full border-2 border-surface bg-slate-200 overflow-hidden">
                            <img class="w-full h-full object-cover"
                                data-alt="A professional headshot of a diverse team member with a friendly smile, clean corporate studio lighting, soft neutral background, high-end photography style for a modern productivity app interface."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCSuYmdhPdPYdSprc-3wXZppWCeFL5sCUxemVQlhNbyXLgNIqw1c_YzRtNL3TbBLd3gU5nCGkHiI6FJdd0eMmpffIJjk3bTJobddFXIke17b5zaatQsJG9W61IMKnz2jJcUDho-2QSnS6GxiPgKpOns6_rRSmbAT5WWP4XwFaVgzpXmKn4AQKRmRyR8BO4GwNuYFx2UHVxieDebezeYT7FEEvunwDaM70ygw2tTD2axHccX2Y4L__HGaA" />
                        </div>
                    </div>
                </div>
                <!-- Task Item 2 -->
                <div
                    class="group min-h-[64px] bg-surface dark:bg-surface-dark-container-lowest p-stack-lg rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark hover:shadow-md transition-all duration-200 flex items-center justify-between">
                    <div class="flex items-center gap-stack-lg">
                        <div
                            class="w-5 h-5 rounded-full border-2 border-outline dark:border-outline-dark group-hover:border-primary dark:border-primary-dark cursor-pointer transition-colors">
                        </div>
                        <div>
                            <h3 class="font-body-lg text-on-surface dark:text-on-surface-dark group-hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark transition-colors">Prepare Data
                                Visualization for Quarterly Presentation</h3>
                            <div class="flex items-center gap-stack-md mt-1">
                                <span class="flex items-center gap-1 text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm">
                                    <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                    Due Tomorrow
                                </span>
                                <span
                                    class="bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark text-on-error dark:text-on-error-dark-container dark:text-on-error dark:text-on-error-dark-container-dark px-2 py-0.5 rounded-full font-label-sm">Priority</span>
                            </div>
                        </div>
                    </div>
                    <button class="material-symbols-outlined text-outline dark:text-outline-dark-variant dark:text-outline dark:text-outline-dark-variant-dark hover:text-on-surface dark:hover:text-on-surface-dark dark:text-on-surface-dark">more_vert</button>
                </div>
                <!-- Task Item 3 -->
                <div
                    class="group min-h-[64px] bg-surface dark:bg-surface-dark-container-lowest p-stack-lg rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark hover:shadow-md transition-all duration-200 flex items-center justify-between opacity-70">
                    <div class="flex items-center gap-stack-lg">
                        <div
                            class="w-5 h-5 rounded-full bg-secondary dark:bg-secondary-dark flex items-center justify-center text-white cursor-pointer">
                            <span class="material-symbols-outlined text-[14px]"
                                style="font-variation-settings: 'wght' 700;">check</span>
                        </div>
                        <div>
                            <h3 class="font-body-lg text-on-surface dark:text-on-surface-dark line-through">Compile Sales Data for Report</h3>
                            <div class="flex items-center gap-stack-md mt-1">
                                <span class="font-label-sm text-on-secondary dark:text-on-secondary-dark-container dark:text-on-secondary dark:text-on-secondary-dark-container-dark">Completed Yesterday</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sidebar Content: Projects & People -->
        <aside class="md:col-span-4 flex flex-col gap-10">
            <!-- Projects Section -->
            <section class="flex flex-col gap-stack-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-stack-md">
                        <span
                            class="material-symbols-outlined text-tertiary dark:text-tertiary-dark bg-tertiary dark:bg-tertiary-dark-fixed dark:bg-tertiary dark:bg-tertiary-dark-fixed-dark p-2 rounded-lg">folder_open</span>
                        <h2 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark">Projects</h2>
                    </div>
                </div>
                <div class="flex flex-col gap-stack-md">
                    <!-- Project Card -->
                    <div
                        class="bg-surface dark:bg-surface-dark-container-lowest border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-xl p-stack-lg hover:border-primary dark:border-primary-dark transition-colors cursor-pointer group">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h4 class="font-body-lg font-semibold text-on-surface dark:text-on-surface-dark group-hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark">Q4 Market
                                    Analysis</h4>
                                <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm">Strategic Planning</p>
                            </div>
                            <div
                                class="w-10 h-10 rounded-lg bg-primary dark:bg-primary-dark-fixed dark:bg-primary dark:bg-primary-dark-fixed-dark-dim flex items-center justify-center text-primary dark:text-primary-dark">
                                <span class="material-symbols-outlined">analytics</span>
                            </div>
                        </div>
                        <div class="w-full bg-surface dark:bg-surface-dark-container rounded-full h-1.5 mb-2">
                            <div class="bg-secondary dark:bg-secondary-dark h-1.5 rounded-full" style="width: 65%;"></div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm">65% complete</span>
                            <span class="text-on-surface dark:text-on-surface-dark font-label-sm">12 Tasks left</span>
                        </div>
                    </div>
                    <!-- Project Card 2 -->
                    <div
                        class="bg-surface dark:bg-surface-dark-container-lowest border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-xl p-stack-lg hover:border-primary dark:border-primary-dark transition-colors cursor-pointer group">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h4 class="font-body-lg font-semibold text-on-surface dark:text-on-surface-dark group-hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark">Internal
                                    Audit Report</h4>
                                <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm">Compliance</p>
                            </div>
                            <div
                                class="w-10 h-10 rounded-lg bg-surface dark:bg-surface-dark-container flex items-center justify-center text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">
                                <span class="material-symbols-outlined">security</span>
                            </div>
                        </div>
                        <div class="w-full bg-surface dark:bg-surface-dark-container rounded-full h-1.5 mb-2">
                            <div class="bg-secondary dark:bg-secondary-dark h-1.5 rounded-full" style="width: 20%;"></div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm">20% complete</span>
                            <span class="text-on-surface dark:text-on-surface-dark font-label-sm">4 Tasks left</span>
                        </div>
                    </div>
                </div>
            </section>
            <!-- People Section -->
            <section class="flex flex-col gap-stack-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-stack-md">
                        <span
                            class="material-symbols-outlined text-secondary dark:text-secondary-dark bg-secondary dark:bg-secondary-dark-fixed dark:bg-secondary dark:bg-secondary-dark-fixed-dark p-2 rounded-lg">group</span>
                        <h2 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark">People</h2>
                    </div>
                </div>
                <div
                    class="bg-surface dark:bg-surface-dark-container-lowest border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-xl overflow-hidden divide-y divide-outline-variant dark:divide-outline-variant-dark">
                    <!-- Person Item 1 -->
                    <div
                        class="p-stack-md flex items-center gap-stack-md hover:bg-surface dark:bg-surface-dark-container-low transition-colors cursor-pointer group">
                        <div
                            class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden ring-2 ring-transparent group-hover:ring-primary transition-all">
                            <img class="w-full h-full object-cover"
                                data-alt="A portrait of a male executive in his 40s, high-key lighting, corporate minimalist aesthetic, wearing a navy sweater, sharp focus, professional photography style for a sleek productivity app user profile."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGspvlhNQCC-pekBQNan2wD_JIiUCwr2wsuG95WknbU8JMFTIFlgBH9XMaMgcAVXytvlOA_NEs9Bxy36bzo_UoW2D16tYlVx6Uz2Af_3Rm-Mj_z5xSaJ2Oxn7MAJAPta8kOPymQIhCIr9poZhqVWU1priKvs98kc0kjCdC0aFVec47TM19F0XL8oWi86Dc8k4N7Bacbm7MvNjqMFjwrNDT6peoJGGU8dEOaCrXtH8L4UAg0678oNfdAw" />
                        </div>
                        <div>
                            <p class="font-body-md font-semibold text-on-surface dark:text-on-surface-dark">Marcus Chen</p>
                            <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-[11px] uppercase tracking-wider">Project Lead • 4 mutual
                                projects</p>
                        </div>
                        <button
                            class="ml-auto material-symbols-outlined text-outline dark:text-outline-dark-variant dark:text-outline dark:text-outline-dark-variant-dark hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark">chat_bubble</button>
                    </div>
                    <!-- Person Item 2 -->
                    <div
                        class="p-stack-md flex items-center gap-stack-md hover:bg-surface dark:bg-surface-dark-container-low transition-colors cursor-pointer group">
                        <div
                            class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden ring-2 ring-transparent group-hover:ring-primary transition-all">
                            <img class="w-full h-full object-cover"
                                data-alt="Close-up portrait of a woman with glasses, smiling warmly, soft daylight illumination, minimalist professional vibe, clean background, high-resolution portrait for a high-end enterprise software interface."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAsdLa_fyyDA8jJ_7CbML6KbfP2vZwMeJFcbTabgWR5iGhJXSs_5B6yKDhTycmP0Eco4VEF7KssXFjhvhosO10VFkSPZyn4PiDVqghPzGbzsxtAcYMDtBQd7vpE39h1_uU7-fzSOCI8upI7mds0JObCJ5dJH3sXLWgCqoC7tFE1pSRp6k_cP55Jw0wZQ5zRVMKrEDLRhSBvIbN1gbsgvgh4XgbUVxDOiY5wx8CF1KD6aaGG7EZaFXfyPQ" />
                        </div>
                        <div>
                            <p class="font-body-md font-semibold text-on-surface dark:text-on-surface-dark">Sarah Jenkins</p>
                            <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-[11px] uppercase tracking-wider">Data Analyst • 1 mutual
                                project</p>
                        </div>
                        <button
                            class="ml-auto material-symbols-outlined text-outline dark:text-outline-dark-variant dark:text-outline dark:text-outline-dark-variant-dark hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark">chat_bubble</button>
                    </div>
                    <!-- Person Item 3 -->
                    <div
                        class="p-stack-md flex items-center gap-stack-md hover:bg-surface dark:bg-surface-dark-container-low transition-colors cursor-pointer group">
                        <div
                            class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden ring-2 ring-transparent group-hover:ring-primary transition-all">
                            <img class="w-full h-full object-cover"
                                data-alt="Headshot of a creative professional in a bright, modern office, natural depth of field, minimalist aesthetic, wearing a clean white t-shirt, professional corporate headshot style."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuB9KAtEUoQbBWCawb8Aa8EfOwK6SjYwIPTw2VAp53_GTOZFxcH6-PJaOhjL3aNUVJLFmhu2rirqVL75fRRWL5VgY_PWWtMPf78mzQD7id8cqCIVtRKlzxpw1frTrqGjbh9bebEJ8ZwOHMP8_bhlNJnTLerI3WTOkQo2J5M_wewcIJ76KxbEm-yQhoqG5gpUhgw-hkTGeudUc_7pCz875tMYd85ZNgvRXkrLIDFazZgvcSrmnXYc_BniwA" />
                        </div>
                        <div>
                            <p class="font-body-md font-semibold text-on-surface dark:text-on-surface-dark">Elena Rodriguez</p>
                            <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-[11px] uppercase tracking-wider">Strategy Director • 2
                                mutual projects</p>
                        </div>
                        <button
                            class="ml-auto material-symbols-outlined text-outline dark:text-outline-dark-variant dark:text-outline dark:text-outline-dark-variant-dark hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark">chat_bubble</button>
                    </div>
                </div>
            </section>
        </aside>
    </div>
    <!-- Suggestion / Empty State Atmospheric Effect -->
    <div
        class="mt-20 relative p-gutter-desktop rounded-3xl overflow-hidden border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark bg-surface dark:bg-surface-dark-container-lowest">

        <div class="relative z-10 flex flex-col md:flex-row items-center gap-gutter-desktop">
            <div class="flex-1">
                <h3 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark mb-2">Can't find what you're looking for?</h3>
                <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-body-lg">Try searching for a specific file name, a team member's
                    role, or a project tag. Focus also supports natural language queries like "Tasks due next week".</p>
            </div>
            <div class="flex flex-wrap gap-stack-md">
                <span
                    class="bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark px-stack-lg py-stack-sm rounded-full text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-md cursor-pointer hover:bg-surface dark:bg-surface-dark-container transition-colors">#q4-report</span>
                <span
                    class="bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark px-stack-lg py-stack-sm rounded-full text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-md cursor-pointer hover:bg-surface dark:bg-surface-dark-container transition-colors">#budget-review</span>
                <span
                    class="bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark px-stack-lg py-stack-sm rounded-full text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-md cursor-pointer hover:bg-surface dark:bg-surface-dark-container transition-colors">#onboarding</span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Simple interaction for checkboxes
        document.querySelectorAll('.group .w-5.h-5').forEach(checkbox => {
            checkbox.addEventListener('click', function(e) {
                e.stopPropagation();
                const isCompleted = this.classList.contains('bg-secondary dark:bg-secondary-dark');
                if (isCompleted) {
                    this.classList.remove('bg-secondary dark:bg-secondary-dark', 'flex', 'items-center', 'justify-center',
                        'text-white');
                    this.classList.add('border-2', 'border-outline dark:border-outline-dark');
                    this.innerHTML = '';
                    this.closest('.group').querySelector('h3').classList.remove('line-through');
                    this.closest('.group').classList.remove('opacity-70');
                } else {
                    this.classList.add('bg-secondary dark:bg-secondary-dark', 'flex', 'items-center', 'justify-center',
                        'text-white');
                    this.classList.remove('border-2', 'border-outline dark:border-outline-dark');
                    this.innerHTML =
                        '<span class="material-symbols-outlined text-[14px]" style="font-variation-settings: \'wght\' 700;">check</span>';
                    this.closest('.group').querySelector('h3').classList.add('line-through');
                    this.closest('.group').classList.add('opacity-70');
                }
            });
        });

        // Search highlight effect
        const searchInput = document.querySelector('input[type="text"]');
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('scale-[1.01]');
        });
        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('scale-[1.01]');
        });
    </script>
@endpush
