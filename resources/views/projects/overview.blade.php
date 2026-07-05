@extends('layouts.app')

@section('title', 'Projects Overview')

@section('content')
    <!-- Canvas Area -->
    <section class="flex-1 overflow-y-auto p-gutter-desktop custom-scrollbar bg-surface">
        <div class="max-w-container-max mx-auto">
            <!-- Header Actions -->
            <div class="flex justify-between items-end mb-stack-lg">
                <div>
                    <h2 class="text-headline-lg font-headline-lg text-on-surface mb-2">Projects Overview</h2>
                    <p class="text-body-md text-on-surface-variant">Manage your team's initiatives and track
                        real-time progress.</p>
                </div>
                <div class="flex gap-stack-md">
                    <button
                        class="px-4 py-2 border border-outline-variant text-on-surface-variant rounded-lg font-label-md hover:bg-surface-container-low transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">filter_list</span>
                        Filter
                    </button>
                    <button
                        class="px-4 py-2 bg-primary text-white rounded-lg font-label-md shadow-lg shadow-primary/20 flex items-center gap-2 active:scale-95 transition-transform">
                        <span class="material-symbols-outlined text-[18px]">add_circle</span>
                        New Project
                    </button>
                </div>
            </div>
            <!-- Stats Overview Bento -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter-desktop mb-stack-lg">
                <div class="p-6 glass-card rounded-xl shadow-sm col-span-1 border-l-4 border-primary">
                    <p class="text-label-sm text-on-surface-variant uppercase font-bold tracking-widest mb-1">Total
                        Active</p>
                    <h3 class="text-headline-lg font-headline-lg text-primary">12</h3>
                    <div
                        class="mt-4 flex items-center gap-2 text-on-secondary-container bg-secondary-container/30 px-2 py-0.5 rounded-full w-fit">
                        <span class="material-symbols-outlined text-xs">trending_up</span>
                        <span class="text-label-sm">+2 this month</span>
                    </div>
                </div>
                <div class="p-6 glass-card rounded-xl shadow-sm col-span-1 border-l-4 border-secondary">
                    <p class="text-label-sm text-on-surface-variant uppercase font-bold tracking-widest mb-1">
                        Completed</p>
                    <h3 class="text-headline-lg font-headline-lg text-secondary">48</h3>
                    <div
                        class="mt-4 flex items-center gap-2 text-on-surface-variant bg-surface-container-highest px-2 py-0.5 rounded-full w-fit">
                        <span class="material-symbols-outlined text-xs">done_all</span>
                        <span class="text-label-sm">85% success rate</span>
                    </div>
                </div>
                <div class="p-6 glass-card rounded-xl shadow-sm col-span-1 border-l-4 border-tertiary-container">
                    <p class="text-label-sm text-on-surface-variant uppercase font-bold tracking-widest mb-1">
                        Average Velocity</p>
                    <h3 class="text-headline-lg font-headline-lg text-tertiary-container">92%</h3>
                    <div class="mt-4 w-full bg-surface-container h-1 rounded-full overflow-hidden">
                        <div class="h-full bg-tertiary-container" style="width: 92%"></div>
                    </div>
                </div>
                <div class="p-6 glass-card rounded-xl shadow-sm col-span-1 bg-primary text-white overflow-hidden relative">
                    <div class="relative z-10">
                        <p class="text-label-sm opacity-80 uppercase font-bold tracking-widest mb-1">System Load</p>
                        <h3 class="text-headline-lg font-headline-lg">Optimal</h3>
                        <p class="text-body-md mt-4 opacity-90">All 8 server nodes are operating at peak
                            efficiency.</p>
                    </div>
                    <span
                        class="material-symbols-outlined absolute -right-4 -bottom-4 text-[100px] opacity-10">cloud_done</span>
                </div>
            </div>
            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter-desktop">
                <!-- Project Card 1: Active -->
                <div
                    class="group bg-white rounded-xl border border-outline-variant hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-stack-lg flex flex-col h-full">
                    <div class="flex justify-between items-start mb-stack-md">
                        <div class="p-2 bg-secondary-container/20 rounded-lg text-secondary">
                            <span class="material-symbols-outlined">auto_graph</span>
                        </div>
                        <span
                            class="px-2 py-1 bg-secondary-container text-on-secondary-fixed-variant font-label-md text-label-sm rounded-md">Active</span>
                    </div>
                    <h4
                        class="text-headline-md font-headline-md text-on-surface mb-2 group-hover:text-primary transition-colors">
                        Q4 Market Expansion</h4>
                    <p class="text-body-md text-on-surface-variant mb-6 flex-1">Expanding our core service reach
                        into the EMEA region with localized assets and dedicated support teams.</p>
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-label-md font-label-md text-on-surface-variant">Progress</span>
                            <span class="text-label-md font-bold text-secondary">64%</span>
                        </div>
                        <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                            <div class="h-full bg-secondary transition-all duration-1000" style="width: 64%">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-stack-md border-t border-outline-variant/30">
                        <div class="flex -space-x-2">
                            <img class="w-8 h-8 rounded-full border-2 border-white object-cover"
                                data-alt="Close-up portrait of a diverse female manager with glasses, high-end professional lighting, minimalist office background, calm and authoritative mood, part of a cohesive corporate photography set."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4wmVZpzUyMo0BUd6DebQyqcuhQB1IekWHjgxGl6BRJgOZZGn8Qt-PfKcODA9ATQXglfv0voyd-kzo-qOH5vl8szS0uAnl14TKfTXM4I8UvYbPvxSUIomp67zmmJ7t9ymUxXYgtsY9tMxaCOoQDmHx7VO5izH_v7KiynLo7iwdmjUY37jko8mU998CvMbarOQTEeIbRCbf_Dh4NcjQnQOrzXiWBqetUKgXFqDpeEzoFdTKrqJuYYBXBA" />
                            <img class="w-8 h-8 rounded-full border-2 border-white object-cover"
                                data-alt="Portrait of a creative professional male with a short beard, wearing a modern charcoal sweater, soft window light, blurred studio background, professional and approachable, consistent with a clean UI aesthetic."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDIkGvolUiKpFzSE9gqxMydhT-1lzZXFW9vZLfpvBP7gr1w6ZojuQGO4ro2y-XlQYTz0LQ8Du4vQsRYWWui4wlDim38vCbRvvMHCxEtloc_qS1YY8cm5-O99JFNgpQYIdNvytgnBA9QH-FKqKf0F47nObNBRZFBiOWMseHaPAUJTFZph8w0Q2Y7Dgv0TvfBllup_tvy8GzbZ-vGz3Ke97wB0_0krpzzX3qQl3mEx86xUYa_4FflhwjTzw" />
                            <div
                                class="w-8 h-8 rounded-full border-2 border-white bg-surface-container-highest flex items-center justify-center text-[10px] font-bold">
                                +4</div>
                        </div>
                        <span class="text-label-sm text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">schedule</span>
                            12d left
                        </span>
                    </div>
                </div>
                <!-- Project Card 2: On Hold -->
                <div
                    class="group bg-white rounded-xl border border-outline-variant hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-stack-lg flex flex-col h-full">
                    <div class="flex justify-between items-start mb-stack-md">
                        <div class="p-2 bg-tertiary-container/10 rounded-lg text-tertiary">
                            <span class="material-symbols-outlined">payments</span>
                        </div>
                        <span
                            class="px-2 py-1 bg-surface-container-highest text-on-surface-variant font-label-md text-label-sm rounded-md">On
                            Hold</span>
                    </div>
                    <h4
                        class="text-headline-md font-headline-md text-on-surface mb-2 group-hover:text-primary transition-colors">
                        Internal Audit Flow</h4>
                    <p class="text-body-md text-on-surface-variant mb-6 flex-1">Refining our internal financial
                        auditing processes to ensure compliance with updated regional regulations.</p>
                    <div class="mb-4 opacity-60">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-label-md font-label-md text-on-surface-variant">Progress</span>
                            <span class="text-label-md font-bold text-on-surface-variant">12%</span>
                        </div>
                        <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                            <div class="h-full bg-outline transition-all duration-1000" style="width: 12%"></div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-stack-md border-t border-outline-variant/30">
                        <div class="flex -space-x-2">
                            <img class="w-8 h-8 rounded-full border-2 border-white object-cover"
                                data-alt="A professional male executive in a white shirt, clean lines, high-contrast professional lighting, minimalist background, neutral and focused expression, part of a high-quality corporate avatar set."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuC58CJWk26dlK8FCZct9grVkTsjJt50NkPZuRweMiPhXFDbQhDQwi-bllSdom6QXysYfE3JETggDB3zbEpAFX34LyeXae8qlvJGIOLstSYU-_GVO_vEbX2E8Qr5MIEqsCngK1CQ_v-PC1M3fJUrPUJMfgmdz2B9TXl-PvnNX9voDo4ChPZC3ioRr-hFkFf0dxYjQTS0GebjXMs-5zYBoKw8KA8ImZsS3JK4kibK1G8odGbe6MKbJcfpbw" />
                            <div
                                class="w-8 h-8 rounded-full border-2 border-white bg-surface-container-highest flex items-center justify-center text-[10px] font-bold">
                                +1</div>
                        </div>
                        <span class="text-label-sm text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">pause_circle</span>
                            Paused
                        </span>
                    </div>
                </div>
                <!-- Project Card 3: Completed -->
                <div
                    class="group bg-white rounded-xl border border-outline-variant hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-stack-lg flex flex-col h-full relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-secondary/5 rounded-full -mr-12 -mt-12 flex items-end justify-start pb-4 pl-4">
                        <span class="material-symbols-outlined text-secondary text-lg"
                            style="font-variation-settings: 'FILL' 1;">verified</span>
                    </div>
                    <div class="flex justify-between items-start mb-stack-md">
                        <div class="p-2 bg-secondary-container/20 rounded-lg text-secondary">
                            <span class="material-symbols-outlined">rocket_launch</span>
                        </div>
                        <span
                            class="px-2 py-1 bg-secondary text-white font-label-md text-label-sm rounded-md">Completed</span>
                    </div>
                    <h4
                        class="text-headline-md font-headline-md text-on-surface mb-2 group-hover:text-primary transition-colors">
                        Mobile App V2.0</h4>
                    <p class="text-body-md text-on-surface-variant mb-6 flex-1">Complete redesign and architecture
                        overhaul of the Focus mobile application for iOS and Android platforms.</p>
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-label-md font-label-md text-on-surface-variant">Progress</span>
                            <span class="text-label-md font-bold text-secondary">100%</span>
                        </div>
                        <div class="w-full h-1.5 bg-secondary/20 rounded-full overflow-hidden">
                            <div class="h-full bg-secondary" style="width: 100%"></div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-stack-md border-t border-outline-variant/30">
                        <div class="flex -space-x-2">
                            <img class="w-8 h-8 rounded-full border-2 border-white object-cover"
                                data-alt="High-resolution professional photo of a young woman with a sharp bob haircut, bright workspace environment with natural lighting, modern corporate style, confident and capable expression."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBFYiVZEPLpeTD6aHoikr_b20LcO99PS_DcR4-VhWLUyRKNEaYRNtNbf4kZgnUtXE6AU4zyifVgJ-88IEIkDLbIskQddWLHlIwL3nibPAU3sCxtDJb8Qhl7oC7sgckiYUJPyVvpL_B8FQc1gd_7XhrvSo1IfCpfRZJVPhvShZJRcs7xm1hVNoei41Nk43atJMRAPp_fjj91Wgywu6JTMWCjprSNaZzh5hyX0PoFqVpbihS2LIqtq2wlQQ" />
                            <img class="w-8 h-8 rounded-full border-2 border-white object-cover"
                                data-alt="Corporate portrait of an older professional man with grey hair, sophisticated studio lighting, clean background, friendly yet formal, matching a minimalist design system aesthetic."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBLVcPvbQCFYv1r8BK97zxLKlBf_VuBKlPjMkBQzF-CZI9WqiwmcZhdW4okLHhuwI8azx4VpkLXd4v9U7raMV9gxEeXKvqqM9gzDBnnnHUjsTRkM7ViuhB89KaG_8bwik8vgB9h8yTmxV7m7bLgPIl2sZuzBH7C1m2mJS5ACBIMXC7M0f4zFE5uFPBCjBPeMaSgKTbd7UZ99493I4-1weP-bGLdXfw29T7uXIyetXjzC2YF0OiZ-QtFvQ" />
                            <img class="w-8 h-8 rounded-full border-2 border-white object-cover"
                                data-alt="Portrait of a young tech professional with a warm smile, wearing a neutral-toned t-shirt, soft focus office background, professional corporate headshot style."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBTMH_bh4M6XgAIcO42_BuW3wnO1P2QF3EtpXhDcl0Z8hcfqt4CfQQBGcoH57RNjwqnBaY_L8zjWUxMEM8zHFYm3R2dTUpYx9hz5fSSCr-wKuouLvcokGERV5AYedujzwqhSxbzFkt76mAjoNClC2eEmdZRwAevk7imk3RBQi5JoZulqKocnEIDP6y6NmSOHi6QVChchdFX8zRpslNMWax8Ym8JnHOxGR_WVl5O2ejN4zgIujA-9FlpRw" />
                        </div>
                        <span class="text-label-sm text-secondary font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">check_circle</span>
                            Finished
                        </span>
                    </div>
                </div>
                <!-- Project Card 4: Active -->
                <div
                    class="group bg-white rounded-xl border border-outline-variant hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-stack-lg flex flex-col h-full">
                    <div class="flex justify-between items-start mb-stack-md">
                        <div class="p-2 bg-primary-container/20 rounded-lg text-primary">
                            <span class="material-symbols-outlined">psychology</span>
                        </div>
                        <span
                            class="px-2 py-1 bg-secondary-container text-on-secondary-fixed-variant font-label-md text-label-sm rounded-md">Active</span>
                    </div>
                    <h4
                        class="text-headline-md font-headline-md text-on-surface mb-2 group-hover:text-primary transition-colors">
                        AI Content Generator</h4>
                    <p class="text-body-md text-on-surface-variant mb-6 flex-1">Integrating LLMs into the Focus
                        workflow to automate task descriptions and project brief summaries.</p>
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-label-md font-label-md text-on-surface-variant">Progress</span>
                            <span class="text-label-md font-bold text-secondary">38%</span>
                        </div>
                        <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                            <div class="h-full bg-secondary transition-all duration-1000" style="width: 38%">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-stack-md border-t border-outline-variant/30">
                        <div class="flex -space-x-2">
                            <img class="w-8 h-8 rounded-full border-2 border-white object-cover"
                                data-alt="A sharp, minimalist professional headshot of a middle-aged woman with a kind expression, wearing a navy blazer, soft lighting, neutral background, consistent with premium corporate branding."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCRvmP-jJCzBWut2l_k3rKu3FhatXfZZgFjDWd7OdWLlMdJmO7cfOCwD7UHJTQ_TqeOaHlo_ekSemS7_PrfxS9X7dWYRU8GRuwrj-pEPVwARQ-MqI3Y3dexpzE5vWzLu2Ayj_N9hCzetUrSuRLTjDcedgZ1IVEhG7hWquMxzEu3VHcA7T9Z36xXHdjnSjitPDjE-SOA1W-36I-1h1MTR_qa7f88AifPoqejfnut-u77EXdYVBPt_osq3A" />
                            <div
                                class="w-8 h-8 rounded-full border-2 border-white bg-surface-container-highest flex items-center justify-center text-[10px] font-bold">
                                +8</div>
                        </div>
                        <span class="text-label-sm text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">schedule</span>
                            45d left
                        </span>
                    </div>
                </div>
                <!-- Project Card 5: Active -->
                <div
                    class="group bg-white rounded-xl border border-outline-variant hover:shadow-lg hover:-translate-y-1 transition-all duration-300 p-stack-lg flex flex-col h-full">
                    <div class="flex justify-between items-start mb-stack-md">
                        <div class="p-2 bg-error-container/20 rounded-lg text-error">
                            <span class="material-symbols-outlined">security</span>
                        </div>
                        <span
                            class="px-2 py-1 bg-secondary-container text-on-secondary-fixed-variant font-label-md text-label-sm rounded-md">Active</span>
                    </div>
                    <h4
                        class="text-headline-md font-headline-md text-on-surface mb-2 group-hover:text-primary transition-colors">
                        Security Patch 4.2</h4>
                    <p class="text-body-md text-on-surface-variant mb-6 flex-1">Critical security updates to the
                        backend infrastructure to mitigate potential vulnerabilities discovered in Q3.</p>
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-label-md font-label-md text-on-surface-variant">Progress</span>
                            <span class="text-label-md font-bold text-secondary">82%</span>
                        </div>
                        <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                            <div class="h-full bg-secondary transition-all duration-1000" style="width: 82%">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-stack-md border-t border-outline-variant/30">
                        <div class="flex -space-x-2">
                            <img class="w-8 h-8 rounded-full border-2 border-white object-cover"
                                data-alt="Close-up profile shot of a diverse developer focusing on a screen, with reflected code on his glasses, high-key office lighting, minimalist aesthetics, modern professional look."
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBDi8DNG_FuobPKFwkOMH_h5E1jjIV_FfoiTXXewLN7l6t3Ib5TT0SnZX2NlN0A_psjIGV33BzgizBGWu3GbI2H2xISXFqMZqPKgBmV_aMCQWU_jHwMIDTt2VJZn351ZkllbsubFLi8mHw-DP2cL7MR0ZG44mYnW429Prf9g92ObvLHGdp-cUVJVGsmY08p5k6fMSaUrmUOAW3NLz26MEkQiM5-Efz_TY6stjFDVtUraYs4w-d7qJ57mw" />
                        </div>
                        <span class="text-label-sm text-error font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">warning</span>
                            Overdue
                        </span>
                    </div>
                </div>
                <!-- New Project Empty State / Call to Action -->
                <div
                    class="group bg-surface-container-low border-2 border-dashed border-outline-variant rounded-xl hover:border-primary hover:bg-white transition-all duration-300 p-stack-lg flex flex-col items-center justify-center h-full text-center cursor-pointer">
                    <div
                        class="w-16 h-16 rounded-full bg-white border border-outline-variant flex items-center justify-center mb-4 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <span class="material-symbols-outlined text-[32px]">add</span>
                    </div>
                    <h4 class="text-headline-md font-headline-md text-on-surface mb-2">Start Something New</h4>
                    <p class="text-body-md text-on-surface-variant px-8">Define goals, assemble your team, and
                        launch your next big idea.</p>
                    <div
                        class="mt-6 px-6 py-2 bg-surface-container-highest rounded-full text-label-md font-bold text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                        Launch Project
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Micro-interactions Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Placeholder for interactivity
            const cards = document.querySelectorAll('.group');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    // Logic for card hover effects could go here
                });
            });

            // Smooth entrance for progress bars
            const progressBars = document.querySelectorAll('.bg-secondary');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 100);
            });
        });
    </script>
@endpush
