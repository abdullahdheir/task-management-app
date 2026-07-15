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
        <h2 class="font-headline-lg text-headline-lg text-on-surface dark:text-on-surface-dark">Build your team</h2>
        <p class="font-body-lg text-body-lg text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mt-2">Bring your colleagues together and start
            collaborating on high-impact projects.</p>
    </header>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8" x-data="{
        name: '',
        description: '',
        members: [],
        privacy: 'private',
        loading: false,

        async submitForm() {
            this.loading = true;
            try {
                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('description', this.description);
                formData.append('privacy', this.privacy);
                this.members.forEach(m => {
                    formData.append('members[]', m.id);
                    formData.append('roles[]', m.role);
                });

                const res = await ajax.post('{{ route('teams.store') }}', formData);
                if (res.status === 'success') {
                    toast('Team created successfully');
                    window.location.href = res.data.url || '{{ route('teams.overview') }}';
                } else {
                    toast(res.message ?? 'Error creating team', 'error');
                }
            } catch (e) {
                toast('Failed to create team', 'error');
            } finally {
                this.loading = false;
            }
        },

        addMember() {
            const email = document.getElementById('member-email').value;
            const role = document.getElementById('member-role').value;

            if (email && email.includes('@')) {
                this.members.push({
                    id: Date.now(),
                    email: email,
                    name: email.split('@')[0],
                    role: role
                });
                document.getElementById('member-email').value = '';
            } else {
                toast('Please enter a valid email address', 'error');
            }
        },

        removeMember(index) {
            this.members.splice(index, 1);
        }
    }">
        <!-- Left: Form Section -->
        <div class="lg:col-span-7 space-y-8">
            <!-- Team Identity Card -->
            <section
                class="bg-surface dark:bg-surface-dark-container-lowest rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark p-stack-lg shadow-[0px_4px 6px_-1px_rgba(0,0,0,0.05)]">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-10 h-10 rounded-full bg-primary dark:bg-primary-dark-fixed dark:bg-primary dark:bg-primary-dark-fixed-dark flex items-center justify-center text-primary dark:text-primary-dark">
                        <span class="material-symbols-outlined">badge</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark">Team Identity</h3>
                </div>
                <div class="space-y-6">
                    <!-- Avatar Upload -->
                    <div
                        class="flex flex-col md:flex-row items-center gap-6 p-4 rounded-lg bg-surface dark:bg-surface-dark-container-low/50 border border-dashed border-outline dark:border-outline-dark">
                        <div class="relative group cursor-pointer">
                            <div
                                class="w-24 h-24 rounded-2xl bg-surface dark:bg-surface-dark-variant flex items-center justify-center overflow-hidden border-2 border-primary dark:border-primary-dark/20">
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
                            <h4 class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark mb-1">Team Avatar</h4>
                            <p class="text-xs text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-3">Recommended size: 400x400px. PNG or JPG.</p>
                            <button class="text-primary dark:text-primary-dark font-label-md text-label-md hover:underline">Change image</button>
                        </div>
                    </div>
                    <!-- Inputs -->
                    <div class="grid grid-cols-1 gap-6">
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark ml-1">Team Name</label>
                            <input
                                class="w-full h-12 px-4 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:border-2 focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark focus:ring-0 transition-all font-body-md bg-white dark:bg-surface-container-low-dark"
                                x-model="name" placeholder="e.g. Design Ops, Growth Squad" type="text" />
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark ml-1">Description
                                (Optional)</label>
                            <textarea
                                class="w-full p-4 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:border-2 focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark focus:ring-0 transition-all font-body-md bg-white dark:bg-surface-container-low-dark resize-none"
                                x-model="description" placeholder="What does this team focus on?" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Add Members Card -->
            <section
                class="bg-surface dark:bg-surface-dark-container-lowest rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark p-stack-lg shadow-[0px_4px 6px_-1px_rgba(0,0,0,0.05)]">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-10 h-10 rounded-full bg-secondary dark:bg-secondary-dark-container dark:bg-secondary dark:bg-secondary-dark-container-dark flex items-center justify-center text-on-secondary dark:text-on-secondary-dark-container dark:text-on-secondary dark:text-on-secondary-dark-container-dark">
                        <span class="material-symbols-outlined">person_add</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark">Add Members</h3>
                </div>
                <div class="space-y-6">
                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="flex-1 relative">
                            <span
                                class="material-symbols-outlined absolute left-3 top-3 text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">mail</span>
                            <input
                                class="w-full h-12 pl-10 pr-4 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:border-2 focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark focus:ring-0 transition-all font-body-md bg-white dark:bg-surface-container-low-dark"
                                id="member-email" placeholder="colleague@company.com" type="email" />
                        </div>
                        <select
                            class="h-12 px-4 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark focus:border-2 focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark focus:ring-0 transition-all font-body-md bg-white dark:bg-surface-container-low-dark min-w-[120px]"
                            id="member-role">
                            <option value="member">Member</option>
                            <option value="admin">Admin</option>
                        </select>
                        <button
                            class="h-12 px-6 bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark rounded-lg font-label-md text-label-md flex items-center justify-center gap-2 hover:opacity-90 active:scale-95 transition-all"
                            @click="addMember()">
                            Invite
                        </button>
                    </div>
                    <!-- Member List -->
                    <div class="border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg overflow-hidden">
                        <div class="bg-surface dark:bg-surface-dark-container-low px-4 py-2 border-b border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
                            <span class="font-label-sm text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase tracking-wider">Added
                                Members</span>
                        </div>
                        <ul class="divide-y divide-outline-variant dark:divide-outline-variant-dark bg-white dark:bg-surface-container-low-dark">
                            <!-- Current user as owner -->
                            <li
                                class="flex items-center justify-between p-4 hover:bg-surface dark:bg-surface-dark-container-lowest transition-colors">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-surface dark:bg-surface-dark-dim flex items-center justify-center font-bold text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">
                                        {{ auth()->user()->name[0] }}{{ auth()->user()->name[1] ?? '' }}</div>
                                    <div>
                                        <p class="font-body-md text-on-surface dark:text-on-surface-dark font-semibold">{{ auth()->user()->name }}
                                            (You)</p>
                                        <p class="text-xs text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>
                                <span
                                    class="bg-surface dark:bg-surface-dark-container-high text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-tighter">Owner</span>
                            </li>
                            <!-- Dynamic members -->
                            <template x-for="(member, index) in members" :key="index">
                                <li
                                    class="flex items-center justify-between p-4 hover:bg-surface dark:bg-surface-dark-container-lowest transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-surface dark:bg-surface-dark-container-highest flex items-center justify-center font-bold text-primary dark:text-primary-dark">
                                            <span x-text="member.name.substring(0,2).toUpperCase()"></span>
                                        </div>
                                        <div>
                                            <p class="font-body-md text-on-surface dark:text-on-surface-dark font-semibold" x-text="member.name"></p>
                                            <p class="text-xs text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark" x-text="member.email"></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <span
                                            class="bg-surface dark:bg-surface-dark-container-low text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-tighter"
                                            x-text="member.role"></span>
                                        <button @click="removeMember(index)"
                                            class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark hover:text-error dark:text-error-dark transition-colors">
                                            <span class="material-symbols-outlined text-[20px]">close</span>
                                        </button>
                                    </div>
                                </li>
                            </template>
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
                    class="bg-white dark:bg-surface-container-low-dark rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark p-6 shadow-xl relative overflow-hidden group">
                    <!-- Background decoration -->
                    <div
                        class="absolute -top-12 -right-12 w-32 h-32 bg-primary dark:bg-primary-dark/5 rounded-full blur-3xl transition-all group-hover:bg-primary dark:bg-primary-dark/10">
                    </div>
                    <h4
                        class="font-label-sm text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark uppercase tracking-widest mb-6 border-b border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark pb-2">
                        Team Preview</h4>
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div
                            class="w-20 h-20 rounded-2xl bg-surface dark:bg-surface-dark-container-high flex items-center justify-center shadow-inner overflow-hidden border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
                            <img class="w-full h-full object-cover"
                                data-alt="A sleek, modern geometric logo design representing teamwork and connectivity. The logo uses deep indigo and emerald gradients on a white background, embodying a professional and innovative corporate culture. Minimalist, clean lines with a slight 3D depth effect."
                                id="preview-avatar"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDm9RhLSMY0EBUj_TW8IXnbe5zTbWx_6a1g4FHZLfp4HClKsoi8Sx-SsLd_vnIF-xdpggXuBlMOn9wl6KOxf_exjo6b-78LVa8SJriNJpVe52p8BkzNQCAVDaG4n9HsFXzp5-grvpNDCXIh-QF0hxhsnKL_AIRu7Fw4YBonZG0n6JdpyLa7ukPt9omuhDyGFaEaGQOs2JZrR-ynkB-q4WhUrDdDW7R2oLl1INW7kwbqFfrNI54u-oktYA" />
                        </div>
                        <div>
                            <h3 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark" x-text="name || 'New Team'"></h3>
                            <p class="font-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark line-clamp-2 px-4 italic"
                                x-text="description || 'Collaborate and build amazing things together.'"></p>
                        </div>
                        <div class="flex -space-x-2 pt-2">
                            <div
                                class="w-8 h-8 rounded-full border-2 border-white bg-secondary dark:bg-secondary-dark flex items-center justify-center text-[10px] text-white">
                                {{ auth()->user()->name[0] }}{{ auth()->user()->name[1] ?? '' }}</div>
                            <div class="w-8 h-8 rounded-full border-2 border-white bg-primary dark:bg-primary-dark-container dark:bg-primary dark:bg-primary-dark-container-dark flex items-center justify-center text-[10px] text-white"
                                x-text="'+' + members.length"></div>
                        </div>
                    </div>
                </section>
                <!-- Project Association -->
                <section
                    class="bg-surface dark:bg-surface-dark-container-lowest rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark p-6 shadow-[0px_4px_6px_-1px_rgba(0,0,0,0.05)]">
                    <h4 class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark mb-4">Privacy &amp; Permissions</h4>
                    <div class="space-y-4">
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <div class="mt-1">
                                <input x-model="privacy" value="private"
                                    class="w-4 h-4 text-primary dark:text-primary-dark focus:ring-primary dark:focus:ring-primary-dark border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark"
                                    type="radio" />
                            </div>
                            <div>
                                <p
                                    class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark group-hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark transition-colors">
                                    Private Team</p>
                                <p class="text-[11px] text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark leading-relaxed">Only invited members can
                                    access and see this team. Recommended for most projects.</p>
                            </div>
                        </label>
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <div class="mt-1">
                                <input x-model="privacy" value="public"
                                    class="w-4 h-4 text-primary dark:text-primary-dark focus:ring-primary dark:focus:ring-primary-dark border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark"
                                    type="radio" />
                            </div>
                            <div>
                                <p
                                    class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark group-hover:text-primary dark:hover:text-primary-dark dark:text-primary-dark transition-colors">
                                    Public to Organization</p>
                                <p class="text-[11px] text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark leading-relaxed">Anyone in the focus.app
                                    domain can discover and join this team.</p>
                            </div>
                        </label>
                    </div>
                </section>
                <!-- Actions -->
                <div class="flex gap-4">
                    <button onclick="history.back();"
                        class="flex-1 h-12 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark font-label-md text-label-md hover:bg-surface dark:bg-surface-dark-container-low transition-colors active:scale-95">
                        Cancel
                    </button>
                    <button @click="submitForm()" :disabled="loading || !name.trim()"
                        :class="(loading || !name.trim()) ? 'opacity-70 cursor-not-allowed' : 'hover:opacity-90'"
                        class="flex-[2] h-12 rounded-lg bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark font-label-md text-label-md shadow-lg shadow-primary/20 active:scale-95 transition-all flex items-center justify-center gap-2">
                        <span x-show="!loading">Create Team</span>
                        <span x-show="loading" class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Creating...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
