@extends('layouts.app')

@section('title', 'Team Settings')

@push('styles')
    <style>
        .scale-98:active {
            transform: scale(0.98);
        }

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
    </style>
@endpush

@section('content')
    <!-- Scrollable Canvas -->
    <div class="mb-stack-lg">
        <p class="font-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Configure your team workspace, manage member permissions, and
            connect external services to streamline your workflow.</p>
    </div>
    <!-- Bento-style Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-stack-lg">
        <!-- General Info Card -->
        <section
            class="lg:col-span-7 bg-surface dark:bg-surface-dark-container-lowest p-stack-lg rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center gap-2 mb-stack-lg">
                <span class="material-symbols-outlined text-primary dark:text-primary-dark">info</span>
                <h3 class="font-headline-md text-headline-md">General Info</h3>
            </div>
            <div class="space-y-stack-lg">
                <div class="flex flex-col gap-2">
                    <label class="font-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Team Avatar</label>
                    <div class="flex items-center gap-stack-lg">
                        <div
                            class="w-24 h-24 rounded-2xl bg-surface dark:bg-surface-dark-container-high flex items-center justify-center border-2 border-dashed border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark relative group cursor-pointer overflow-hidden">
                            <img class="absolute inset-0 w-full h-full object-cover"
                                data-alt="A minimalist vector logo representing team collaboration, featuring three interlocking geometric circles in shades of Deep Indigo and Emerald. The background is a crisp, off-white studio setting with soft ambient occlusion. Corporate modern style, clean lines, high contrast."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAG-To2xi_V4o3pGFrg_0gRiOYiAd8KaegzQwJJFlSlasfHtSjRof599OUi6ZDuKzV4Cc7ckScKicSXby6mFmEU1wwRKQ8ydUMUeLDhQ6kWflzHl_3_P9xTGmgybjt1IF89NMfaS80Vnmvvt-Ormb6yzUL2SBjBfVH5QWI_XMyrWEXOCEQrIqvRPvfLiXuZZs5JXSxZsULBzqhCqoc3cYeUkYk_MCJBDGvUbE9Fdz-1dtCpRA66ABlmQg" />
                            <div
                                class="absolute inset-0 bg-on-surface/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="material-symbols-outlined text-white">photo_camera</span>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <button
                                class="px-4 py-2 bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark rounded-lg font-label-md hover:opacity-90 transition-all">Upload
                                New</button>
                            <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Square JPG, PNG or SVG. Max 2MB.</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-stack-md">
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Team Name</label>
                        <input
                            class="w-full px-4 py-3 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark focus:ring-1 focus:ring-primary dark:focus:ring-primary-dark text-body-lg bg-surface dark:bg-surface-dark"
                            type="text" value="Design Systems" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="font-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Description</label>
                        <textarea
                            class="w-full px-4 py-3 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark focus:ring-1 focus:ring-primary dark:focus:ring-primary-dark text-body-md bg-surface dark:bg-surface-dark"
                            rows="3">The core team responsible for maintaining Focus Brand Anchors and UI Components across all platforms.</textarea>
                    </div>
                </div>
                <div class="pt-stack-md flex justify-end">
                    <button
                        class="px-6 py-2.5 bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark rounded-lg font-label-md shadow-sm hover:translate-y-[-1px] active:translate-y-0 transition-all">Save
                        Changes</button>
                </div>
            </div>
        </section>
        <!-- Quick Stats / Status Card -->
        <section
            class="lg:col-span-5 bg-primary dark:bg-primary-dark-container dark:bg-primary dark:bg-primary-dark-container-dark text-on-primary dark:text-on-primary-dark-container dark:text-on-primary dark:text-on-primary-dark-container-dark p-stack-lg rounded-xl flex flex-col justify-between">
            <div>
                <h3 class="font-headline-md text-headline-md mb-2">Workspace Health</h3>
                <p class="font-body-md opacity-80">Your team has reached 85% of its productivity quota this week.
                </p>
            </div>
            <div class="mt-8 space-y-4">
                <div class="flex justify-between items-end">
                    <span class="font-label-md">Active Projects</span>
                    <span class="font-headline-md font-bold text-on-primary dark:text-on-primary-dark-container dark:text-on-primary dark:text-on-primary-dark-container-dark">12</span>
                </div>
                <div class="w-full bg-white dark:bg-surface-container-low-dark/20 h-2 rounded-full overflow-hidden">
                    <div class="bg-secondary dark:bg-secondary-dark-fixed dark:bg-secondary dark:bg-secondary-dark-fixed-dark h-full w-[85%]"></div>
                </div>
                <div class="flex justify-between text-label-sm opacity-80">
                    <span>24 Total Tasks</span>
                    <span>8 Overdue</span>
                </div>
            </div>
            <button
                class="mt-stack-lg w-full py-3 bg-white dark:bg-surface-container-low-dark text-primary dark:text-primary-dark rounded-lg font-label-md font-bold hover:bg-surface dark:bg-surface-dark transition-colors">View
                Detailed Report</button>
        </section>
        <!-- Permissions Section -->
        <section
            class="lg:col-span-12 bg-surface dark:bg-surface-dark-container-lowest p-stack-lg rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark shadow-sm">
            <div class="flex items-center gap-2 mb-stack-lg">
                <span class="material-symbols-outlined text-primary dark:text-primary-dark">security</span>
                <h3 class="font-headline-md text-headline-md">Permissions</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-stack-lg">
                <!-- Permission Item -->
                <div class="flex items-start justify-between py-stack-md border-b border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
                    <div>
                        <p class="font-body-lg font-medium">Allow members to invite</p>
                        <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Non-admins can send invitations to new
                            collaborators.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input checked="" class="sr-only peer" type="checkbox" />
                        <div
                            class="w-11 h-6 bg-surface dark:bg-surface-dark-container-high peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white dark:bg-surface-container-low-dark after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-secondary dark:bg-secondary-dark">
                        </div>
                    </label>
                </div>
                <!-- Permission Item -->
                <div class="flex items-start justify-between py-stack-md border-b border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
                    <div>
                        <p class="font-body-lg font-medium">Project Creation</p>
                        <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Restrict project creation to Team Admins
                            and Managers.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input class="sr-only peer" type="checkbox" />
                        <div
                            class="w-11 h-6 bg-surface dark:bg-surface-dark-container-high peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white dark:bg-surface-container-low-dark after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-secondary dark:bg-secondary-dark">
                        </div>
                    </label>
                </div>
                <!-- Permission Item -->
                <div class="flex items-start justify-between py-stack-md border-b border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
                    <div>
                        <p class="font-body-lg font-medium">Public URL Sharing</p>
                        <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Allow sharing project boards via unique
                            public links.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input checked="" class="sr-only peer" type="checkbox" />
                        <div
                            class="w-11 h-6 bg-surface dark:bg-surface-dark-container-high peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white dark:bg-surface-container-low-dark after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-secondary dark:bg-secondary-dark">
                        </div>
                    </label>
                </div>
                <!-- Permission Item -->
                <div class="flex items-start justify-between py-stack-md border-b border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
                    <div>
                        <p class="font-body-lg font-medium">Billing Access</p>
                        <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Managers can view and download team
                            invoices.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input checked="" class="sr-only peer" type="checkbox" />
                        <div
                            class="w-11 h-6 bg-surface dark:bg-surface-dark-container-high peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white dark:bg-surface-container-low-dark after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-secondary dark:bg-secondary-dark">
                        </div>
                    </label>
                </div>
            </div>
        </section>
        <!-- Integrations Section -->
        <section class="lg:col-span-12">
            <div class="flex items-center gap-2 mb-stack-md">
                <span class="material-symbols-outlined text-primary dark:text-primary-dark">extension</span>
                <h3 class="font-headline-md text-headline-md">Integrations</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-stack-lg">
                <!-- Slack Integration -->
                <div
                    class="bg-surface dark:bg-surface-dark-container-lowest p-stack-lg rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark flex flex-col items-center text-center hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-[#4A154B] rounded-lg flex items-center justify-center mb-stack-md">
                        <span class="material-symbols-outlined text-white text-3xl">chat</span>
                    </div>
                    <h4 class="font-headline-md text-headline-md mb-1">Slack</h4>
                    <p class="text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-stack-lg">Sync task updates and notifications
                        directly to channels.</p>
                    <button
                        class="mt-auto w-full py-2 border border-primary dark:border-primary-dark text-primary dark:text-primary-dark rounded-lg font-label-md hover:bg-primary dark:bg-primary-dark/5 transition-colors">Configure</button>
                </div>
                <!-- GitHub Integration -->
                <div
                    class="bg-surface dark:bg-surface-dark-container-lowest p-stack-lg rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark flex flex-col items-center text-center hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-[#24292F] rounded-lg flex items-center justify-center mb-stack-md">
                        <span class="material-symbols-outlined text-white text-3xl">code</span>
                    </div>
                    <h4 class="font-headline-md text-headline-md mb-1">GitHub</h4>
                    <p class="text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-stack-lg">Link pull requests to Focus tasks
                        automatically.</p>
                    <button
                        class="mt-auto w-full py-2 bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark rounded-lg font-label-md hover:opacity-90 transition-colors">Connect</button>
                </div>
                <!-- Google Calendar Integration -->
                <div
                    class="bg-surface dark:bg-surface-dark-container-lowest p-stack-lg rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark flex flex-col items-center text-center hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-[#4285F4] rounded-lg flex items-center justify-center mb-stack-md">
                        <span class="material-symbols-outlined text-white text-3xl">calendar_month</span>
                    </div>
                    <h4 class="font-headline-md text-headline-md mb-1">Calendar</h4>
                    <p class="text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-stack-lg">Sync deadlines and team milestones
                        to Google Calendar.</p>
                    <button
                        class="mt-auto w-full py-2 bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark rounded-lg font-label-md hover:opacity-90 transition-colors">Connect</button>
                </div>
            </div>
        </section>
        <!-- Danger Zone -->
        <section class="lg:col-span-12 p-stack-lg rounded-xl border border-error dark:border-error-dark bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark/20 mt-stack-lg">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-stack-md">
                <div>
                    <h4 class="font-headline-md text-headline-md text-error dark:text-error-dark flex items-center gap-2">
                        <span class="material-symbols-outlined">warning</span>
                        Danger Zone
                    </h4>
                    <p class="text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mt-1">Deleting this team will permanently remove
                        all associated tasks, files, and project history. This action cannot be undone.</p>
                </div>
                <button
                    class="shrink-0 px-6 py-2.5 bg-error dark:bg-error-dark text-on-error dark:text-on-error-dark rounded-lg font-label-md hover:bg-opacity-90 transition-all">Delete
                    Team</button>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        // Simple micro-interactions
        document.querySelectorAll('input, textarea').forEach(el => {
            el.addEventListener('focus', () => {
                el.parentElement.classList.add('scale-[1.005]');
            });
            el.addEventListener('blur', () => {
                el.parentElement.classList.remove('scale-[1.005]');
            });
        });

        // Toggle Switch Animation
        document.querySelectorAll('input[type="checkbox"]').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const parent = this.closest('label').parentElement;
                if (this.checked) {
                    parent.style.backgroundColor = 'rgba(0, 108, 73, 0.05)';
                } else {
                    parent.style.backgroundColor = 'transparent';
                }
            });
        });
    </script>
@endpush
