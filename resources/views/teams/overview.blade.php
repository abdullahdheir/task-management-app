@extends('layouts.app')

@section('title', 'Teams Overview')

@push('styles')
    <style>
        .active-nav-border {
            box-shadow: inset -4px 0 0 0 #3525cd;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(8px);
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-stack-lg gap-4">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface mb-1">Teams Overview</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Manage your collaborative workspaces and team
                members.</p>
        </div>
        <a href="{{ route('teams.create') }}"
            class="bg-primary text-on-primary px-6 py-3 rounded-lg flex items-center justify-center font-label-md text-label-md hover:opacity-90 transition-all shadow-md active:scale-95">
            <span class="material-symbols-outlined mr-2">add</span>
            Create New Team
        </a>
    </div>
    <!-- Stats Overview - Bento Grid Style -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter-desktop mb-stack-lg">
        <div
            class="md:col-span-1 bg-surface-container-lowest border border-outline-variant p-stack-lg rounded-xl flex flex-col justify-between">
            <span class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">Active Teams</span>
            <div class="mt-4">
                <span class="text-4xl font-bold text-on-surface">12</span>
                <div class="mt-2 text-secondary font-label-sm text-label-sm flex items-center">
                    <span class="material-symbols-outlined text-[16px] mr-1">trending_up</span>
                    +2 this month
                </div>
            </div>
        </div>
        <div
            class="md:col-span-1 bg-surface-container-lowest border border-outline-variant p-stack-lg rounded-xl flex flex-col justify-between">
            <span class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">Total Members</span>
            <div class="mt-4">
                <span class="text-4xl font-bold text-on-surface">84</span>
                <div class="mt-2 text-on-surface-variant font-label-sm text-label-sm">Across all workspaces</div>
            </div>
        </div>
        <div class="md:col-span-2 bg-primary text-on-primary p-stack-lg rounded-xl relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="font-headline-md text-headline-md mb-2">Upgrade to Pro</h3>
                <p class="font-body-md text-body-md opacity-90 max-w-xs">Get advanced permissions, unlimited teams, and
                    custom domain integrations.</p>
                <button class="mt-4 bg-white text-primary px-4 py-2 rounded-lg font-label-md text-label-md">Learn
                    More</button>
            </div>
            <div class="absolute right-[-20px] bottom-[-20px] opacity-10">
                <span class="material-symbols-outlined text-[120px]">rocket_launch</span>
            </div>
        </div>
    </div>
    <!-- Teams Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter-desktop">
        <!-- Team Card 1 -->
        <div
            class="bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg flex flex-col hover:shadow-lg transition-all group">
            <div class="flex justify-between items-start mb-4">
                <div
                    class="w-12 h-12 rounded-lg bg-emerald-50 flex items-center justify-center text-secondary border border-secondary-container">
                    <span class="material-symbols-outlined"
                        style="font-variation-settings: 'FILL' 1;">design_services</span>
                </div>
                <button class="text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">more_vert</span>
                </button>
            </div>
            <h4 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors">Design
                Systems</h4>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2 mb-6 line-clamp-2">Maintaining the global UI
                kit and component library for the core Focus product suite.</p>
            <div class="mt-auto">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex -space-x-3 overflow-hidden">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                            data-alt="Close-up portrait of a cheerful diverse professional woman in a modern minimalist workspace with natural lighting. The image captures a clean, corporate-modern aesthetic with a focus on human connectivity and productivity."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7MYk0M6Pu9U7Eb-ibqzHVBAoopYfeBBgrs-TldLITd7c3dJRVDyy4bDMjxdxki_U7xjOTpv-OuH0gVDvAyIj9v7SCHbkbt-60pRzusXatcLs1PIl1oYx9RMdprC-Wo4l3qCssKb6wA9AWyq296ZwdKcecH4X3J9Uq3iwTvDNpJFgp3rxE7pYzDpIERQxxac0Q7UwpKalHdmopCKaH1Nn27S_Lw639h4hWD5d266e3wi1mqUGCDZv6zQ" />
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                            data-alt="Professional studio portrait of a young male designer in a navy blue sweater, looking at the camera with a confident smile. Soft edge lighting against a neutral light grey background, emphasizing a high-end utilitarian brand identity."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuA72oKbYgXpcK42brG7hDGjFKB3jHvgGdkf8OXWnz3AMRoB4E49mtFxW0sAAuAJdd5YCOzSMFmVC6yeSNrjjGMqmW-wUCNSzWHX4BJ1pQjaQ_RT6pqVtku0fj23erXYR-JD4SgXLguYjVZZTrkjuBN458wEwFmr5898deJ-dEkASHl8EMeQay4cJ0FfoI9ndFcm1W0R0PMKdjmf6wsch6dAlWEj_IA6b68zScDrnQCpi8Ym49U0xyL69A" />
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                            data-alt="Portrait of an experienced middle-aged manager in a bright, airy office environment. High-key lighting and minimalist furniture in the blurred background. Clean, professional focus and sophisticated styling."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBwpiyRXbnTc6BZZdr_IuUQD4iTiJlJNIw4l4kZKJdaDPZkPVpnSjsv121UUUWDrddn_3PBEyoOeNm4ZERFMiH2zJh3UJ28KpwlVsjUOi9smH4FXflpm2a5zglgXWwOUQhIZl1-NyPWqu6-s5K3U-TmIck_FOFO2CQWG-cZGp7Hxcs_vhge4PjRFSAY_dJiwX3I1NAR5bUiJ4Un-ORa-wOpV-iC9vnE-TXoOOjOEAaOjyYiyM3TNg33tw" />
                        <div
                            class="flex items-center justify-center h-8 w-8 rounded-full bg-surface-container-high ring-2 ring-white text-[10px] font-bold text-on-surface-variant">
                            +5</div>
                    </div>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">8 members</span>
                </div>
                <button
                    class="w-full py-2.5 rounded-lg border border-primary text-primary font-label-md text-label-md hover:bg-primary hover:text-on-primary transition-all">View
                    Team</button>
            </div>
        </div>
        <!-- Team Card 2 -->
        <div
            class="bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg flex flex-col hover:shadow-lg transition-all group">
            <div class="flex justify-between items-start mb-4">
                <div
                    class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center text-primary border border-primary-container">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">code</span>
                </div>
                <button class="text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">more_vert</span>
                </button>
            </div>
            <h4 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors">
                Frontend Core</h4>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2 mb-6 line-clamp-2">Building high-performance
                React architectures and ensuring pixel-perfect implementation of designs.</p>
            <div class="mt-auto">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex -space-x-3 overflow-hidden">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                            data-alt="A portrait of a focused engineer wearing glasses in a sleek, modern office. The lighting is clean and cool-toned, echoing a sense of controlled productivity and mental clarity. High-quality digital photography with shallow depth of field."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCEIs4SgxzUXV1j2AJ03ab-qJ9WYx3VCz6w4RFE9eVPinB8i4GXFMYqDp-NbXYEzo9bEQHW0hFyx9BnLQm-NHPgrHRHciBkCrCYAtQtHy68lyPhde4ryyzioe5fOsA4WVLrJ9-IsOt8Itz6bG2KnyR886yyCyAKtZvJkHA3PVb_Z1kRk2JViMVgNA5WhO9KlLpYnxjI9RbkhvtOerfnc2_Vxmy3JXDHqZW2DSLmxYihi2u494guOzlK3Q" />
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                            data-alt="A portrait of a smiling woman with headphones around her neck, sitting in a bright workspace with indoor plants. The atmosphere is calm and professional, with a light gray color palette and warm wood accents."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBtKwHrx6XEGNBDwLgZ6CLj375HAVRCzUS4zyKdNlP1OGDbMXg_FdkcV8RQfKPAh_a27nShx-szuP4C_OvvYerLiUbwKGxsxDR4FuogHeiHqzOF5GgPhO6iOWEstJyIllbpR6w_e7JUrTUGpAjCI6MdZue-YTdl0ixDCeuYTnXwTuABOFRr_RtVBfm-S_00LtmSRLeLdL7ceuTkSDLQ_Cl7LTiHi_Vy7sCq2YxEMkosNAeAU6FVq39eRQ" />
                        <div
                            class="flex items-center justify-center h-8 w-8 rounded-full bg-surface-container-high ring-2 ring-white text-[10px] font-bold text-on-surface-variant">
                            +12</div>
                    </div>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">14 members</span>
                </div>
                <button
                    class="w-full py-2.5 rounded-lg border border-primary text-primary font-label-md text-label-md hover:bg-primary hover:text-on-primary transition-all">View
                    Team</button>
            </div>
        </div>
        <!-- Team Card 3 -->
        <div
            class="bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg flex flex-col hover:shadow-lg transition-all group">
            <div class="flex justify-between items-start mb-4">
                <div
                    class="w-12 h-12 rounded-lg bg-orange-50 flex items-center justify-center text-tertiary border border-tertiary-container">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">campaign</span>
                </div>
                <button class="text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">more_vert</span>
                </button>
            </div>
            <h4 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors">Product
                Marketing</h4>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2 mb-6 line-clamp-2">Strategizing product
                launches and driving user adoption through data-driven campaigns.</p>
            <div class="mt-auto">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex -space-x-3 overflow-hidden">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                            data-alt="A portrait of an energetic marketing lead in a vibrant but professional collaborative space. The setting is bright and airy with high-key lighting, maintaining the clean light-mode aesthetic of the Focus productivity brand."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJlxaYlnoYWhvkiJf2SdBjXwWxNzperRZXipcFleErtttDMVJNc9Oosmwt_tNeL1JB1oJmfN10IcJ9DyQ_nRIMTUWpepEiaWAbJrDV_3D1xAz1Z2JH2lIDgqwt2xmWUCWwB2hMq3XoGlmh7qLHtFIGqTSqn3CjiwC_kYJvKUw8RrgD4ATkeJpgOODGQtw1gGw5SsDR9Bjg5b7jiL8fBiMcgghxCA45GF6k5__nxaFb5z1POWDwgJnWFA" />
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                            data-alt="Close up of a creative director in a minimal studio setting. Soft lighting emphasizes professional clarity. The color palette consists of neutral whites and grays with subtle Indigo accents to align with corporate identity."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBZvC0lUUyYlyNMleXERX85cgmvN_4sqcUlGiWi5uIB04dlq8YPIFkrOxLXZu_W_LoNisw0GLrYclloJucnAX165ukFViQCkMBOvkmtmbPu959sto-gVi8vgYY_OcAbWJ87SpvroGMx2E7FBgQr3aexNkaPaIhxgcYw1FAvfhT2dKrY5kNsxnZFz9jRL-LHsfTI3EOH-DljfscrbHl1jB4DEXXhx9C9Air8GL5EW13Z2caldwZg_KStJw" />
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                            data-alt="A portrait of a young professional in a light-filled modern office environment. Clear, crisp digital photography that evokes a sense of efficiency and professional poise in a high-growth tech environment."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCMXZu05G873tX1enNwylb7lkdlP6D7VxAFvgSa0Pa8CwCCU3dN0nIe29G_3vIMzyiapXSaRIKNUOzMj5RFGWYRmqiJ6YtzDy1VPnOqCdlTtu0AOMPlm3Gvar-1ZPofgsPsgC2c-0OA9S6ispZhr2Ji0d_P2_PfeyfeB-9HoM2sTZueYewAdcjhxOHJFBpL6bmB-G9Tatqr8wGjDm73AZtFjiz8OFXCX2IRIlhthNfsZWo63NsYIhqpJg" />
                        <div
                            class="flex items-center justify-center h-8 w-8 rounded-full bg-surface-container-high ring-2 ring-white text-[10px] font-bold text-on-surface-variant">
                            +2</div>
                    </div>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">5 members</span>
                </div>
                <button
                    class="w-full py-2.5 rounded-lg border border-primary text-primary font-label-md text-label-md hover:bg-primary hover:text-on-primary transition-all">View
                    Team</button>
            </div>
        </div>
        <!-- Team Card 4 -->
        <div
            class="bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg flex flex-col hover:shadow-lg transition-all group">
            <div class="flex justify-between items-start mb-4">
                <div
                    class="w-12 h-12 rounded-lg bg-purple-50 flex items-center justify-center text-primary-container border border-primary-container">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">monitoring</span>
                </div>
                <button class="text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">more_vert</span>
                </button>
            </div>
            <h4 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors">Data
                &amp; Analytics</h4>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2 mb-6 line-clamp-2">Translating user behavior
                into actionable insights and maintaining our internal metrics dashboards.</p>
            <div class="mt-auto">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex -space-x-3 overflow-hidden">
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                            data-alt="Portrait of a data scientist in a modern tech workspace. High-quality lighting highlights the professional environment. The visual style is minimal and corporate, utilizing a white and light blue color palette to suggest clarity and data precision."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDAX4KbmegQueALF5jvpW98c7UJSjWztqi4nBsYFBzf5y5dA-_09MBkIaEAht8TR81Qi2DAa9vdVsVN3OY8mMpwTssxxf3KEVmXf3Cj1BLTiYmqoS4Bp57CnV2Y1PaeKrq--Hzyx2B36sl36uRcVcCa9v41rVbZTAsYbx3llEQOFjpe5wtHYdU3_w3CdS8P3o7Ue5---QiOQtVn5vT_Y6KMk5CxIrtGoOvMrpe1f3khVtgYhcMDK3MsDw" />
                        <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                            data-alt="A smiling analyst in a bright contemporary office. The composition is clean with plenty of white space, reflecting the Focus brand's goal of alleviating cognitive load for its users through minimalist UI."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCU-TbvVYBHD0wGk0fqQp0ZtQw95Y7TBl8_pmFuuKCoSs9vA8WnLj1v1hLG3r5c_tE5LYLcBEhpB-vGtQCpCFbF4jrrZnEaUbdTqbhqsjZqTkRCAdm056n_0qUdsa7N9_QYoO39ZS511UEXrx8Xr0X1bj9UEcQSFO6A27y2ddw1-08DeNGBbbjTA_DMuOLNORHIMtyjGMBocQk4pacpyjA3wtvzY_KBeh5pulUwX6kY43_Eppzz60_dgg" />
                        <div
                            class="flex items-center justify-center h-8 w-8 rounded-full bg-surface-container-high ring-2 ring-white text-[10px] font-bold text-on-surface-variant">
                            +1</div>
                    </div>
                    <span class="font-label-sm text-label-sm text-on-surface-variant">3 members</span>
                </div>
                <button
                    class="w-full py-2.5 rounded-lg border border-primary text-primary font-label-md text-label-md hover:bg-primary hover:text-on-primary transition-all">View
                    Team</button>
            </div>
        </div>
        <!-- New Team Empty State / CTA -->
        <div
            class="border-2 border-dashed border-outline-variant rounded-xl p-stack-lg flex flex-col items-center justify-center text-center group cursor-pointer hover:border-primary transition-all bg-surface-container-lowest/50">
            <div
                class="w-16 h-16 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant group-hover:bg-primary-container group-hover:text-on-primary transition-all mb-4">
                <span class="material-symbols-outlined text-[32px]">add_circle</span>
            </div>
            <h4 class="font-headline-md text-headline-md text-on-surface">Start a New Team</h4>
            <p class="font-body-md text-body-md text-on-surface-variant mt-2 max-w-[200px]">Invite collaborators and launch
                your next project.</p>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Simple micro-interaction for cards
        document.querySelectorAll('.group').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-4px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });
    </script>
@endpush
