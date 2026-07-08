@extends('layouts.app')

@section('title', 'Create Team')

@push('styles')
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #E2E8F0;
            border-radius: 10px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
    </style>
@endpush

@section('content')
    <header class="mb-stack-lg">
        <h2 class="font-headline-lg text-headline-lg text-on-surface">Build your team</h2>
        <p class="font-body-lg text-body-lg text-on-surface-variant mt-2">Bring your colleagues together and start
            collaborating on high-impact projects.</p>
    </header>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left: Form Section -->
        <div class="lg:col-span-7 space-y-8">
            <!-- Team Identity Card -->
            <section
                class="bg-surface-container-lowest rounded-xl border border-outline-variant p-stack-lg shadow-[0px_4px_6px_-1px_rgba(0,0,0,0.05)]">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">badge</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md text-on-surface">Team Identity</h3>
                </div>
                <div class="space-y-6">
                    <!-- Avatar Upload -->
                    <div
                        class="flex flex-col md:flex-row items-center gap-6 p-4 rounded-lg bg-surface-container-low/50 border border-dashed border-outline">
                        <div class="relative group cursor-pointer">
                            <div
                                class="w-24 h-24 rounded-2xl bg-surface-variant flex items-center justify-center overflow-hidden border-2 border-primary/20">
                                <img class="w-full h-full object-cover"
                                    data-alt="A sleek, modern geometric logo design representing teamwork and connectivity. The logo uses deep indigo and emerald gradients on a white background, embodying a professional and innovative corporate culture. Minimalist, clean lines with a slight 3D depth effect."
                                    id="avatar-preview"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBmZxAqzEJSsQIa41QVoF1Jn6g3RCinO-68YpCPgsacZA3ShfWNmESDYzQRjIe4BFQAyDZBop930AxSCSQn8ZLDNfwxQVg2iz48M2k-LCZgaCZ4Ius9E_GY6rd1gwhdUHYwsitYEeeiB01XlRzVG5XJTJ0znqNKdJSdyiVZUF4LaprIb1o0ltAGt1clPp8IFpskC85jMoorAoPnGytltBbPcBYIUQhfMgm77-o4ZTX7x-tgXcckmTJJrg" />
                                <div
                                    class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="material-symbols-outlined text-white">photo_camera</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h4 class="font-label-md text-label-md text-on-surface mb-1">Team Avatar</h4>
                            <p class="text-xs text-on-surface-variant mb-3">Recommended size: 400x400px. PNG or JPG.</p>
                            <button class="text-primary font-label-md text-label-md hover:underline">Change image</button>
                        </div>
                    </div>
                    <!-- Inputs -->
                    <div class="grid grid-cols-1 gap-6">
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant ml-1">Team Name</label>
                            <input
                                class="w-full h-12 px-4 rounded-lg border border-outline-variant focus:border-2 focus:border-primary focus:ring-0 transition-all font-body-md bg-white"
                                placeholder="e.g. Design Ops, Growth Squad" type="text" />
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant ml-1">Description
                                (Optional)</label>
                            <textarea
                                class="w-full p-4 rounded-lg border border-outline-variant focus:border-2 focus:border-primary focus:ring-0 transition-all font-body-md bg-white resize-none"
                                placeholder="What does this team focus on?" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Add Members Card -->
            <section
                class="bg-surface-container-lowest rounded-xl border border-outline-variant p-stack-lg shadow-[0px_4px_6px_-1px_rgba(0,0,0,0.05)]">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                        <span class="material-symbols-outlined">person_add</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md text-on-surface">Add Members</h3>
                </div>
                <div class="space-y-6">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="flex-1 relative">
                            <span
                                class="material-symbols-outlined absolute left-3 top-3 text-on-surface-variant">mail</span>
                            <input
                                class="w-full h-12 pl-10 pr-4 rounded-lg border border-outline-variant focus:border-2 focus:border-primary focus:ring-0 transition-all font-body-md bg-white"
                                id="member-email" placeholder="colleague@company.com" type="email" />
                        </div>
                        <select
                            class="h-12 px-4 rounded-lg border border-outline-variant focus:border-2 focus:border-primary focus:ring-0 transition-all font-body-md bg-white min-w-[120px]"
                            id="member-role">
                            <option value="Member">Member</option>
                            <option value="Admin">Admin</option>
                        </select>
                        <button
                            class="h-12 px-6 bg-primary text-on-primary rounded-lg font-label-md text-label-md flex items-center justify-center gap-2 hover:opacity-90 active:scale-95 transition-all"
                            onclick="addMember()">
                            Invite
                        </button>
                    </div>
                    <!-- Member List -->
                    <div class="border border-outline-variant rounded-lg overflow-hidden">
                        <div class="bg-surface-container-low px-4 py-2 border-b border-outline-variant">
                            <span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Added
                                Members</span>
                        </div>
                        <ul class="divide-y divide-outline-variant bg-white" id="member-list">
                            <!-- Dynamic content -->
                            <li
                                class="flex items-center justify-between p-4 hover:bg-surface-container-lowest transition-colors">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-surface-dim flex items-center justify-center font-bold text-on-surface-variant">
                                        JD</div>
                                    <div>
                                        <p class="font-body-md text-on-surface font-semibold">Jane Doe (You)</p>
                                        <p class="text-xs text-on-surface-variant">jane.doe@focus.app</p>
                                    </div>
                                </div>
                                <span
                                    class="bg-surface-container-high text-on-surface-variant px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-tighter">Owner</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
        <!-- Right: Preview / Settings Section -->
        <div class="lg:col-span-5 space-y-8">
            <!-- Preview Card -->
            <div class="sticky top-24 space-y-8">
                <section
                    class="bg-white rounded-xl border border-outline-variant p-6 shadow-xl relative overflow-hidden group">
                    <!-- Background decoration -->
                    <div
                        class="absolute -top-12 -right-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl transition-all group-hover:bg-primary/10">
                    </div>
                    <h4
                        class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest mb-6 border-b border-outline-variant pb-2">
                        Team Preview</h4>
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div
                            class="w-20 h-20 rounded-2xl bg-surface-container-high flex items-center justify-center shadow-inner overflow-hidden border border-outline-variant">
                            <img class="w-full h-full object-cover"
                                data-alt="A sleek, modern geometric logo design representing teamwork and connectivity. The logo uses deep indigo and emerald gradients on a white background, embodying a professional and innovative corporate culture. Minimalist, clean lines with a slight 3D depth effect."
                                id="preview-avatar"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDm9RhLSMY0EBUj_TW8IXnbe5zTbWx_6a1g4FHZLfp4HClKsoi8Sx-SsLd_vnIF-xdpggXuBlMOn9wl6KOxf_exjo6b-78LVa8SJriNJpVe52p8BkzNQCAVDaG4n9HsFXzp5-grvpNDCXIh-QF0hxhsnKL_AIRu7Fw4YBonZG0n6JdpyLa7ukPt9omuhDyGFaEaGQOs2JZrR-ynkB-q4WhUrDdDW7R2oLl1INW7kwbqFfrNI54u-oktYA" />
                        </div>
                        <div>
                            <h3 class="font-headline-md text-headline-md text-on-surface" id="preview-name">New Team</h3>
                            <p class="font-body-md text-on-surface-variant line-clamp-2 px-4 italic" id="preview-desc">
                                Collaborate and build amazing things together.</p>
                        </div>
                        <div class="flex -space-x-2 pt-2">
                            <div
                                class="w-8 h-8 rounded-full border-2 border-white bg-secondary flex items-center justify-center text-[10px] text-white">
                                JD</div>
                            <div
                                class="w-8 h-8 rounded-full border-2 border-white bg-primary-container flex items-center justify-center text-[10px] text-white">
                                +0</div>
                        </div>
                    </div>
                </section>
                <!-- Project Association -->
                <section
                    class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6 shadow-[0px_4px_6px_-1px_rgba(0,0,0,0.05)]">
                    <h4 class="font-label-md text-label-md text-on-surface mb-4">Privacy &amp; Permissions</h4>
                    <div class="space-y-4">
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <div class="mt-1">
                                <input checked="" class="w-4 h-4 text-primary focus:ring-primary border-outline-variant"
                                    name="privacy" type="radio" />
                            </div>
                            <div>
                                <p
                                    class="font-label-md text-label-md text-on-surface group-hover:text-primary transition-colors">
                                    Private Team</p>
                                <p class="text-[11px] text-on-surface-variant leading-relaxed">Only invited members can
                                    access and see this team. Recommended for most projects.</p>
                            </div>
                        </label>
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <div class="mt-1">
                                <input class="w-4 h-4 text-primary focus:ring-primary border-outline-variant" name="privacy"
                                    type="radio" />
                            </div>
                            <div>
                                <p
                                    class="font-label-md text-label-md text-on-surface group-hover:text-primary transition-colors">
                                    Public to Organization</p>
                                <p class="text-[11px] text-on-surface-variant leading-relaxed">Anyone in the focus.app
                                    domain can discover and join this team.</p>
                            </div>
                        </label>
                    </div>
                </section>
                <!-- Actions -->
                <div class="flex gap-4">
                    <button
                        class="flex-1 h-12 rounded-lg border border-outline-variant text-on-surface-variant font-label-md text-label-md hover:bg-surface-container-low transition-colors active:scale-95">
                        Cancel
                    </button>
                    <button
                        class="flex-[2] h-12 rounded-lg bg-primary text-on-primary font-label-md text-label-md shadow-lg shadow-primary/20 hover:opacity-90 active:scale-95 transition-all">
                        Create Team
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Simple micro-interactions for the form
        const nameInput = document.querySelector('input[placeholder*="Design Ops"]');
        const descInput = document.querySelector('textarea');
        const previewName = document.getElementById('preview-name');
        const previewDesc = document.getElementById('preview-desc');

        nameInput.addEventListener('input', (e) => {
            previewName.textContent = e.target.value || "New Team";
        });

        descInput.addEventListener('input', (e) => {
            previewDesc.textContent = e.target.value || "Collaborate and build amazing things together.";
        });

        // Add member logic
        function addMember() {
            const email = document.getElementById('member-email').value;
            const role = document.getElementById('member-role').value;
            const list = document.getElementById('member-list');

            if (email && email.includes('@')) {
                const initials = email.split('@')[0].substring(0, 2).toUpperCase();

                const li = document.createElement('li');
                li.className =
                    "flex items-center justify-between p-4 hover:bg-surface-container-lowest transition-colors opacity-0 translate-y-2 transition-all duration-300";
                li.innerHTML = `
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center font-bold text-primary">${initials}</div>
                        <div>
                            <p class="font-body-md text-on-surface font-semibold">${email.split('@')[0]}</p>
                            <p class="text-xs text-on-surface-variant">${email}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="bg-surface-container-low text-on-surface-variant px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-tighter">${role}</span>
                        <button onclick="this.closest('li').remove()" class="text-on-surface-variant hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </button>
                    </div>
                `;

                list.appendChild(li);
                setTimeout(() => {
                    li.classList.remove('opacity-0', 'translate-y-2');
                }, 10);

                document.getElementById('member-email').value = '';
            } else {
                alert('Please enter a valid email address');
            }
        }
    </script>
@endpush
