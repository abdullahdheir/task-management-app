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
        <section class="glass-card rounded-xl p-8 shadow-sm" x-data="{
            name: '{{ old('name') }}',
            description: '{{ old('description') }}',
            startDate: '{{ old('start_date') }}',
            endDate: '{{ old('end_date') }}',
            colorLabel: '{{ old('color_label', 'indigo') }}',
            members: [],
            loading: false,
            searchQuery: '',
            searchResults: [],
            searchOpen: false,

            async searchUsers() {
                if (this.searchQuery.length < 2) {
                    this.searchResults = [];
                    this.searchOpen = false;
                    return;
                }

                try {
                    const res = await ajax.get('{{ route('search.users') }}', { q: this.searchQuery });
                    this.searchResults = res.data || [];
                    this.searchOpen = true;
                } catch (e) {
                    this.searchResults = [];
                }
            },

            addMember(user) {
                if (!this.members.find(m => m.id === user.id)) {
                    this.members.push(user);
                }
                this.searchQuery = '';
                this.searchResults = [];
                this.searchOpen = false;
            },

            removeMember(index) {
                this.members.splice(index, 1);
            },

            async submitForm() {
                this.loading = true;
                try {
                    const res = await ajax.post('{{ route('projects.store') }}', {
                        name: this.name,
                        description: this.description,
                        start_date: this.startDate,
                        end_date: this.endDate,
                        color_label: this.colorLabel,
                        member_ids: this.members.map(m => m.id)
                    });
                    if (res.status === 'success') {
                        toast('Project created successfully');
                        window.location.href = res.data.url || '{{ route('projects.overview') }}';
                    } else {
                        toast(res.message ?? 'Error creating project', 'error');
                    }
                } catch (e) {
                    toast('Failed to create project', 'error');
                } finally {
                    this.loading = false;
                }
            }
        }">
            <form @submit.prevent="submitForm()" class="space-y-8" id="createProjectForm">
                @csrf
                <!-- Basic Info -->
                <div class="space-y-stack-lg">
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface-variant" for="project_name">Project
                            Name</label>
                        <input
                            class="w-full h-12 px-4 rounded-lg border border-outline-variant bg-white text-body-lg font-body-lg transition-all"
                            id="project_name" x-model="name" placeholder="e.g., Q4 Marketing Campaign" required=""
                            type="text" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface-variant"
                            for="project_description">Description</label>
                        <textarea
                            class="w-full p-4 rounded-lg border border-outline-variant bg-white text-body-md font-body-md transition-all resize-none"
                            id="project_description" x-model="description" placeholder="Describe the objectives and key deliverables..."
                            rows="3"></textarea>
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
                                    x-model="startDate" type="date" />
                            </div>
                            <span class="text-on-surface-variant">
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </span>
                            <div class="flex-1 flex flex-col gap-2">
                                <input
                                    class="w-full h-12 px-4 rounded-lg border border-outline-variant bg-white text-body-md"
                                    x-model="endDate" type="date" />
                            </div>
                        </div>
                    </div>
                    <!-- Color Label -->
                    <div class="space-y-4">
                        <span class="font-label-md text-label-md text-on-surface-variant">Color Label</span>
                        <div class="flex flex-wrap gap-3">
                            <label class="relative cursor-pointer group">
                                <input x-model="colorLabel" value="indigo" class="peer hidden" type="radio" />
                                <div
                                    class="w-10 h-10 rounded-full bg-primary ring-offset-2 peer-checked:ring-2 ring-primary transition-all">
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input x-model="colorLabel" value="emerald" class="peer hidden" type="radio" />
                                <div
                                    class="w-10 h-10 rounded-full bg-secondary ring-offset-2 peer-checked:ring-2 ring-secondary transition-all">
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input x-model="colorLabel" value="amber" class="peer hidden" type="radio" />
                                <div
                                    class="w-10 h-10 rounded-full bg-tertiary-container ring-offset-2 peer-checked:ring-2 ring-tertiary-container transition-all">
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input x-model="colorLabel" value="rose" class="peer hidden" type="radio" />
                                <div
                                    class="w-10 h-10 rounded-full bg-error ring-offset-2 peer-checked:ring-2 ring-error transition-all">
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input x-model="colorLabel" value="cyan" class="peer hidden" type="radio" />
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
                        <span class="text-label-sm font-label-sm text-primary"
                            x-text="members.length + ' members added'"></span>
                    </div>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-outline">
                            <span class="material-symbols-outlined">search</span>
                        </div>
                        <input
                            class="w-full h-12 pl-12 pr-4 rounded-lg border border-outline-variant bg-white text-body-md transition-all"
                            x-model="searchQuery" @input="searchUsers()" @click.outside="searchOpen = false"
                            placeholder="Search by name or email..." type="text" />

                        <!-- Search Results Dropdown -->
                        <div x-show="searchOpen && searchResults.length > 0"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute top-full left-0 right-0 mt-2 bg-white border border-outline-variant rounded-lg shadow-xl z-50 overflow-hidden"
                            style="display:none">
                            <template x-for="user in searchResults" :key="user.id">
                                <button @click="addMember(user)"
                                    class="w-full flex items-center gap-3 px-4 py-3 hover:bg-surface-container-low transition-colors text-left">
                                    <div
                                        class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center font-bold text-primary overflow-hidden">
                                        <img x-show="user.avatar" :src="user.avatar"
                                            class="w-full h-full object-cover" alt="" />
                                        <span x-show="!user.avatar"
                                            x-text="user.name.substring(0,2).toUpperCase()"></span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-body-md text-on-surface" x-text="user.name"></p>
                                        <p class="text-xs text-on-surface-variant" x-text="user.email"></p>
                                    </div>
                                    <span class="material-symbols-outlined text-primary">add</span>
                                </button>
                            </template>
                        </div>
                    </div>
                    <!-- Member Chips Bento-style -->
                    <div class="flex flex-wrap gap-2 pt-2">
                        <template x-for="(member, index) in members" :key="member.id">
                            <div
                                class="flex items-center gap-2 bg-surface-container-low border border-outline-variant px-3 py-1.5 rounded-full">
                                <div class="w-6 h-6 rounded-full overflow-hidden">
                                    <img x-show="member.avatar" :src="member.avatar" class="w-full h-full object-cover"
                                        alt="" />
                                    <div x-show="!member.avatar"
                                        class="w-full h-full bg-surface-container-highest flex items-center justify-center font-bold text-primary text-xs">
                                        <span x-text="member.name.substring(0,2).toUpperCase()"></span>
                                    </div>
                                </div>
                                <span class="text-body-md font-medium" x-text="member.name"></span>
                                <button @click="removeMember(index)"
                                    class="text-on-surface-variant hover:text-error transition-colors" type="button">
                                    <span class="material-symbols-outlined text-[18px]">close</span>
                                </button>
                            </div>
                        </template>
                        <div x-show="members.length === 0" class="text-sm text-on-surface-variant italic">
                            No members added yet
                        </div>
                    </div>
                </div>
                <!-- Divider -->
                <div class="h-[1px] w-full bg-outline-variant opacity-50"></div>
                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-4">
                    <button
                        class="px-6 py-3 font-label-md text-label-md text-primary hover:bg-surface-container-low rounded-lg transition-colors"
                        type="button">Save as Draft</button>
                    <button :disabled="loading"
                        :class="loading ? 'opacity-70 cursor-not-allowed' : 'hover:brightness-110'"
                        class="px-8 py-3 bg-primary text-white font-label-md text-label-md rounded-lg shadow-md active:scale-95 transition-all"
                        type="submit">
                        <span x-show="!loading">Create Project</span>
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
