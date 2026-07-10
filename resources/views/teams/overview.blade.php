@extends('layouts.app')

@section('title', 'Teams Overview')

@section('content')
    {{-- Page Header --}}
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

    {{-- Stats Overview --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter-desktop mb-stack-lg">
        <div class="md:col-span-1 bg-surface-container-lowest border border-outline-variant p-stack-lg rounded-xl flex flex-col justify-between">
            <span class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">Active Teams</span>
            <div class="mt-4">
                <span class="text-4xl font-bold text-on-surface">{{ $teams->total() }}</span>
                <div class="mt-2 text-secondary font-label-sm text-label-sm flex items-center">
                    <span class="material-symbols-outlined text-[16px] mr-1">groups</span>
                    Your workspaces
                </div>
            </div>
        </div>
        <div class="md:col-span-1 bg-surface-container-lowest border border-outline-variant p-stack-lg rounded-xl flex flex-col justify-between">
            <span class="text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">Total Members</span>
            <div class="mt-4">
                @php
                    $totalMembers = $teams->sum(fn($t) => $t->members->count() + 1);
                @endphp
                <span class="text-4xl font-bold text-on-surface">{{ $totalMembers }}</span>
                <div class="mt-2 text-on-surface-variant font-label-sm text-label-sm">Across all workspaces</div>
            </div>
        </div>
        <div class="md:col-span-2 bg-primary text-on-primary p-stack-lg rounded-xl relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="font-headline-md text-headline-md mb-2">Collaborate Better</h3>
                <p class="font-body-md text-body-md opacity-90 max-w-xs">Invite teammates, assign roles, and launch
                    your next project together.</p>
                <a href="{{ route('teams.create') }}"
                    class="mt-4 inline-block bg-white text-primary px-4 py-2 rounded-lg font-label-md text-label-md hover:shadow-xl transition-shadow">
                    New Team
                </a>
            </div>
            <div class="absolute right-[-20px] bottom-[-20px] opacity-10">
                <span class="material-symbols-outlined text-[120px]">rocket_launch</span>
            </div>
        </div>
    </div>

    {{-- Teams Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter-desktop">
        @forelse($teams as $team)
            <div x-data="{ open: false }" @click.outside="open = false"
                class="bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg flex flex-col hover:shadow-lg transition-all group relative">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-12 h-12 rounded-lg bg-primary-container/20 flex items-center justify-center text-primary border border-primary-container">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">groups</span>
                    </div>
                    <div class="relative">
                        <button @click.stop="open = !open"
                            class="text-on-surface-variant hover:text-primary transition-colors p-1 rounded-full hover:bg-surface-container">
                            <span class="material-symbols-outlined">more_vert</span>
                        </button>
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 top-8 w-48 bg-surface border border-outline-variant rounded-xl shadow-xl z-50 overflow-hidden py-1"
                            style="display:none">
                            <a href="{{ route('teams.show', $team) }}"
                                class="flex items-center gap-3 px-4 py-2.5 text-on-surface hover:bg-surface-container transition-colors font-label-md text-label-md">
                                <span class="material-symbols-outlined text-[18px] text-secondary">open_in_new</span>
                                View Team
                            </a>
                            @if(auth()->id() === $team->owner_id)
                                <a href="{{ route('teams.edit', $team) }}"
                                    class="flex items-center gap-3 px-4 py-2.5 text-on-surface hover:bg-surface-container transition-colors font-label-md text-label-md">
                                    <span class="material-symbols-outlined text-[18px] text-secondary">edit</span>
                                    Edit Team
                                </a>
                                <div class="border-t border-outline-variant my-1"></div>
                                <button
                                    @click="
                                        open = false;
                                        if(confirm('Delete {{ addslashes($team->name) }}?')) {
                                            ajax.delete('{{ route('teams.destroy', $team) }}')
                                                .then(res => {
                                                    if(res.status === 'success') {
                                                        $el.closest('.group').remove();
                                                        toast('Team deleted');
                                                    } else {
                                                        toast(res.message ?? 'Error', 'error');
                                                    }
                                                });
                                        }"
                                    class="w-full flex items-center gap-3 px-4 py-2.5 text-error hover:bg-error-container/20 transition-colors font-label-md text-label-md">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                    Delete Team
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <a href="{{ route('teams.show', $team) }}" class="flex-1 flex flex-col">
                    <h4 class="font-headline-md text-headline-md text-on-surface group-hover:text-primary transition-colors mb-1">
                        {{ $team->name }}
                    </h4>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-2 mb-6 line-clamp-2">
                        {{ $team->description ?? 'No description provided.' }}
                    </p>
                </a>

                <div class="mt-auto">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex -space-x-3 overflow-hidden">
                            {{-- Owner always shown first --}}
                            @if($team->owner)
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white object-cover"
                                    src="{{ $team->owner->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($team->owner->name) . '&size=32' }}"
                                    alt="{{ $team->owner->name }}"
                                    title="{{ $team->owner->name }} (owner)">
                            @endif
                            @foreach($team->members->take(3) as $member)
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white object-cover"
                                    src="{{ $member->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&size=32' }}"
                                    alt="{{ $member->name }}"
                                    title="{{ $member->name }}">
                            @endforeach
                            @if($team->members->count() > 3)
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-surface-container-high ring-2 ring-white text-[10px] font-bold text-on-surface-variant">
                                    +{{ $team->members->count() - 3 }}
                                </div>
                            @endif
                        </div>
                        <span class="font-label-sm text-label-sm text-on-surface-variant">
                            {{ $team->members->count() + 1 }} {{ Str::plural('member', $team->members->count() + 1) }}
                        </span>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('teams.show', $team) }}"
                            class="flex-1 py-2.5 rounded-lg border border-primary text-primary font-label-md text-label-md hover:bg-primary hover:text-on-primary transition-all text-center">
                            View Team
                        </a>
                        @if(auth()->id() === $team->owner_id)
                            <a href="{{ route('teams.edit', $team) }}"
                                class="px-3 py-2.5 rounded-lg border border-outline-variant text-on-surface-variant font-label-md hover:bg-surface-container transition-colors"
                                title="Edit">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-16 text-on-surface-variant">
                <span class="material-symbols-outlined text-5xl mb-3">groups</span>
                <p class="font-body-md mb-4">You haven't joined any teams yet.</p>
                <a href="{{ route('teams.create') }}"
                    class="px-6 py-3 bg-primary text-on-primary rounded-lg font-label-md inline-block hover:opacity-90 transition-all">
                    Create Your First Team
                </a>
            </div>
        @endforelse

        {{-- CTA Card: always shown if teams exist --}}
        @if($teams->isNotEmpty())
            <a href="{{ route('teams.create') }}"
                class="border-2 border-dashed border-outline-variant rounded-xl p-stack-lg flex flex-col items-center justify-center text-center group cursor-pointer hover:border-primary transition-all bg-surface-container-lowest/50">
                <div class="w-16 h-16 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant group-hover:bg-primary-container group-hover:text-on-primary transition-all mb-4">
                    <span class="material-symbols-outlined text-[32px]">add_circle</span>
                </div>
                <h4 class="font-headline-md text-headline-md text-on-surface">Start a New Team</h4>
                <p class="font-body-md text-body-md text-on-surface-variant mt-2 max-w-[200px]">Invite collaborators and launch
                    your next project.</p>
            </a>
        @endif
    </div>

    {{-- Pagination --}}
    @if($teams->hasPages())
        <div class="mt-stack-lg">
            {{ $teams->links() }}
        </div>
    @endif

@endsection
