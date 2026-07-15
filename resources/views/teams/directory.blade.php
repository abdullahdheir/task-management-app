@extends('layouts.app')

@section('title', 'Team Directory')

@push('styles')
    <style>
        .active-nav-border {
            position: relative;
        }

        .active-nav-border::after {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: currentColor;
        }
    </style>
@endpush

@section('content')
    <div class="space-y-stack-lg">
        <!-- Page Header Area -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav
                    class="flex items-center gap-2 mb-2 text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm text-label-sm uppercase tracking-widest">
                    <span>Teams</span>
                    <span class="material-symbols-outlined text-xs">chevron_right</span>
                    <span class="text-primary dark:text-primary-dark font-bold">Product Design</span>
                </nav>
                <h2 class="font-headline-lg text-headline-lg text-on-surface dark:text-on-surface-dark">Team Directory</h2>
                <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-body-md text-body-md mt-1">Manage permissions and view status for 24
                    team
                    members.</p>
            </div>
            <div class="flex gap-stack-md">
                <div class="flex flex-wrap items-center gap-2">
                    <div class="relative">
                        <select
                            class="appearance-none bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg px-4 py-2 pr-10 font-label-md text-label-md text-on-surface dark:text-on-surface-dark focus:ring-2 focus:ring-primary dark:focus:ring-primary-dark outline-none cursor-pointer">
                            <option>All Roles</option>
                            <option>Admin</option>
                            <option>Member</option>
                            <option>Guest</option>
                        </select>
                        <span
                            class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">expand_more</span>
                    </div>
                    <div class="relative">
                        <select
                            class="appearance-none bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg px-4 py-2 pr-10 font-label-md text-label-md text-on-surface dark:text-on-surface-dark focus:ring-2 focus:ring-primary dark:focus:ring-primary-dark outline-none cursor-pointer">
                            <option>All Departments</option>
                            <option>Product Design</option>
                            <option>Engineering</option>
                            <option>Marketing</option>
                        </select>
                        <span
                            class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">expand_more</span>
                    </div>
                    <div class="relative">
                        <select
                            class="appearance-none bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg px-4 py-2 pr-10 font-label-md text-label-md text-on-surface dark:text-on-surface-dark focus:ring-2 focus:ring-primary dark:focus:ring-primary-dark outline-none cursor-pointer">
                            <option>All Statuses</option>
                            <option>Active</option>
                            <option>OOO</option>
                            <option>Offline</option>
                        </select>
                        <span
                            class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">expand_more</span>
                    </div>
                </div>
                <button
                    class="flex items-center px-4 py-2 bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark rounded-lg font-label-md text-label-md font-bold hover:shadow-lg transition-all"
                    onclick="document.getElementById('invite-modal').classList.remove('hidden')">
                    <span class="material-symbols-outlined mr-2 text-[20px]">person_add</span>
                    Invite Member
                </button>
            </div>
        </div>
        <!-- Members Bento Grid / List Hybrid -->
        <div class="bg-surface dark:bg-surface-dark-container-lowest border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-xl overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface dark:bg-surface-dark-container-low border-b border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
                        <th class="px-6 py-4 font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase tracking-wider">
                            Member</th>
                        <th class="px-6 py-4 font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase tracking-wider">
                            Role
                        </th>
                        <th class="px-6 py-4 font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase tracking-wider">
                            Department</th>
                        <th class="px-6 py-4 font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase tracking-wider">
                            Status</th>
                        <th
                            class="px-6 py-4 font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase tracking-wider text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant dark:divide-outline-variant-dark">
                    <!-- Member Row 1 -->
                    <tr class="hover:bg-surface dark:bg-surface-dark-container transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden bg-surface dark:bg-surface-dark-variant">
                                    <img class="w-full h-full object-cover"
                                        data-alt="A high-resolution headshot of a female software developer with a friendly expression. She is wearing a modern casual blazer, and the setting is a brightly lit, minimalist co-working space. The color palette is composed of soft neutrals, whites, and subtle primary blue accents, maintaining a professional yet approachable corporate vibe."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuACRtjHZKKs6rzuOOc2QBeWhn_FTJGUmXY_St52uBzhqhFLt-cRNmuv23QyPBQi6Tl2bncOnxDGuUoVP46dyVmTt4aqkmuJA1l0YLxqGAdyXdeku6nFQ0jod1-xNa0Z3j5E049uhYXytr8IiD1HooBRfv6vz4T7K_gjVYPowYFIfzwh-3w5Z1RnX7Dh1KSGCVg4zztRYLtf2nx5JEKLsu2KntKiIiOhG6nW3grfiE6eoGiCeCTkxDKGQQ" />
                                </div>
                                <div>
                                    <div class="font-label-md text-body-lg font-semibold text-on-surface dark:text-on-surface-dark">Elena Rodriguez
                                    </div>
                                    <div class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm text-label-sm">elena.r@focusapp.io
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded bg-primary dark:bg-primary-dark-container dark:bg-primary dark:bg-primary-dark-container-dark text-on-primary dark:text-on-primary-dark-container dark:text-on-primary dark:text-on-primary-dark-container-dark font-label-sm text-label-sm font-bold">Admin</span>
                        </td>
                        <td class="px-6 py-4 font-body-md text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Product Design</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-secondary dark:bg-secondary-dark"></span>
                                <span class="font-label-md text-label-md text-secondary dark:text-secondary-dark">Active</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="p-2 hover:bg-surface dark:bg-surface-dark-container-high rounded-full transition-colors">
                                <span class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">more_vert</span>
                            </button>
                        </td>
                    </tr>
                    <!-- Member Row 2 -->
                    <tr class="hover:bg-surface dark:bg-surface-dark-container transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden bg-surface dark:bg-surface-dark-variant">
                                    <img class="w-full h-full object-cover"
                                        data-alt="A professional portrait of a male data scientist in a modern tech office. He has a focused and calm demeanor. The lighting is crisp, highlighting the clean textures of his attire. The background features blurred glass partitions and minimalist furniture in shades of light gray and cool indigo, conveying a state-of-the-art corporate environment."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDL3AeuOWFXgtbkPfaG_MTFnRBdjO9Y6ahbIIpHnMB_ppZMrm-KnbjUsCTjZzAF3Ei5RpxjAr2WHuT7QSVn1cbtt9bR5sl2tzaOze9R81lefNmW1kTxXakhQ6EtxeorkeHLr11y3oKWb_11DanwObeQNd2EGRyVUu3muL79HeiGMfZDi0xVfKjKbKDdO2cK67CHTXfNnqY3UNkoaDkaJTfAGDIXYxveQwvNdul0thfUHBZgyei1OtcZng" />
                                </div>
                                <div>
                                    <div class="font-label-md text-body-lg font-semibold text-on-surface dark:text-on-surface-dark">Marcus Chen</div>
                                    <div class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm text-label-sm">marcus.c@focusapp.io
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded bg-surface dark:bg-surface-dark-container-high text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm text-label-sm font-bold">Member</span>
                        </td>
                        <td class="px-6 py-4 font-body-md text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Engineering</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-tertiary dark:bg-tertiary-dark"></span>
                                <span class="font-label-md text-label-md text-tertiary dark:text-tertiary-dark">OOO (Returning Mon)</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="p-2 hover:bg-surface dark:bg-surface-dark-container-high rounded-full transition-colors">
                                <span class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">more_vert</span>
                            </button>
                        </td>
                    </tr>
                    <!-- Member Row 3 -->
                    <tr class="hover:bg-surface dark:bg-surface-dark-container transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden bg-surface dark:bg-surface-dark-variant">
                                    <img class="w-full h-full object-cover"
                                        data-alt="A portrait of a creative lead with a modern aesthetic, characterized by soft natural lighting and a shallow depth of field. The person has a warm, inviting smile. The environment is a spacious, plant-filled office with minimalist white walls and elegant furniture. The colors are dominated by soft greens, whites, and light grays, reflecting a calm and productive atmosphere."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCR6AS4Ey4i-DjeVhvxycdd2Ph7jrqnKpjAa9P-VlfPJGzSf_ml7qWLJs7Vqzdstp37TumUPN1l3KaEK9zLDr4df6HL-5dpZj0mnXaidgkwNTP2qnruKX1yDYPaCMo1qDUllXUGQtFJQ1gXwf22TG6Qd8RLhZozuVTH7YyLjjZ_U49Gpfi1FpyWXJvZcZ9BUDKv0QVXeuPRgrcG27uboeFHHh5iCZaXtZIbNoxfC3I2XHlqvx_Pp9n2Dw" />
                                </div>
                                <div>
                                    <div class="font-label-md text-body-lg font-semibold text-on-surface dark:text-on-surface-dark">Sarah Jenkins
                                    </div>
                                    <div class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm text-label-sm">sarah.j@focusapp.io
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded bg-surface dark:bg-surface-dark-container-high text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm text-label-sm font-bold">Member</span>
                        </td>
                        <td class="px-6 py-4 font-body-md text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Product Design</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-secondary dark:bg-secondary-dark"></span>
                                <span class="font-label-md text-label-md text-secondary dark:text-secondary-dark">Active</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="p-2 hover:bg-surface dark:bg-surface-dark-container-high rounded-full transition-colors">
                                <span class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">more_vert</span>
                            </button>
                        </td>
                    </tr>
                    <!-- Member Row 4 -->
                    <tr class="hover:bg-surface dark:bg-surface-dark-container transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden bg-surface dark:bg-surface-dark-variant">
                                    <img class="w-full h-full object-cover"
                                        data-alt="A clean, professional headshot of a junior designer in a bright, airy office space. The person wears a simple, high-quality white t-shirt and has a neutral, focused expression. The background is a clean white wall with a hint of a modern art piece. The lighting is soft and flat, emphasizing the clean, minimalist light-mode aesthetic of the application's brand identity."
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAW_PCPam95EurXD1fkUQveBmX1M1FUt9jtHi2FaFZPt-iJcCbxY_hI7CZ3LyjWt3xICDRuoRwMW22QnayIWPvpFpBRNRN0_D9EncgajHD5dXowyDFAZUWfqOP_EqHVH4NtktNWoNW8g9Gyhmbbwbp8aKxNODj6vPKXPPt4ZXIC_S4rOMWCURGEZt5teMbcLM6UUDrXzlZq9S092-s2ERSr3rbRcNVr4hRDuOPC67q73OIloo9mRuyW6A" />
                                </div>
                                <div>
                                    <div class="font-label-md text-body-lg font-semibold text-on-surface dark:text-on-surface-dark">Leo Kostic</div>
                                    <div class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-sm text-label-sm">leo.k@contractor.io
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark text-on-error dark:text-on-error-dark-container dark:text-on-error dark:text-on-error-dark-container-dark font-label-sm text-label-sm font-bold">Guest</span>
                        </td>
                        <td class="px-6 py-4 font-body-md text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Contractor</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-outline"></span>
                                <span class="font-label-md text-label-md text-outline dark:text-outline-dark">Offline</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="p-2 hover:bg-surface dark:bg-surface-dark-container-high rounded-full transition-colors">
                                <span class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">more_vert</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Table Footer / Pagination -->
            <div class="p-4 bg-surface dark:bg-surface-dark-container-low border-t border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark flex items-center justify-between">
                <span class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Showing 4 of 24 members</span>
                <div class="flex gap-2">
                    <button
                        class="p-2 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark hover:bg-surface dark:bg-surface-dark-container-high transition-colors disabled:opacity-50"
                        disabled="">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button
                        class="p-2 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark hover:bg-surface dark:bg-surface-dark-container-high transition-colors">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Summary Cards (Bento Style) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-stack-lg">
            <div class="p-6 bg-primary dark:bg-primary-dark-container dark:bg-primary dark:bg-primary-dark-container-dark/10 border border-primary dark:border-primary-dark/20 rounded-xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-label-md text-label-md font-bold text-primary dark:text-primary-dark uppercase">Active Capacity</h3>
                    <span class="material-symbols-outlined text-primary dark:text-primary-dark">bolt</span>
                </div>
                <div class="text-3xl font-headline-lg text-on-primary dark:text-on-primary-dark-fixed dark:text-on-primary dark:text-on-primary-dark-fixed-dark-variant">88%</div>
                <div class="mt-2 w-full bg-surface dark:bg-surface-dark-container-high h-1.5 rounded-full overflow-hidden">
                    <div class="bg-primary dark:bg-primary-dark h-full" style="width: 88%"></div>
                </div>
                <p class="mt-3 font-label-sm text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">21 members currently active in
                    workspace.
                </p>
            </div>
            <div class="p-6 bg-surface dark:bg-surface-dark-container-lowest border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-label-md text-label-md font-bold text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase">Role Breakdown</h3>
                    <span class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">pie_chart</span>
                </div>
                <div class="flex items-end gap-2 h-12">
                    <div class="flex-1 bg-primary dark:bg-primary-dark rounded-t-sm" style="height: 100%"></div>
                    <div class="flex-1 bg-primary dark:bg-primary-dark/60 rounded-t-sm" style="height: 60%"></div>
                    <div class="flex-1 bg-primary dark:bg-primary-dark/30 rounded-t-sm" style="height: 20%"></div>
                </div>
                <div class="mt-3 flex justify-between font-label-sm text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">
                    <span>Admin (4)</span>
                    <span>Member (18)</span>
                    <span>Guest (2)</span>
                </div>
            </div>
            <div class="p-6 bg-surface dark:bg-surface-dark-container-lowest border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-label-md text-label-md font-bold text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase">Recent Invites</h3>
                    <span class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">mail</span>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="font-body-md text-body-md text-on-surface dark:text-on-surface-dark">j.doe@company.com</span>
                        <span class="font-label-sm text-label-sm text-tertiary dark:text-tertiary-dark">Pending</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-body-md text-body-md text-on-surface dark:text-on-surface-dark">m.smith@company.com</span>
                        <span class="font-label-sm text-label-sm text-secondary dark:text-secondary-dark">Joined</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden fixed inset-0 z-50 flex items-center justify-center bg-on-background/40 backdrop-blur-sm"
        id="invite-modal">
        <div
            class="bg-surface dark:bg-surface-dark-container-lowest w-full max-w-md rounded-xl shadow-lg overflow-hidden border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
            <div class="p-6 border-b border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark flex justify-between items-center">
                <h3 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark">Invite Team Member</h3>
                <button class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark hover:text-on-surface dark:hover:text-on-surface-dark dark:text-on-surface-dark"
                    onclick="document.getElementById('invite-modal').classList.add('hidden')">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div class="space-y-1">
                    <label class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Email Address</label>
                    <input
                        class="w-full px-4 py-2 bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg focus:ring-2 focus:ring-primary dark:focus:ring-primary-dark focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark outline-none font-body-md text-body-md"
                        placeholder="e.g. name@company.com" type="email" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Role</label>
                        <select
                            class="w-full px-4 py-2 bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg focus:ring-2 focus:ring-primary dark:focus:ring-primary-dark outline-none font-body-md text-body-md">
                            <option>Admin</option>
                            <option>Member</option>
                            <option>Viewer</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Department</label>
                        <select
                            class="w-full px-4 py-2 bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg focus:ring-2 focus:ring-primary dark:focus:ring-primary-dark outline-none font-body-md text-body-md">
                            <option>Product Design</option>
                            <option>Engineering</option>
                            <option>Marketing</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-surface dark:bg-surface-dark-container-low flex justify-end gap-3">
                <button
                    class="px-4 py-2 text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-md text-label-md font-bold hover:bg-surface dark:bg-surface-dark-container-high rounded-lg transition-colors"
                    onclick="document.getElementById('invite-modal').classList.add('hidden')">Cancel</button>
                <button
                    class="px-6 py-2 bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark font-label-md text-label-md font-bold rounded-lg shadow-md hover:opacity-90 transition-opacity">Send
                    Invite</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Simple micro-interaction for row hovering effects or search simulation
        document.querySelectorAll('tr').forEach(row => {
            row.addEventListener('click', () => {
                // Future navigation logic could go here
                console.log('Navigating to member detail...');
            });
        });

        // Search bar interaction
        const searchInput = document.querySelector('input[type="text"]');
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    </script>
@endpush
