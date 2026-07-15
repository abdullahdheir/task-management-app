@extends('layouts.app')

@section('title', 'Edit Team')

@push('styles')
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
    </style>
@endpush

@section('content')
    <!-- Breadcrumbs & Header -->
    <div class="mb-stack-lg">
        <nav class="flex items-center gap-2 text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-2">
            <a class="hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark" href="#">Team</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-on-surface dark:text-on-surface-dark">Edit Team Profile</span>
        </nav>
        <div class="flex justify-between items-end">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface dark:text-on-surface-dark">Edit Team Profile</h2>
                <p class="text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Update your team's core identity and manage member access.
                </p>
            </div>
            <div class="flex gap-3">
                <button
                    class="px-4 py-2 border border-outline dark:border-outline-dark text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-md rounded-lg hover:bg-surface dark:bg-surface-dark-container-low transition-all">Cancel</button>
                <button
                    class="px-6 py-2 bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark font-label-md rounded-lg hover:shadow-lg transition-all">Save
                    Changes</button>
            </div>
        </div>
    </div>
    <!-- Bento Grid Layout -->
    <div class="grid grid-cols-12 gap-gutter-desktop">
        <!-- Section: Basic Info (Left 7 Columns) -->
        <div class="col-span-7 space-y-gutter-desktop">
            <section class="glass-card rounded-xl p-stack-lg shadow-sm">
                <h3 class="font-headline-md text-headline-md mb-stack-lg">Core Details</h3>
                <div class="space-y-stack-lg">
                    <div class="flex gap-stack-lg items-start">
                        <div class="relative group cursor-pointer">
                            <div
                                class="w-24 h-24 rounded-2xl bg-surface dark:bg-surface-dark-container-highest border-2 border-dashed border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark flex items-center justify-center overflow-hidden">
                                <img class="w-full h-full object-cover opacity-80"
                                    data-alt="A minimalist tech company logo design, featuring geometric abstract shapes in deep indigo and emerald colors, centered on a clean white background, high-end branding aesthetic for a productivity startup."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDTUHcHBYUBJtTBOggfrUmqlBmzrGaGzYxj_C_WnO6s-nZ65b8RFuLLRpkNz6AigPRvJXKFQt_El5fer4wSn4h8VTSptluTPopGqOhW4L0-B81QLUrlPEfNTyMzU98ROVdm5QCnLF0hP_t-Bo9uIxaqwu_4sVQ-zcOP5l2bYyWgq_U0PQoaw66Pi8ozfTpua78UpCPV0iSfpsMr2YmUt5enAVhkG2hJHdXg7zgskjHYXT7uPwl7CesSwA" />
                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white">photo_camera</span>
                                </div>
                            </div>
                            <label class="block text-center mt-2 font-label-sm text-primary dark:text-primary-dark cursor-pointer">Change
                                Logo</label>
                        </div>
                        <div class="flex-1 space-y-stack-md">
                            <div>
                                <label class="block font-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-1">Team Name</label>
                                <input
                                    class="w-full px-4 py-3 bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark focus:ring-2 focus:ring-primary dark:focus:ring-primary-dark/10 transition-all outline-none text-body-lg"
                                    type="text" value="Design Systems Core" />
                            </div>
                            <div>
                                <label class="block font-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-1">Description</label>
                                <textarea
                                    class="w-full px-4 py-3 bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark focus:ring-2 focus:ring-primary dark:focus:ring-primary-dark/10 transition-all outline-none text-body-md"
                                    rows="3">Responsible for the global design tokens, shared components, and documentation across all Focus product lines.</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Member Management -->
            <section class="glass-card rounded-xl p-stack-lg shadow-sm">
                <div class="flex justify-between items-center mb-stack-lg">
                    <h3 class="font-headline-md text-headline-md">Manage Members</h3>
                    <button class="flex items-center gap-1 text-primary dark:text-primary-dark font-label-md">
                        <span class="material-symbols-outlined text-[18px]">person_add</span>
                        Invite New
                    </button>
                </div>
                <div class="divide-y divide-outline-variant dark:divide-outline-variant-dark">
                    <!-- Member Row 1 -->
                    <div class="py-4 flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-tertiary dark:bg-tertiary-dark-fixed dark:bg-tertiary dark:bg-tertiary-dark-fixed-dark overflow-hidden">
                                <img class="w-full h-full object-cover"
                                    data-alt="Close-up portrait of a female software engineer with glasses, looking at the camera with a slight smile, bright soft studio lighting, modern minimalist background, 8k resolution high-quality professional photography."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCRBiH2yImCp-3i_Z43B6H-XqG5GufFVZ4AhqP4XTljgzSuFGlT4mNvwOGV2TrZaC0d-OZdLpG9uMYIojw59pH-kqUNx--a7xQ1lxh_WRKPudxA_CqAaZeAuniYUL-iIkuB-nkKBK0LX4I8wftkH44_DKYaJ9Vr9mSkDHBZWheWQ0W9LAIh146TXzmMRDHCYNy_i39C05JNs16oe_ckuD6vprQx4nKbkmwm_-Nw3ksgIZTJ4m6Db2fwSg" />
                            </div>
                            <div>
                                <p class="font-label-md text-on-surface dark:text-on-surface-dark">Sarah Jenkins (You)</p>
                                <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">sarah.j@focus.app</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span
                                class="px-2 py-1 bg-primary dark:bg-primary-dark-container dark:bg-primary dark:bg-primary-dark-container-dark text-on-primary dark:text-on-primary-dark-container dark:text-on-primary dark:text-on-primary-dark-container-dark text-label-sm rounded uppercase tracking-wider">Owner</span>
                            <button
                                class="p-2 text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="material-symbols-outlined">lock</span>
                            </button>
                        </div>
                    </div>
                    <!-- Member Row 2 -->
                    <div class="py-4 flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-secondary dark:bg-secondary-dark-fixed dark:bg-secondary dark:bg-secondary-dark-fixed-dark overflow-hidden">
                                <img class="w-full h-full object-cover"
                                    data-alt="Portrait of a male product designer with a beard, wearing a casual black t-shirt, neutral indoor lighting, clean aesthetic, high-end professional corporate photography."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpVOh2LyUmYz05M2X-1qxvr4aS4259qpVAakd3-cTMLVgq6AeTemtxOn7pJ-CibYaZ_7Qj-xz38ZovE3suNluBmIyDyYIOHB9hwUNC2Mf-oTP8JFr74aqGm1_aTHG2tWx82EnfhepLqAOPFBo1G7bg9oJdTKYlMZEOISbOg6qUSAzuw8zrJxaHKjwRzZGP0-G02seKO69gpL__l4uVRz381cTzSdXgot3KGKfCgxMqtk9IkBUAT6lFTA" />
                            </div>
                            <div>
                                <p class="font-label-md text-on-surface dark:text-on-surface-dark">Marcus Chen</p>
                                <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">marcus.c@focus.app</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <select
                                class="bg-transparent border-none text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark focus:ring-0 cursor-pointer">
                                <option>Admin</option>
                                <option selected="">Member</option>
                                <option>Viewer</option>
                            </select>
                            <button
                                class="p-2 text-error dark:text-error-dark opacity-0 group-hover:opacity-100 transition-opacity hover:bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark rounded-full">
                                <span class="material-symbols-outlined">person_remove</span>
                            </button>
                        </div>
                    </div>
                    <!-- Member Row 3 -->
                    <div class="py-4 flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-surface dark:bg-surface-dark-container-highest overflow-hidden">
                                <img class="w-full h-full object-cover"
                                    data-alt="Portrait of a young creative professional woman with curly hair, vibrant modern office background, soft depth of field, high-end professional lighting and styling."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuASzbzbkhMdQ4mkM4DxA5AHia37RYT2Cbnjz4b-TTwBGDLBPnb3LKsRG9jsew2bxIYr-LbXLIk-hk5-noUtus9UgYS3F_G547U1vUgpAAdAMQrIYBbhCKr7dVcCFG7lp3mWtuAMGGDT7tCQixsniq0B5Rlo0w7aX8-kEgfWc45r9vSYggKE4hB5fgmyQ1VuS-i2APt6cT6T6W3MdLuXQdA7CLbcqdwlhE3MnFnC5Z62tcE9zCevKi9tYg" />
                            </div>
                            <div>
                                <p class="font-label-md text-on-surface dark:text-on-surface-dark">Elena Rodriguez</p>
                                <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">elena.r@focus.app</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <select
                                class="bg-transparent border-none text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark focus:ring-0 cursor-pointer">
                                <option>Admin</option>
                                <option>Member</option>
                                <option selected="">Viewer</option>
                            </select>
                            <button
                                class="p-2 text-error dark:text-error-dark opacity-0 group-hover:opacity-100 transition-opacity hover:bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark rounded-full">
                                <span class="material-symbols-outlined">person_remove</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Section: Permissions & Danger (Right 5 Columns) -->
        <div class="col-span-5 space-y-gutter-desktop">
            <!-- Global Permissions -->
            <section class="glass-card rounded-xl p-stack-lg shadow-sm">
                <h3 class="font-headline-md text-headline-md mb-stack-lg">Team Permissions</h3>
                <div class="space-y-stack-lg">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="font-label-md text-on-surface dark:text-on-surface-dark">Allow member invites</p>
                            <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Members can invite others without admin
                                approval.</p>
                        </div>
                        <input checked=""
                            class="w-5 h-5 rounded-full border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark text-primary dark:text-primary-dark focus:ring-primary dark:focus:ring-primary-dark"
                            type="checkbox" />
                    </div>
                    <div class="flex items-start justify-between gap-4 border-t border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark pt-4">
                        <div>
                            <p class="font-label-md text-on-surface dark:text-on-surface-dark">Project Creation</p>
                            <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Limit project creation to Admins only.</p>
                        </div>
                        <input class="w-5 h-5 rounded-full border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark text-primary dark:text-primary-dark focus:ring-primary dark:focus:ring-primary-dark"
                            type="checkbox" />
                    </div>
                    <div class="flex items-start justify-between gap-4 border-t border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark pt-4">
                        <div>
                            <p class="font-label-md text-on-surface dark:text-on-surface-dark">Visibility</p>
                            <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Make team discoverable by other teams.</p>
                        </div>
                        <input checked=""
                            class="w-5 h-5 rounded-full border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark text-primary dark:text-primary-dark focus:ring-primary dark:focus:ring-primary-dark"
                            type="checkbox" />
                    </div>
                </div>
            </section>
            <!-- Danger Zone -->
            <section class="border border-error dark:border-error-dark/20 bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark/10 rounded-xl p-stack-lg">
                <h3 class="font-label-md text-error dark:text-error-dark flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-[18px]">warning</span>
                    Danger Zone
                </h3>
                <p class="text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-stack-lg">Deleting a team is permanent. All associated
                    projects, tasks, and historical data will be removed immediately.</p>
                <button
                    class="w-full py-3 border border-error dark:border-error-dark text-error dark:text-error-dark font-label-md rounded-lg hover:bg-error dark:bg-error-dark hover:text-on-error dark:text-on-error-dark transition-all active:scale-[0.98]">
                    Delete Team
                </button>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Micro-interaction script for checkbox visual feedback -->
    <script>
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const parent = this.closest('div');
                if (this.checked) {
                    parent.querySelector('p:first-child').classList.add('text-primary dark:text-primary-dark');
                } else {
                    parent.querySelector('p:first-child').classList.remove('text-primary dark:text-primary-dark');
                }
            });
        });

        // Search bar focus effect
        const searchInput = document.querySelector('input[type="text"]');
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('scale-[1.02]');
            searchInput.parentElement.classList.add('shadow-md');
            searchInput.parentElement.style.transition = 'all 0.2s ease-out';
        });
        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('scale-[1.02]');
            searchInput.parentElement.classList.remove('shadow-md');
        });
    </script>
@endpush
