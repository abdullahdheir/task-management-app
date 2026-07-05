@extends('layouts.app')

@section('title', 'Edit Project')

@push('styles')
    <style>
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 24px;
        }
    </style>
@endpush

@section('content')
    <!-- Breadcrumbs / Header Section -->
    <div class="mb-10">
        <div class="flex items-center gap-2 text-on-surface-variant mb-2">
            <span class="font-label-md text-label-md">Projects</span>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="font-label-md text-label-md text-primary font-bold">Edit Project</span>
        </div>
        <div class="flex justify-between items-end">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Modern Branding Redesign</h2>
                <p class="text-body-md text-on-surface-variant mt-1">Managed by Sarah Johnson • Project ID: PRJ-9042</p>
            </div>
            <div class="flex gap-3">
                <button
                    class="bg-surface border border-error text-error px-6 py-2.5 rounded-lg font-label-md text-label-md hover:bg-error-container/10 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                    Delete Project
                </button>
                <button
                    class="bg-primary text-on-primary px-8 py-2.5 rounded-lg font-label-md text-label-md shadow-md hover:shadow-lg transition-all active:scale-[0.98]">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
    <!-- Content Bento Grid -->
    <div class="bento-grid">
        <!-- Main Form Column -->
        <div class="col-span-12 lg:col-span-8 space-y-6">
            <!-- Basic Information Card -->
            <section class="bg-surface-container-lowest rounded-xl border border-outline-variant p-stack-lg shadow-sm">
                <div class="flex items-center gap-2 mb-6">
                    <span class="material-symbols-outlined text-primary">info</span>
                    <h3 class="font-headline-md text-headline-md text-on-surface">General Details</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface-variant">Project Name</label>
                        <input
                            class="border border-outline-variant rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-0 outline-none transition-all"
                            type="text" value="Modern Branding Redesign" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface-variant">Category</label>
                        <select
                            class="border border-outline-variant rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-0 outline-none transition-all appearance-none bg-no-repeat bg-[right_1rem_center]">
                            <option>Design</option>
                            <option selected="">Branding</option>
                            <option>Marketing</option>
                            <option>Engineering</option>
                        </select>
                    </div>
                    <div class="col-span-full flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface-variant">Description</label>
                        <textarea
                            class="border border-outline-variant rounded-lg px-4 py-3 text-body-md focus:border-primary focus:ring-0 outline-none transition-all"
                            rows="4">A comprehensive overhaul of the brand's visual identity system, including typography, color palette, and digital asset guidelines for the 2024 product roadmap.</textarea>
                    </div>
                </div>
            </section>
            <!-- Status and Timeline -->
            <section class="bg-surface-container-lowest rounded-xl border border-outline-variant p-stack-lg shadow-sm">
                <div class="flex items-center gap-2 mb-6">
                    <span class="material-symbols-outlined text-primary">schedule</span>
                    <h3 class="font-headline-md text-headline-md text-on-surface">Status & Timeline</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface-variant">Current Status</label>
                        <div
                            class="flex items-center gap-2 px-3 py-2 bg-secondary-container text-on-secondary-container rounded-full w-fit">
                            <span class="w-2 h-2 rounded-full bg-secondary"></span>
                            <span class="text-label-sm font-label-sm">Active & On-track</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface-variant">Start Date</label>
                        <input class="border border-outline-variant rounded-lg px-4 py-2.5 text-body-md" type="date"
                            value="2024-01-15" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface-variant">Target Deadline</label>
                        <input class="border border-outline-variant rounded-lg px-4 py-2.5 text-body-md" type="date"
                            value="2024-04-20" />
                    </div>
                </div>
                <!-- Progress Indicator -->
                <div class="mt-8">
                    <div class="flex justify-between mb-2">
                        <span class="font-label-md text-label-md text-on-surface-variant">Project Completion</span>
                        <span class="font-label-md text-label-md text-secondary font-bold">64%</span>
                    </div>
                    <div class="w-full bg-surface-container-highest h-1.5 rounded-full overflow-hidden">
                        <div class="bg-secondary h-full" style="width: 64%"></div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Team & Secondary Column -->
        <div class="col-span-12 lg:col-span-4 space-y-6">
            <!-- Team Management Card -->
            <section class="bg-surface-container-lowest rounded-xl border border-outline-variant p-stack-lg shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">groups</span>
                        <h3 class="font-headline-md text-headline-md text-on-surface">Team</h3>
                    </div>
                    <button class="text-primary font-label-md text-label-md hover:underline">+ Add</button>
                </div>
                <div class="space-y-4">
                    <!-- Team Member -->
                    <div
                        class="flex items-center justify-between p-3 rounded-lg border border-outline-variant hover:bg-surface transition-colors">
                        <div class="flex items-center gap-3">
                            <img class="w-10 h-10 rounded-full object-cover border border-outline-variant"
                                data-alt="A professional studio headshot of a female UI designer with glasses, warm lighting, minimalist white background, corporate clean aesthetic, soft focus."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuA0vsUoYarYnQE-MoxlDMPrJrkCK-H_8r22KTUJlZ8XGb0rUrYboqqoVNmjBYqcpuaBCOOFP-tBf-M4TaT0MJwMLcLF4pSMAtGzLuoPWUAoZwqtS9RjU3vfB4vwHBKDLu4PHD9Kak_LsGYyNKmX_ws4is40F7XCuiPq2qsxjyZKNX7yxYdinmM-fiN7JvEoQuIgJiiut2DlwuB-eVH5m0ZoQqqnISiDhqR7vuFmOsozO_vp8i4mJOYZEA" />
                            <div>
                                <p class="font-label-md text-label-md text-on-surface">Sarah Johnson</p>
                                <p class="text-label-sm text-on-surface-variant">Project Owner</p>
                            </div>
                        </div>
                        <span
                            class="material-symbols-outlined text-on-surface-variant text-[20px] cursor-pointer hover:text-primary">more_vert</span>
                    </div>
                    <!-- Team Member -->
                    <div
                        class="flex items-center justify-between p-3 rounded-lg border border-outline-variant hover:bg-surface transition-colors">
                        <div class="flex items-center gap-3">
                            <img class="w-10 h-10 rounded-full object-cover border border-outline-variant"
                                data-alt="A professional studio headshot of a diverse male creative director, modern corporate style, light blue background, high quality lighting, professional demeanor."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDy5vIEO6HoNLVu6P77sfBkSIcez-tsQPmI_fLHyuZwpFleVDW8Cmv_J-q_2LqYZIpcMlKFuRFGynjV19SHFAE-GdDlE0xFyXDoa9czATGv1C-xKkfsT4S4rThxZHBe_hTQQpXvjqEbl57kkcpCklo2UWkbsaiyWP1bs6gPUoIRjZCckYfbieRg4opoKTibZPTY9wXlL8vmLVL-UTtL9DSbYRACzRooZgzo5ypwVykH4WN-vIVyLCz38g" />
                            <div>
                                <p class="font-label-md text-label-md text-on-surface">Marcus Chen</p>
                                <p class="text-label-sm text-on-surface-variant">Lead Designer</p>
                            </div>
                        </div>
                        <button class="text-on-surface-variant hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-[20px]">person_remove</span>
                        </button>
                    </div>
                    <!-- Team Member -->
                    <div
                        class="flex items-center justify-between p-3 rounded-lg border border-outline-variant hover:bg-surface transition-colors">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center text-primary font-bold">
                                EM</div>
                            <div>
                                <p class="font-label-md text-label-md text-on-surface">Elena Martinez</p>
                                <p class="text-label-sm text-on-surface-variant">Brand Strategist</p>
                            </div>
                        </div>
                        <button class="text-on-surface-variant hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-[20px]">person_remove</span>
                        </button>
                    </div>
                </div>
                <div class="mt-6 pt-6 border-t border-outline-variant">
                    <p class="font-label-md text-label-md text-on-surface-variant mb-4">Sharing Permissions</p>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-body-md">External collaborators can view</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input checked="" class="sr-only peer" type="checkbox" />
                            <div
                                class="w-11 h-6 bg-outline-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                        </label>
                    </div>
                </div>
            </section>
            <!-- Visual Preview / Moodboard -->
            <section class="bg-surface-container-lowest rounded-xl border border-outline-variant p-stack-lg shadow-sm">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-primary">image</span>
                    <h3 class="font-headline-md text-headline-md text-on-surface">Project Assets</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="aspect-square rounded-lg bg-cover bg-center"
                        data-alt="A collection of minimalist logo variations and color swatches on a clean digital board, deep indigo and emerald accents, professional brand identity moodboard, high resolution digital design."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDzF8vNHWUbZhvhkX3BSVeYImDob-nFTT2ha2c02ptQWzAnNwXSEtEZqQf2bW2h9xa6ndbuAAtFwE0baj-xKKcb4FdZxMLO42_LyrzN--6_E7NJBUhe6d00Wxo5DzaFnEb6ekouEmEEnPINY_TLqar6ynp4nT3QfhJPv5Oe_aRDSJvR6cc143_N8PjNixlfZxazuTpSPmG5sNRs1WIXcUkjHO2e-kR4vcCVi9xrzzMSGSSbco0S0lwdlg')">
                    </div>
                    <div class="aspect-square rounded-lg bg-cover bg-center"
                        data-alt="Close up of a modern sans-serif typography specimen in high contrast black and white, clean corporate aesthetic, professional graphic design showcase."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBM49sD02cZ_0NV3POOPWNzwCICvy90B_DVqZDc1sGAFcwhB7ABq5_tTyLM41Xsl6uCXJwlXc9mhC0ddKuhPIdbZB90Y2zInKLv45sI2bygUwGnnG-ysI8AB0lnPS4UOwZR1DmEXbJ0cvU_rgyyYQ5i643wMFU5ZY-QHicesq-n5oAdhZ7o4Q_CETUg6mCOV3cLNIfsx7PYEK1OnUYpZ8wLb4lDp3E-vfPKvJjQGVvSRWV-r2Hil8A6VA')">
                    </div>
                    <div
                        class="aspect-square rounded-lg bg-surface-container-low border border-dashed border-outline-variant flex flex-col items-center justify-center cursor-pointer hover:bg-surface-container-high transition-colors col-span-2">
                        <span class="material-symbols-outlined text-on-surface-variant">upload_file</span>
                        <span class="text-label-sm font-label-sm text-on-surface-variant mt-1">Upload More</span>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Delete Confirmation Modal (Hidden by Default) -->
    <div class="hidden fixed inset-0 z-[100] flex items-center justify-center px-4" id="deleteModal">
        <div class="absolute inset-0 bg-on-surface/40 backdrop-blur-sm"></div>
        <div
            class="relative bg-surface-container-lowest w-full max-w-md rounded-2xl p-stack-lg shadow-2xl animate-in fade-in zoom-in duration-300">
            <div class="flex items-center gap-4 text-error mb-4">
                <div class="bg-error-container p-3 rounded-full">
                    <span class="material-symbols-outlined text-[32px]">warning</span>
                </div>
                <h3 class="font-headline-md text-headline-md">Delete Project?</h3>
            </div>
            <p class="text-body-md text-on-surface-variant mb-8">
                This action is permanent and cannot be undone. All project data, including tasks, files, and team access,
                will be purged from the workspace.
            </p>
            <div class="flex gap-3 justify-end">
                <button
                    class="px-6 py-2.5 rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-low transition-colors"
                    onclick="toggleDeleteModal()">Cancel</button>
                <button
                    class="px-6 py-2.5 rounded-lg font-label-md text-label-md bg-error text-on-error shadow-md hover:bg-error/90 transition-colors">Yes,
                    Delete Everything</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
