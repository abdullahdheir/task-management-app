@extends('layouts.app')

@section('title', 'Create Project')

@section('content')
    <!-- Background Decoration (Atmospheric) -->
    <div class="absolute top-0 right-0 w-1/3 h-1/3 opacity-20 pointer-events-none">
        <div class="w-full h-full bg-cover bg-center"
            data-alt="A subtle, abstract geometric pattern consisting of light indigo and slate blue translucent shapes, reflecting a corporate and modern productivity tool aesthetic. The lighting is soft and high-key, creating a clean white-mode feel with professional gradients that fade into the background."
            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD5-_8yKdyZKYhjROAlCw2qWmendaczlzxr6t_m__7mWqfLMbZa1UhfUm6V127pAnKsseb6gWcY4MAdYstcBVEeN82VZVPBPmInN9xh_lDvUgwInEQKN-YKFvDc9vAB8FmmWmoBARlkkdxDa-XiQZ36G3H4Z0KAxC-DLhc4s2yf226pN3uLq9OAy2CcSEvzYoUcTq8BR-CGLjCARG7rdP6LyqNiE4b7H5tyBGer2nBVp6LFBgl5OufCBg')">
        </div>
    </div>
    <!-- Content Header -->
    <header class="max-w-[800px] mx-auto mb-stack-lg flex items-center justify-between">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Create Project</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">Define your scope, timeline, and team to
                get started.</p>
        </div>
        <button
            class="flex items-center gap-2 px-4 py-2 text-on-surface-variant hover:bg-surface-container-high rounded-lg transition-colors cursor-pointer"
            onclick="window.history.back()">
            <span class="material-symbols-outlined">close</span>
            <span class="font-label-md text-label-md">Cancel</span>
        </button>
    </header>
    <!-- Create Project Form Section -->
    <div class="max-w-[800px] mx-auto">
        <section class="glass-card rounded-xl p-8 shadow-sm">
            <form action="{{ route('projects.store') }}" method="POST" class="space-y-8" id="createProjectForm">
                @csrf
                <!-- Basic Info -->
                <div class="space-y-stack-lg">
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface-variant" for="project_name">Project
                            Name</label>
                        <input
                            class="w-full h-12 px-4 rounded-lg border border-outline-variant bg-white text-body-lg font-body-lg transition-all"
                            id="project_name" name="name" value="{{ old('name') }}"
                            placeholder="e.g., Q4 Marketing Campaign" required="" type="text" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface-variant"
                            for="project_description">Description</label>
                        <textarea
                            class="w-full p-4 rounded-lg border border-outline-variant bg-white text-body-md font-body-md transition-all resize-none"
                            id="project_description" name="description" placeholder="Describe the objectives and key deliverables..."
                            rows="3">{{ old('description') }}</textarea>
                    </div>
                </div>
                <!-- Grid: Timeline & Color -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-stack-lg">
                    <!-- Timeline -->
                    <div class="space-y-4">
                        <span class="font-label-md text-label-md text-on-surface-variant">Project Timeline</span>
                        <div class="flex items-center gap-3">
                            <div class="flex-1 flex flex-col gap-2">
                                <input
                                    class="w-full h-12 px-4 rounded-lg border border-outline-variant bg-white text-body-md"
                                    name="start_date" type="date" value="{{ old('start_date') }}" />
                            </div>
                            <span class="text-on-surface-variant">
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </span>
                            <div class="flex-1 flex flex-col gap-2">
                                <input
                                    class="w-full h-12 px-4 rounded-lg border border-outline-variant bg-white text-body-md"
                                    name="end_date" type="date" value="{{ old('end_date') }}" />
                            </div>
                        </div>
                    </div>
                    <!-- Color Label -->
                    <div class="space-y-4">
                        <span class="font-label-md text-label-md text-on-surface-variant">Color Label</span>
                        <div class="flex flex-wrap gap-3">
                            <label class="relative cursor-pointer group">
                                <input {{ old('color_label', 'indigo') === 'indigo' ? 'checked' : '' }} class="peer hidden"
                                    name="color_label" type="radio" value="indigo" />
                                <div
                                    class="w-10 h-10 rounded-full bg-primary ring-offset-2 peer-checked:ring-2 ring-primary transition-all">
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input {{ old('color_label', 'indigo') === 'emerald' ? 'checked' : '' }} class="peer hidden"
                                    name="color_label" type="radio" value="emerald" />
                                <div
                                    class="w-10 h-10 rounded-full bg-secondary ring-offset-2 peer-checked:ring-2 ring-secondary transition-all">
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input {{ old('color_label', 'indigo') === 'amber' ? 'checked' : '' }} class="peer hidden"
                                    name="color_label" type="radio" value="amber" />
                                <div
                                    class="w-10 h-10 rounded-full bg-tertiary-container ring-offset-2 peer-checked:ring-2 ring-tertiary-container transition-all">
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input {{ old('color_label', 'indigo') === 'rose' ? 'checked' : '' }} class="peer hidden"
                                    name="color_label" type="radio" value="rose" />
                                <div
                                    class="w-10 h-10 rounded-full bg-error ring-offset-2 peer-checked:ring-2 ring-error transition-all">
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input {{ old('color_label', 'indigo') === 'cyan' ? 'checked' : '' }} class="peer hidden"
                                    name="color_label" type="radio" value="cyan" />
                                <div
                                    class="w-10 h-10 rounded-full bg-[#00bcd4] ring-offset-2 peer-checked:ring-2 ring-[#00bcd4] transition-all">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Team Members -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="font-label-md text-label-md text-on-surface-variant">Team Members</label>
                        <span class="text-label-sm font-label-sm text-primary">3 members added</span>
                    </div>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-outline">
                            <span class="material-symbols-outlined">search</span>
                        </div>
                        <input
                            class="w-full h-12 pl-12 pr-4 rounded-lg border border-outline-variant bg-white text-body-md transition-all"
                            placeholder="Search by name or email..." type="text" />
                    </div>
                    <!-- Member Chips Bento-style -->
                    <div class="flex flex-wrap gap-2 pt-2">
                        <div
                            class="flex items-center gap-2 bg-surface-container-low border border-outline-variant px-3 py-1.5 rounded-full">
                            <div class="w-6 h-6 rounded-full overflow-hidden">
                                <img class="w-full h-full object-cover"
                                    data-alt="A professional headshot of a friendly business woman in a clean studio setting, soft lighting, minimalist vibe."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAS4xnL_hrdxxDOM3hQRGvPEkTZPwQehtbFl0lWOHoEU1OXPCQYIf8rx-qDm05nVgotoUDyomuA5aoFfkWctXTbqOK6_8Tu2-uQ8waPAMu4nhhbzfzX2UVpwPC5S4iBILBvLEsSbzjdF25TUcGMmUHRU6W6sytdTBJBjhHgMffnOtozyM32rTevbSmU4RYNAAm4XcCHeeLJOKuKdAO5tDPdKahM0moxYGah1pKOf09t_9NIaj4ktRlOpA" />
                            </div>
                            <span class="text-body-md font-medium">Sarah Jenkins</span>
                            <button class="text-on-surface-variant hover:text-error transition-colors"
                                type="button"><span class="material-symbols-outlined text-[18px]">close</span></button>
                        </div>
                        <div
                            class="flex items-center gap-2 bg-surface-container-low border border-outline-variant px-3 py-1.5 rounded-full">
                            <div class="w-6 h-6 rounded-full overflow-hidden">
                                <img class="w-full h-full object-cover"
                                    data-alt="A professional headshot of a creative male designer with glasses, high-key lighting, minimalist modern office background."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCx51x-QDJGYDVV6sBoqCkkIZv3pMxLslKkBI23JGuCK1L_59VmZe-kvfd7gY5AoUqljtdZIjUDZ5SrG8Gu4myMgOaCQKezR0xFyn-aJlxaqhzBTrH9AgHmVUQCaDQNospxdynK15qaM9QsxT_Xb9x7O5gXpOnODu6TnVLuzJeqKQG3uh-YZXJmPRg-HgpTrberP3U6xdv8EURZvEQzq2H3lSrS-KQyHX3gcSQ-p7wYmGPSLRBw5n9OHA" />
                            </div>
                            <span class="text-body-md font-medium">Marcus Chen</span>
                            <button class="text-on-surface-variant hover:text-error transition-colors"
                                type="button"><span class="material-symbols-outlined text-[18px]">close</span></button>
                        </div>
                        <div
                            class="flex items-center gap-2 bg-surface-container-low border border-outline-variant px-3 py-1.5 rounded-full">
                            <div class="w-6 h-6 rounded-full overflow-hidden">
                                <img class="w-full h-full object-cover"
                                    data-alt="A professional headshot of a young female developer, neutral tones, soft shadows, clean corporate style."
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCoT9yf4tlDMDt2B3gRLmJScgEWHdt_T-1OytE7b9bE8q9wfTig79J16vnIKziUKCmZXzYUoppsqX4c1jH0SPNXLuz0hz-kfC_Jb3S4oLBAu6cRXhoDv-Js_FOy3VOmnoUgvW5CQC3740x5PJwLDOayDo0C5KgwnqgCyCn_GBQ4K6Da7bRuwwdRAGQAFPKBdEKQMmkdCh3h5r_CeXCgaq4j96759lpM8Qo5tFHW5aQUdp9Gc0p82iS47A" />
                            </div>
                            <span class="text-body-md font-medium">Elena Rodriguez</span>
                            <button class="text-on-surface-variant hover:text-error transition-colors"
                                type="button"><span class="material-symbols-outlined text-[18px]">close</span></button>
                        </div>
                        <button
                            class="flex items-center justify-center w-10 h-10 rounded-full border-2 border-dashed border-outline-variant text-outline hover:border-primary hover:text-primary transition-all"
                            type="button">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                    </div>
                </div>
                <!-- Divider -->
                <div class="h-[1px] w-full bg-outline-variant opacity-50"></div>
                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-4">
                    <button
                        class="px-6 py-3 font-label-md text-label-md text-primary hover:bg-surface-container-low rounded-lg transition-colors"
                        type="button">Save as Draft</button>
                    <button
                        class="px-8 py-3 bg-primary text-white font-label-md text-label-md rounded-lg shadow-md hover:brightness-110 active:scale-95 transition-all"
                        type="submit">Create Project</button>
                </div>
            </form>
        </section>
        <!-- Contextual Tip Card -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-stack-lg">
            <div class="p-6 bg-secondary-container/10 border border-secondary-container/30 rounded-xl">
                <div class="text-secondary mb-2">
                    <span class="material-symbols-outlined">lightbulb</span>
                </div>
                <h4 class="font-label-md text-label-md text-on-secondary-fixed-variant">Pro Tip</h4>
                <p class="text-body-md text-on-surface-variant mt-1">Timeline helps 'Focus' automatically prioritize
                    tasks based on deadlines.</p>
            </div>
            <div class="md:col-span-2 relative rounded-xl overflow-hidden group cursor-pointer">
                <div class="w-full h-full absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                    data-alt="A clean, flat lay photograph of a modern minimalist desk with a tablet, notebook, and pen. The color palette is composed of soft whites, slate blues, and a touch of deep indigo. Professional office atmosphere for a project management dashboard."
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBLVqptl3muTAiCDah2JbbzGUONFb9yKUeNxG2GgN3bS-llHJ-GvUYT14-pb6Ttx7yQSa6RwMPGu9Vc0gTUnYq1iN1ljh5Y6fwYnYsQyYwDC8a47pQt-rDwALXKdlxzoh5LtcgEdA51oDPmABIeP2Wu6JozS3KsNmioqQN7DcWg6vPBzYaIFOEqWE2EUDm_FwChQL9pRwIMFWaoA7amT3_mIVFvKtb4MQj24I_apR33611keuu9DsEjaA')">
                </div>
                <div
                    class="absolute inset-0 bg-gradient-to-t from-on-surface/80 to-transparent p-6 flex flex-col justify-end">
                    <span class="text-white font-headline-md text-headline-md">Project Templates</span>
                    <p class="text-white/80 text-body-md">Start faster with pre-configured layouts for Marketing,
                        Product, or HR.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Micro-interactions Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('createProjectForm');

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const btn = e.target.querySelector('button[type="submit"]');
                const originalText = btn.innerHTML;

                btn.innerHTML =
                    '<span class="flex items-center gap-2"><svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Initializing...</span>';
                btn.disabled = true;

                setTimeout(() => {
                    btn.innerHTML =
                        '<span class="flex items-center gap-2"><span class="material-symbols-outlined">check</span> Project Created</span>';
                    btn.classList.replace('bg-primary', 'bg-secondary');

                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.classList.replace('bg-secondary', 'bg-primary');
                        btn.disabled = false;
                        alert('Project logic would initialize here in a real app.');
                    }, 2000);
                }, 1500);
            });

            // Animated Background Canvas Effect (Subtle Noise)
            const canvas = document.createElement('canvas');
            canvas.className = 'fixed inset-0 pointer-events-none opacity-[0.03] z-[99]';
            document.body.appendChild(canvas);
            const ctx = canvas.getContext('2d');
            let w, h;

            function resize() {
                w = canvas.width = window.innerWidth;
                h = canvas.height = window.innerHeight;
            }
            window.addEventListener('resize', resize);
            resize();

            function noise() {
                const idata = ctx.createImageData(w, h);
                const buffer32 = new Uint32Array(idata.data.buffer);
                for (let i = 0; i < buffer32.length; i++) {
                    if (Math.random() < 0.5) buffer32[i] = 0xffffffff;
                }
                ctx.putImageData(idata, 0, 0);
                requestAnimationFrame(noise);
            }
            noise();
        });
    </script>
@endpush
