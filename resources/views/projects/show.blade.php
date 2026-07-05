@extends('layouts.app')

@section('title', "{{ $project->title ?? 'Project Details' }}")

@push('styles')
    <style>
        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0px 4px 6px -1px rgba(0, 0, 0, 0.05), 0px 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
@endpush

@section('content')
    <!-- Project Hero Section -->
    <div class="mb-stack-lg bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm">
        <div class="flex justify-between items-end mb-4">
            <div>
                <h2 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Project
                    Progress</h2>
                <div class="flex items-baseline gap-2">
                    <span class="font-headline-lg text-headline-lg text-primary">68%</span>
                    <span class="text-on-surface-variant font-body-md text-body-md">Completed</span>
                </div>
            </div>
            <div class="text-right">
                <span class="font-label-md text-label-md text-on-surface-variant">24 of 35 tasks remaining</span>
            </div>
        </div>
        <div class="w-full h-2 bg-surface-container rounded-full overflow-hidden">
            <div class="h-full bg-secondary transition-all duration-1000 ease-out" style="width: 68%;"></div>
        </div>
    </div>
    <!-- Bento Grid Layout -->
    <div class="grid grid-cols-12 gap-gutter-desktop">
        <!-- 1. Overview & Timeline (Left Column) -->
        <div class="col-span-12 lg:col-span-8 space-y-gutter-desktop">
            <div
                class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant hover:shadow-sm transition-all duration-300">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">description</span>
                        Project Overview
                    </h3>
                    <button class="text-primary font-label-md hover:underline">Edit</button>
                </div>
                <p class="text-body-lg font-body-lg text-on-surface-variant leading-relaxed mb-8">
                    A complete visual identity overhaul for the 2024 product line. This project involves redefining the
                    color palette, typography guidelines, and core brand assets to align with the new 'Minimalism &amp;
                    Productivity' market positioning.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-4 bg-surface-container-low rounded-lg">
                        <span class="text-label-sm text-on-surface-variant block mb-1">Timeline</span>
                        <div class="flex items-center gap-2 text-on-surface font-body-md">
                            <span class="material-symbols-outlined text-primary text-[18px]">calendar_today</span>
                            Oct 12 - Dec 20
                        </div>
                    </div>
                    <div class="p-4 bg-surface-container-low rounded-lg">
                        <span class="text-label-sm text-on-surface-variant block mb-1">Priority</span>
                        <div class="flex items-center gap-2 text-on-surface font-body-md">
                            <span class="material-symbols-outlined text-error text-[18px]"
                                style="font-variation-settings: 'FILL' 1;">stat_3</span>
                            Critical High
                        </div>
                    </div>
                    <div class="p-4 bg-surface-container-low rounded-lg">
                        <span class="text-label-sm text-on-surface-variant block mb-1">Budget</span>
                        <div class="flex items-center gap-2 text-on-surface font-body-md">
                            <span class="material-symbols-outlined text-secondary text-[18px]">payments</span>
                            $45,000.00
                        </div>
                    </div>
                </div>
            </div>
            <!-- 3. Task List Section -->
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">checklist</span>
                        Project Tasks
                    </h3>
                    <div class="flex gap-2">
                        <span
                            class="px-3 py-1 bg-surface-container text-on-surface-variant rounded-md text-label-sm cursor-pointer hover:bg-surface-container-high">All</span>
                        <span
                            class="px-3 py-1 text-on-surface-variant rounded-md text-label-sm cursor-pointer hover:bg-surface-container-low">Todo</span>
                        <span
                            class="px-3 py-1 text-on-surface-variant rounded-md text-label-sm cursor-pointer hover:bg-surface-container-low">Review</span>
                    </div>
                </div>
                <div class="space-y-3">
                    <!-- Task Card 1 -->
                    <div
                        class="task-card flex items-center justify-between p-4 bg-white border border-outline-variant rounded-lg transition-all duration-200">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-5 h-5 rounded-full border-2 border-outline cursor-pointer hover:border-secondary transition-colors">
                            </div>
                            <div>
                                <h4 class="font-body-lg text-body-lg text-on-surface">Finalize Typography Scale</h4>
                                <p class="text-label-sm text-on-surface-variant">Design System • Due tomorrow</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span
                                class="px-2 py-0.5 bg-tertiary-fixed text-on-tertiary-fixed rounded text-[10px] font-bold uppercase">Urgent</span>
                            <div class="w-8 h-8 rounded-full border-2 border-white -ml-2 ring-1 ring-outline-variant">
                                <img class="w-full h-full rounded-full object-cover"
                                    data-alt="Close-up portrait of a woman with a confident smile, wearing glasses and a navy turtleneck. The aesthetic is clean and professional with soft, high-key studio lighting that creates a bright, corporate yet approachable look. Soft blue and white background tones."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCjUT4GX-xNpBTY2CBfYLLAeKO1YBxF44uFzhT-0jp71v-AfyhUaSoHKpLymt5_v_LeZXU6ZZQKiIy6kfG5fTU3Xwk35OpCvwbFH681T4cNV2bTcRqfN5eoDUzNgJdOjNfoF-DtLFw2K_Pr25cgb7Sq8azfYFbbqpeBr18ROQLTG2182buypf14cv-SRZUnQh3ar8YsOJbupkjYcy_bZ04C1SnOmOHIFJRL28CtsjKGfHgh5M9StXwbng" />
                            </div>
                        </div>
                    </div>
                    <!-- Task Card 2 (Completed) -->
                    <div
                        class="task-card flex items-center justify-between p-4 bg-surface-container-low border border-transparent rounded-lg opacity-80">
                        <div class="flex items-center gap-4">
                            <div class="w-5 h-5 rounded-full bg-secondary flex items-center justify-center text-white">
                                <span class="material-symbols-outlined text-[16px]">check</span>
                            </div>
                            <div>
                                <h4 class="font-body-lg text-body-lg text-on-surface line-through">Establish Primary Color
                                    Palette</h4>
                                <p class="text-label-sm text-on-surface-variant">Completed Oct 14</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span
                                class="px-2 py-0.5 bg-secondary-container text-on-secondary-container rounded text-[10px] font-bold uppercase">Done</span>
                            <div class="w-8 h-8 rounded-full border-2 border-white -ml-2 ring-1 ring-outline-variant">
                                <img class="w-full h-full rounded-full object-cover"
                                    data-alt="Portrait of a young male designer in a creative office setting. Warm, professional lighting with a shallow depth of field, focusing on his friendly expression. Minimalist interior with light-colored walls and modern furniture."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqjyo8qRnzkDIxcKDkDGwKHwvFJdTAQ_xIuJJbkTPJlt4uKTgzm-MYBOiK2AQXfcFyMrEzagouQSXKJvI4izBC_QAaq3_hKhj26Phot9Mpdvw4y6ZLLP-c2SY9zBi2YaE_RXQHY4gvhN_6yQnpEiTwEGD7cQEwVKclyV4bwSVjzgdvfL2MNqBjTWfU1YAdvra7i86YMLZ3c4RR7okK-4pkhcWovmUFvILkYATphcS-z07BfrY3CgzFYA" />
                            </div>
                        </div>
                    </div>
                    <!-- Task Card 3 -->
                    <div
                        class="task-card flex items-center justify-between p-4 bg-white border border-outline-variant rounded-lg transition-all duration-200">
                        <div class="flex items-center gap-4">
                            <div class="w-5 h-5 rounded-full border-2 border-outline cursor-pointer"></div>
                            <div>
                                <h4 class="font-body-lg text-body-lg text-on-surface">Logo Accessibility Audit</h4>
                                <p class="text-label-sm text-on-surface-variant">Brand Assets • Oct 28</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span
                                class="px-2 py-0.5 bg-primary-fixed text-on-primary-fixed-variant rounded text-[10px] font-bold uppercase">Next
                                Up</span>
                            <div class="flex -space-x-3 overflow-hidden">
                                <div class="inline-block h-8 w-8 rounded-full ring-2 ring-white">
                                    <img class="h-full w-full object-cover"
                                        data-alt="Professional woman with short hair and a gray blazer in a modern, bright office environment. The style is minimalist and clean, utilizing a palette of light grays and whites. Mood is focused and professional."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuC_7aZD_Jjo2KThKvRUDGi7zXLuq2h5eCWHARD79CqPZzVKa7N6o0UOTVEU4po2EEmwfgDdcFM7AsOlOofntHlKxTqynlyu25oZzzcoqO3RcTig9mhCq0VmcvOFfTq0XX_O8lZ7-Q9GbHkAkiqd2O4ji90iRb6nYz2ZVgKGu8X1FUiuyzKkUPlNgNZGy_NYq6QjhnxiAtGuxI0BPQBMu7HrdnkEEzjtexCedPVoGKjiSLM9Z07c8mJF_w" />
                                </div>
                                <div class="inline-block h-8 w-8 rounded-full ring-2 ring-white">
                                    <img class="h-full w-full object-cover"
                                        data-alt="Portrait of an ethnic male architect with a calm expression, wearing a minimalist black shirt. Bright, white-wall background with soft shadows, creating a serene and professional atmosphere."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4dd-clsMMTXRAdmc4DmwlEFd1hNpSuEs_cqZTG9DmrCpEBYX6hNmIgdhR8hhGdz0jyVvr_9cIk1fE62VVeoMApdeXC7683AqvXU9iPQa-nMUsmlHJFFN5BUdSdvvu-5CRftytq8UTQVV9RhH8rVTIMBdfi10Ee2GHXPKz_xLA5MspJ3GHJVK2fyrY7wtupAh-IuyNLSW6yDa7rhGwQKSBGGeV56YnnOpMVVHTKFK7ZcAOECexUPV9NQ" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 2. Team & Activity (Right Column) -->
        <div class="col-span-12 lg:col-span-4 space-y-gutter-desktop">
            <!-- Team Members Card -->
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant">
                <h3 class="font-headline-md text-headline-md text-on-surface mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">groups</span>
                    Team
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img class="w-10 h-10 rounded-full object-cover"
                                data-alt="A portrait of a senior creative director, a middle-aged woman with a sharp, professional look. Neutral, soft-light studio background. Minimalist styling, high quality photography."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1Hw8ElWpkEWPykf0p_E8nhbZhGsoHX8w-06E8_qHT-Y2BcRATOjOmum84mvo-Tk_rYwZ398ttOaUH0AH4sps3o8jux8u_PS6kCnTsebRq68fnlLGhYEKCz7nf7t6ur8-BsokcnhPSyMK5RuMMAJP3IwNm8RiZmBZz86YlrqmVX2acEzBUHiuzCnWMWylCEzNb9YBuFRlhjxvFuIer-iidlCLXGSsVnx0q9OFqVWPN0I4CgjVZ5GaMdA" />
                            <div>
                                <p class="font-body-lg text-body-lg text-on-surface leading-tight">Sarah Jenkins</p>
                                <p class="text-label-sm text-on-surface-variant">Lead Designer</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant cursor-pointer">more_vert</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img class="w-10 h-10 rounded-full object-cover"
                                data-alt="A portrait of a male product designer with a modern, artistic look. Brightly lit studio environment with soft shadows. Calm, professional aesthetic with primary indigo and neutral gray colors."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCD-KUW7cGQCFzuHHiRbqLWGCTBCsUMukpluvn8u4ckfv-GDOo6y-cta8UTTf2lfBx7As21D2tcwG4pPgthurggwWxl4UbECW4NgRnU9inQODwHxSjfy_rhH542-2Cm5AlT4j_5xWA5AmADEFDrIdqRQuDyluveq0P4hXiFdws0as9gHtLjj31VE0Eu-ovU4b3bpuOt5byIfF7mRpk3UggWa-lD1mTt-T_Sa_PNodQuVWJsgg2lDuVy9g" />
                            <div>
                                <p class="font-body-lg text-body-lg text-on-surface leading-tight">David Chen</p>
                                <p class="text-label-sm text-on-surface-variant">UX Researcher</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant cursor-pointer">more_vert</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img class="w-10 h-10 rounded-full object-cover"
                                data-alt="A creative professional woman in a bright, modern studio. She is smiling warmly. The image has a clean, high-end feel with high-key lighting and a muted, sophisticated color palette."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQnJWuFPjYsTVN7dH_Dwv7EqRXIaahxH-6awxsbrESaX-Gz24gUZ5y-m7OKnmGKY4G6UvBMnHMnS8yTDuqwxdp52j1QppQB74hQQ-ZvlYfAG78zn_iSV_JNudroXmIBONPuv__Od8J81Lk3jQSv6Ibc8GHqXO_3IRIAcgIROp_qv0QAUpfVmM1c3tXr-scl2gQMxVCnTSPgZODvSMnLdBgmibj2dENQp5xvuL2IrEVHKbw2STNzUzBzQ" />
                            <div>
                                <p class="font-body-lg text-body-lg text-on-surface leading-tight">Elena Rodriguez</p>
                                <p class="text-label-sm text-on-surface-variant">Visual Artist</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant cursor-pointer">more_vert</span>
                    </div>
                    <button
                        class="w-full mt-2 py-2 border-2 border-dashed border-outline-variant text-on-surface-variant rounded-lg font-label-md flex items-center justify-center gap-2 hover:border-primary hover:text-primary transition-all">
                        <span class="material-symbols-outlined text-[18px]">person_add</span>
                        Add Member
                    </button>
                </div>
            </div>
            <!-- Recent Activity Feed -->
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant">
                <h3 class="font-headline-md text-headline-md text-on-surface mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">history</span>
                    Activity
                </h3>
                <div class="space-y-6 relative">
                    <div class="absolute left-[19px] top-4 bottom-4 w-0.5 bg-surface-container"></div>
                    <!-- Activity Item 1 -->
                    <div class="relative flex gap-4">
                        <div
                            class="z-10 w-10 h-10 rounded-full bg-white border-2 border-primary-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-[18px]">comment</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-body-md text-on-surface">
                                <span class="font-bold">Sarah Jenkins</span> commented on <span
                                    class="text-primary cursor-pointer hover:underline">Typography Scale</span>
                            </p>
                            <p class="text-label-sm text-on-surface-variant mt-1">2 hours ago</p>
                            <div
                                class="mt-3 p-3 bg-surface-container-low rounded-lg text-body-md italic border-l-2 border-primary">
                                "The display-large size might be too tight for mobile viewports. Can we recheck?"
                            </div>
                        </div>
                    </div>
                    <!-- Activity Item 2 -->
                    <div class="relative flex gap-4">
                        <div
                            class="z-10 w-10 h-10 rounded-full bg-white border-2 border-secondary flex items-center justify-center">
                            <span class="material-symbols-outlined text-secondary text-[18px]">done_all</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-body-md text-on-surface">
                                <span class="font-bold">David Chen</span> completed <span
                                    class="text-primary cursor-pointer hover:underline">Primary Color Palette</span>
                            </p>
                            <p class="text-label-sm text-on-surface-variant mt-1">5 hours ago</p>
                        </div>
                    </div>
                    <!-- Activity Item 3 -->
                    <div class="relative flex gap-4">
                        <div
                            class="z-10 w-10 h-10 rounded-full bg-white border-2 border-outline flex items-center justify-center">
                            <span class="material-symbols-outlined text-on-surface-variant text-[18px]">attachment</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-body-md text-on-surface">
                                <span class="font-bold">Elena Rodriguez</span> uploaded <span
                                    class="text-primary cursor-pointer hover:underline">Brand_Assets_V2.zip</span>
                            </p>
                            <p class="text-label-sm text-on-surface-variant mt-1">Yesterday at 4:15 PM</p>
                        </div>
                    </div>
                </div>
                <button
                    class="w-full mt-6 text-primary font-label-md hover:bg-surface-container-low py-2 rounded-lg transition-colors">
                    View Full History
                </button>
            </div>
        </div>
    </div>

    <!-- Floating Action for Mobile / Quick Add -->
    <div class="fixed bottom-gutter-desktop right-gutter-desktop">
        <button
            class="w-14 h-14 bg-primary text-on-primary rounded-full shadow-lg flex items-center justify-center hover:scale-105 active:scale-95 transition-all">
            <span class="material-symbols-outlined text-[28px]">add</span>
        </button>
    </div>
@endsection

@push('scripts')
    <script>
        // Micro-interactions and subtle effects
        document.querySelectorAll('.task-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                // Potential for JS triggered animations
            });
        });

        // Simulating some focus states or interactions
        const progressFill = document.querySelector('.bg-secondary.transition-all');
        window.addEventListener('load', () => {
            progressFill.style.width = '0%';
            setTimeout(() => {
                progressFill.style.width = '68%';
            }, 300);
        });
    </script>
@endpush
