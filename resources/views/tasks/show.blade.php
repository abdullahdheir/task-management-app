@extends('layouts.app')

@section('title', 'Task Details')

@push('styles')
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .task-card-active {
            box-shadow: 0px 4px 6px -1px rgba(0, 0, 0, 0.05), 0px 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
    </style>
@endpush

@section('content')
    <!-- Task Detailed View -->
    <div class="max-w-container-max mx-auto p-gutter-desktop">
        <!-- Breadcrumbs / Navigation Back -->
        <div class="flex items-center gap-2 mb-stack-lg text-on-surface-variant">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            <span class="font-label-md text-label-md">Back to Task List</span>
        </div>
        <!-- Task Header -->
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-stack-lg mb-stack-lg">
            <div class="space-y-stack-sm">
                <div class="flex items-center gap-stack-md flex-wrap">
                    <span
                        class="px-3 py-1 bg-surface-container-high text-on-secondary-container rounded-full font-label-sm text-label-sm flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">work</span> Work
                    </span>
                    <span
                        class="px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-full font-label-sm text-label-sm flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">priority_high</span> Medium Priority
                    </span>
                </div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Update Design System
                    Documentation</h2>
            </div>
            <div class="flex items-center gap-2">
                <button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined">share</span>
                </button>
                <button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">
                    <span class="material-symbols-outlined">more_horiz</span>
                </button>
                <button
                    class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md text-label-md flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]"
                        style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    Mark Complete
                </button>
            </div>
        </div>
        <!-- Bento Layout Content -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-stack-lg">
            <!-- Left Column: Main Info -->
            <div class="lg:col-span-8 space-y-stack-lg">
                <!-- Description Card -->
                <section class="bg-surface-container-lowest p-stack-lg rounded-xl border border-outline-variant/30">
                    <h3 class="font-headline-md text-headline-md mb-stack-md">Description</h3>
                    <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                        Complete the final overhaul of the brand documentation, ensuring all Tailwind tokens match the
                        latest production release. Pay special attention to the typography hierarchy and the new
                        color-neutral shades for high-contrast components.
                    </p>
                </section>
                <!-- Sub-tasks Checklist -->
                <section class="bg-surface-container-lowest p-stack-lg rounded-xl border border-outline-variant/30">
                    <div class="flex justify-between items-center mb-stack-md">
                        <h3 class="font-headline-md text-headline-md">Sub-tasks</h3>
                        <span class="text-label-md font-label-md text-on-surface-variant">2 of 4 complete</span>
                    </div>
                    <div class="w-full bg-surface-container rounded-full h-1.5 mb-stack-lg">
                        <div class="bg-secondary h-1.5 rounded-full" style="width: 50%"></div>
                    </div>
                    <ul class="space-y-2">
                        <li
                            class="flex items-center gap-3 p-3 hover:bg-surface-container-low transition-colors rounded-lg group">
                            <input checked=""
                                class="w-5 h-5 rounded-full border-secondary text-secondary focus:ring-secondary cursor-pointer"
                                type="checkbox" />
                            <span class="font-body-md text-body-md text-on-surface-variant line-through">Audit existing
                                typography tokens</span>
                        </li>
                        <li
                            class="flex items-center gap-3 p-3 hover:bg-surface-container-low transition-colors rounded-lg group">
                            <input checked=""
                                class="w-5 h-5 rounded-full border-secondary text-secondary focus:ring-secondary cursor-pointer"
                                type="checkbox" />
                            <span class="font-body-md text-body-md text-on-surface-variant line-through">Export new asset
                                library for Figma</span>
                        </li>
                        <li
                            class="flex items-center gap-3 p-3 hover:bg-surface-container-low transition-colors rounded-lg group">
                            <input
                                class="w-5 h-5 rounded-full border-outline-variant text-primary focus:ring-primary cursor-pointer"
                                type="checkbox" />
                            <span class="font-body-md text-body-md text-on-surface">Finalize color mapping for dark
                                mode</span>
                        </li>
                        <li
                            class="flex items-center gap-3 p-3 hover:bg-surface-container-low transition-colors rounded-lg group">
                            <input
                                class="w-5 h-5 rounded-full border-outline-variant text-primary focus:ring-primary cursor-pointer"
                                type="checkbox" />
                            <span class="font-body-md text-body-md text-on-surface">Update Tailwind configuration in the
                                repo</span>
                        </li>
                    </ul>
                    <button
                        class="mt-stack-md flex items-center gap-2 text-primary font-label-md text-label-md hover:underline">
                        <span class="material-symbols-outlined text-[16px]">add</span> Add Sub-task
                    </button>
                </section>
                <!-- Activity Thread -->
                <section class="bg-surface-container-lowest p-stack-lg rounded-xl border border-outline-variant/30">
                    <h3 class="font-headline-md text-headline-md mb-stack-lg">Activity</h3>
                    <div class="space-y-stack-lg">
                        <!-- Comment 1 -->
                        <div class="flex gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-primary font-bold">
                                JD</div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-label-md text-label-md font-bold">Jane Doe</span>
                                    <span class="text-label-sm text-on-surface-variant">2 hours ago</span>
                                </div>
                                <p class="font-body-md text-body-md text-on-surface-variant">I've just uploaded the latest
                                    brand assets. Let me know if the SVG paths need any further optimization before we lock
                                    the documentation.</p>
                                <div class="mt-2 flex items-center gap-4">
                                    <button class="text-label-sm text-on-surface-variant hover:text-primary">Reply</button>
                                    <button class="text-label-sm text-on-surface-variant hover:text-primary">React</button>
                                </div>
                            </div>
                        </div>
                        <!-- Log Entry -->
                        <div class="flex items-center gap-4 ml-5 pl-10 border-l border-outline-variant py-2">
                            <span class="material-symbols-outlined text-[16px] text-on-surface-variant">history</span>
                            <p class="text-label-sm text-on-surface-variant">System: Task priority changed from <span
                                    class="font-bold">Low</span> to <span class="font-bold">Medium</span> by Jane Doe.</p>
                        </div>
                        <!-- User Comment Box -->
                        <div class="flex gap-4 items-start pt-stack-md">
                            <div
                                class="w-10 h-10 rounded-full bg-surface-variant flex items-center justify-center text-on-surface-variant material-symbols-outlined">
                                account_circle</div>
                            <div class="flex-1 relative">
                                <textarea
                                    class="w-full bg-surface-container-low border border-outline-variant rounded-xl p-3 text-body-md font-body-md focus:ring-2 focus:ring-primary-container h-24 resize-none"
                                    placeholder="Write a comment..."></textarea>
                                <div class="absolute bottom-3 right-3 flex items-center gap-2">
                                    <button class="p-1.5 text-on-surface-variant hover:text-primary"><span
                                            class="material-symbols-outlined">attach_file</span></button>
                                    <button
                                        class="bg-primary text-on-primary px-4 py-1.5 rounded-lg font-label-sm text-label-sm">Post
                                        Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- Right Column: Metadata & Attachments -->
            <div class="lg:col-span-4 space-y-stack-lg">
                <!-- Metadata Card -->
                <aside
                    class="bg-surface-container-lowest p-stack-lg rounded-xl border border-outline-variant/30 space-y-stack-lg">
                    <div>
                        <h4 class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-2">
                            Assignee</h4>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center text-label-md font-bold">
                                AL</div>
                            <span class="font-label-md text-label-md">Alex Loomis</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-2">Due
                            Date</h4>
                        <div class="flex items-center gap-3 text-on-surface">
                            <span class="material-symbols-outlined text-primary">calendar_today</span>
                            <span class="font-label-md text-label-md">October 24, 2023</span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-2">
                            Project</h4>
                        <a class="flex items-center gap-3 text-primary hover:underline" href="#">
                            <span class="material-symbols-outlined">link</span>
                            <span class="font-label-md text-label-md">2023 Brand Refresh</span>
                        </a>
                    </div>
                    <div>
                        <h4 class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-2">Labels
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-2 py-0.5 bg-secondary-container text-on-secondary-container rounded font-label-sm text-label-sm">Internal</span>
                            <span
                                class="px-2 py-0.5 bg-surface-variant text-on-surface-variant rounded font-label-sm text-label-sm">Urgent</span>
                        </div>
                    </div>
                </aside>
                <!-- Attachments Card -->
                <section class="bg-surface-container-lowest p-stack-lg rounded-xl border border-outline-variant/30">
                    <div class="flex justify-between items-center mb-stack-md">
                        <h3 class="font-headline-md text-headline-md">Attachments</h3>
                        <button class="text-primary material-symbols-outlined">add_circle</button>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <!-- File 1 -->
                        <div
                            class="group relative overflow-hidden rounded-lg border border-outline-variant/50 cursor-pointer">
                            <div class="w-full h-24 bg-cover bg-center group-hover:scale-105 transition-transform duration-300"
                                data-alt="A clean, minimalist high-resolution screenshot of a digital design system documentation page, showing typography scales and color swatches on a white background with a modern corporate aesthetic."
                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBE9lNm_NUgPk07542b7vbzuQqixlZFMKYgSEDAsyo3DYcrdIRCpuMYdju_8SfR9Of03W2W5x27C5RnnH5iQVfINnffPSk8gCBRFqwDUc6BQcdE1l2tWwaMa1KCzKvqU6cU1ksfH__YPf8xE-BrX_z9PKhT6rbaUjfj8sLUtmQcLsenjlsvNJBugOJ3g4F_4M8CkBqnuiGn6tEnLwAmo6PtjmFbOQVxydY1IESCeNOSiTHNOBHiLIAqxA')">
                            </div>
                            <div class="p-2 bg-white/90 backdrop-blur-sm">
                                <p class="font-label-sm text-label-sm truncate">brand_guide_v2.pdf</p>
                                <p class="text-[10px] text-on-surface-variant">2.4 MB</p>
                            </div>
                        </div>
                        <!-- File 2 -->
                        <div
                            class="group relative overflow-hidden rounded-lg border border-outline-variant/50 cursor-pointer">
                            <div class="w-full h-24 bg-cover bg-center group-hover:scale-105 transition-transform duration-300"
                                data-alt="A detailed professional architectural sketch or wireframe showing the layout of a modern mobile application interface with clean indigo accents and generous white space, viewed from a top-down perspective."
                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCOck0TI-W3ZJ-cJscLirHGSnHkBcwk2SSeoLhdtgfXrPBkgWxZfciILrrTIl-7xT0YbI5VsK-evFttSlaeTXDhKerX_b2Myw6kccT3sEWchMCRs6v4VPvAtnm6cBQltbgvzLS6JPjJogPp0nAkPj2ESM9at5f8bixMGyNaNmEvwK4jJ8fU_TUNn3Bs6nUfd3aBF61b56gmDM05acdoEDDyhPzYDkHbUKF7bdvzkAkXPA6tA6w3k9fZcg')">
                            </div>
                            <div class="p-2 bg-white/90 backdrop-blur-sm">
                                <p class="font-label-sm text-label-sm truncate">wireframes_final.png</p>
                                <p class="text-[10px] text-on-surface-variant">1.1 MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-stack-md space-y-2">
                        <div
                            class="flex items-center gap-3 p-2 border border-dashed border-outline-variant rounded-lg hover:bg-surface-container transition-colors cursor-pointer">
                            <span class="material-symbols-outlined text-on-surface-variant">upload_file</span>
                            <span class="font-label-md text-label-md text-on-surface-variant">Drop files here to
                                upload</span>
                        </div>
                    </div>
                </section>
                <!-- Atmospheric Animation Element (Subtle) -->
                <div class="relative h-32 rounded-xl overflow-hidden border border-outline-variant/30">

                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                        <span class="material-symbols-outlined text-primary mb-1">auto_awesome</span>
                        <p class="text-label-sm font-label-sm text-primary">Focused Session Active</p>
                        <p class="text-[10px] text-on-surface-variant">Keep your flow state going</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Micro-interaction: Checkbox strike-through trigger
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const textSpan = this.nextElementSibling;
                if (this.checked) {
                    textSpan.classList.add('line-through', 'text-on-surface-variant');
                    textSpan.classList.remove('text-on-surface');
                } else {
                    textSpan.classList.remove('line-through', 'text-on-surface-variant');
                    textSpan.classList.add('text-on-surface');
                }
            });
        });

        // Micro-interaction: Floating labels for textarea (simplified)
        const textarea = document.querySelector('textarea');
        textarea.addEventListener('focus', () => {
            textarea.classList.add('shadow-lg');
        });
        textarea.addEventListener('blur', () => {
            textarea.classList.remove('shadow-lg');
        });
    </script>
@endpush
