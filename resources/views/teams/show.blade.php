@extends('layouts.app')

@section('title', $team->name)

@section('content')

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-stack-lg gap-4">
        <div>
            <nav class="flex items-center gap-2 mb-1 text-on-surface-variant font-label-sm text-label-sm">
                <a href="{{ route('teams.overview') }}" class="hover:text-primary transition-colors">Teams</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <span class="text-primary font-bold">{{ $team->name }}</span>
            </nav>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">{{ $team->name }}</h2>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">{{ $team->description ?? 'No description.' }}
            </p>
        </div>
        <div class="flex gap-stack-md">
            @if (auth()->id() === $team->owner_id)
                <a href="{{ route('teams.edit', $team) }}"
                    class="px-4 py-2 border border-outline-variant text-on-surface-variant rounded-lg font-label-md hover:bg-surface-container-low transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                    Edit Team
                </a>
            @endif
            @if (auth()->id() !== $team->owner_id)
                <button
                    onclick="if(confirm('Leave this team?')) {
                        ajax.delete('{{ route('teams.destroy', $team) }}')
                            .then(res => {
                                if(res.status === 'success') {
                                    window.location.href = '{{ route('teams.overview') }}';
                                } else {
                                    toast(res.message ?? 'Error', 'error');
                                }
                            });
                    }"
                    class="px-4 py-2 border border-error text-error rounded-lg font-label-md hover:bg-error-container/20 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                    Leave Team
                </button>
            @endif
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter-desktop mb-stack-lg">
        <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl">
            <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-1">Members</p>
            <h3 class="text-headline-lg font-headline-lg text-primary">{{ $members->count() + 1 }}</h3>
            <p class="text-label-sm text-on-surface-variant mt-1">Including owner</p>
        </div>
        <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl">
            <p class="text-label-sm font-label-sm text-on-surface-variant uppercase tracking-wider mb-1">Projects</p>
            <h3 class="text-headline-lg font-headline-lg text-secondary">{{ $projects->count() }}</h3>
            <p class="text-label-sm text-on-surface-variant mt-1">Active in this team</p>
        </div>
        <div class="bg-primary p-6 rounded-xl text-on-primary relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-label-sm font-label-sm opacity-80 uppercase tracking-wider mb-1">Team Owner</p>
                <div class="flex items-center gap-3 mt-2">
                    @if ($team->owner)
                        <img src="{{ $team->owner->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($team->owner->name) . '&size=40' }}"
                            alt="{{ $team->owner->name }}"
                            class="w-10 h-10 rounded-full border-2 border-white/50 object-cover">
                        <div>
                            <p class="font-body-lg font-bold">{{ $team->owner->name }}</p>
                            <p class="text-label-sm opacity-80">{{ $team->owner->email }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <span
                class="material-symbols-outlined absolute -right-4 -bottom-4 text-[80px] opacity-10">admin_panel_settings</span>
        </div>
    </div>

    {{-- Main Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter-desktop">

        {{-- Projects Column --}}
        <div class="lg:col-span-2 space-y-gutter-desktop">
            <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">folder</span>
                        Projects
                    </h3>
                    @if (auth()->id() === $team->owner_id)
                        <a href="{{ route('projects.create') }}"
                            class="px-3 py-1 bg-primary text-white rounded-md text-label-sm hover:opacity-90 transition-opacity">
                            + New Project
                        </a>
                    @endif
                </div>
                <div class="space-y-3">
                    @forelse($projects as $project)
                        <a href="{{ route('projects.show', $project) }}"
                            class="flex items-center justify-between p-4 bg-white border border-outline-variant rounded-lg hover:shadow-sm hover:-translate-y-0.5 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-secondary-container/20 rounded-lg text-secondary">
                                    <span class="material-symbols-outlined text-[18px]">folder</span>
                                </div>
                                <div>
                                    <p class="font-body-lg text-on-surface group-hover:text-primary transition-colors">
                                        {{ $project->name }}
                                    </p>
                                    <p class="text-label-sm text-on-surface-variant">{{ $project->progress ?? 0 }}%
                                        complete</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-24 h-1.5 bg-surface-container rounded-full overflow-hidden">
                                    <div class="h-full bg-secondary transition-all duration-700"
                                        style="width: {{ $project->progress ?? 0 }}%"></div>
                                </div>
                                <span class="material-symbols-outlined text-on-surface-variant">chevron_right</span>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-8 text-on-surface-variant">
                            <span class="material-symbols-outlined text-4xl mb-2">folder_open</span>
                            <p class="font-body-md">No projects yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Activity --}}
            @if ($recentActivity->isNotEmpty())
                <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl">
                    <h3 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-primary">history</span>
                        Recent Activity
                    </h3>
                    <div class="space-y-4 relative">
                        <div class="absolute left-[19px] top-4 bottom-4 w-0.5 bg-surface-container"></div>
                        @foreach ($recentActivity as $activity)
                            <div class="relative flex gap-4">
                                <div
                                    class="z-10 w-10 h-10 rounded-full bg-white border-2 border-primary-container flex items-center justify-center shrink-0">
                                    <span
                                        class="material-symbols-outlined text-primary text-[18px]">{{ $activity->icon ?? 'history' }}</span>
                                </div>
                                <div class="flex-1 pt-1">
                                    <p class="text-body-md text-on-surface">
                                        <span class="font-bold">{{ $activity->user->name ?? 'User' }}</span>
                                        {{ $activity->description ?? 'performed an action' }}
                                    </p>
                                    <p class="text-label-sm text-on-surface-variant mt-0.5">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- Members Column --}}
        <div class="space-y-gutter-desktop">
            <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl">
                <h3 class="font-headline-md text-headline-md text-on-surface flex items-center gap-2 mb-6">
                    <span class="material-symbols-outlined text-primary">groups</span>
                    Members
                </h3>

                <div class="space-y-4">
                    {{-- Owner --}}
                    @if ($team->owner)
                        <div class="flex items-center gap-3">
                            <img src="{{ $team->owner->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($team->owner->name) . '&size=40' }}"
                                alt="{{ $team->owner->name }}" class="w-10 h-10 rounded-full object-cover">
                            <div class="flex-1">
                                <p class="font-body-lg text-on-surface leading-tight">{{ $team->owner->name }}</p>
                                <p class="text-label-sm text-on-surface-variant">Owner</p>
                            </div>
                            <span
                                class="px-2 py-0.5 bg-primary-container text-on-primary-container rounded font-label-sm text-label-sm">Owner</span>
                        </div>
                    @endif

                    {{-- Members --}}
                    @foreach ($members as $member)
                        <div x-data="{ open: false }" @click.outside="open = false" class="flex items-center gap-3 group">
                            <img src="{{ $member->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&size=40' }}"
                                alt="{{ $member->name }}" class="w-10 h-10 rounded-full object-cover">
                            <div class="flex-1">
                                <p class="font-body-lg text-on-surface leading-tight">{{ $member->name }}</p>
                                <p class="text-label-sm text-on-surface-variant">
                                    {{ ucfirst($member->pivot->role ?? 'member') }}
                                </p>
                            </div>
                            @if (auth()->id() === $team->owner_id && auth()->id() !== $member->id)
                                <div class="relative">
                                    <button @click.stop="open = !open"
                                        class="material-symbols-outlined text-on-surface-variant opacity-0 group-hover:opacity-100 transition-opacity p-1 rounded-full hover:bg-surface-container">
                                        more_vert
                                    </button>
                                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute right-0 top-8 w-48 bg-surface border border-outline-variant rounded-xl shadow-xl z-50 overflow-hidden py-1"
                                        style="display:none">
                                        <div class="border-t border-outline-variant my-1"></div>
                                        <button
                                            @click="
                                                open = false;
                                                if(confirm('Remove {{ addslashes($member->name) }} from this team?')) {
                                                    ajax.post('{{ route('teams.invite', $team) }}', { _method: 'DELETE', user_id: {{ $member->id }} })
                                                        .then(() => {
                                                            $el.closest('.group').remove();
                                                            toast('Member removed');
                                                        });
                                                }"
                                            class="w-full flex items-center gap-3 px-4 py-2.5 text-error hover:bg-error-container/20 transition-colors font-label-md text-label-md">
                                            <span class="material-symbols-outlined text-[18px]">person_remove</span>
                                            Remove Member
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Invite Member Form (owner only) --}}
                @if (auth()->id() === $team->owner_id)
                    <div x-data="{ showInvite: false, email: '', role: 'member', sending: false }" class="mt-6">
                        <button @click="showInvite = !showInvite"
                            class="w-full py-2 border-2 border-dashed border-outline-variant text-on-surface-variant rounded-lg font-label-md flex items-center justify-center gap-2 hover:border-primary hover:text-primary transition-all">
                            <span class="material-symbols-outlined text-[18px]">person_add</span>
                            Invite Member
                        </button>

                        <form x-show="showInvite" style="display:none"
                            @submit.prevent="
                                sending = true;
                                ajax.post('{{ route('teams.invite', $team) }}', { email, role })
                                    .then(res => {
                                        if(res.status === 'success') {
                                            toast('Invitation sent');
                                            showInvite = false;
                                            email = '';
                                            role = 'member';
                                        } else {
                                            toast(res.message ?? 'Error', 'error');
                                        }
                                    })
                                    .catch(() => toast('Something went wrong', 'error'))
                                    .finally(() => sending = false);
                            "
                            class="mt-4 p-4 border border-outline-variant rounded-lg space-y-3 bg-surface-container-low">
                            <div>
                                <label class="block text-label-sm text-on-surface-variant mb-1">Email Address</label>
                                <input type="email" x-model="email" required placeholder="name@company.com"
                                    class="w-full px-3 py-1.5 rounded-lg border border-outline-variant bg-white text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-label-sm text-on-surface-variant mb-1">Role</label>
                                <select x-model="role"
                                    class="w-full px-3 py-1.5 rounded-lg border border-outline-variant bg-white text-body-md">
                                    <option value="member">Member</option>
                                    <option value="admin">Admin</option>
                                    <option value="guest">Guest</option>
                                </select>
                            </div>
                            <div class="flex justify-end gap-2 pt-2">
                                <button type="button" @click="showInvite = false" :disabled="sending"
                                    class="px-3 py-1.5 border border-outline-variant rounded-lg text-label-md hover:bg-surface-container transition-colors disabled:opacity-50">
                                    Cancel
                                </button>
                                <button type="submit" :disabled="sending"
                                    class="px-4 py-1.5 bg-primary text-white rounded-lg text-label-md hover:opacity-90 transition-opacity disabled:opacity-50 flex items-center gap-2">
                                    <span x-show="!sending">Send Invite</span>
                                    <span x-show="sending" class="flex items-center gap-2">
                                        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Sending...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
