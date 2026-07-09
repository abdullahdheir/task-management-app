@extends('layouts.app')

@section('title', $team->name)

@section('content')
    <div class="p-gutter-desktop">
        <div class="max-w-container-max mx-auto">
            <div class="flex justify-between items-start mb-stack-lg">
                <div>
                    <h1 class="text-headline-lg font-headline-lg text-on-surface">{{ $team->name }}</h1>
                    <p class="text-body-md text-on-surface-variant">{{ $team->description }}</p>
                </div>
                <div class="flex gap-stack-sm">
                    <a href="{{ route('teams.edit', $team) }}"
                        class="px-4 py-2 border border-outline-variant text-on-surface-variant rounded-lg font-label-md hover:bg-surface-container-low transition-colors">Edit</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-stack-lg">
                <div class="md:col-span-2">
                    <h2 class="text-title-lg font-title-lg text-on-surface mb-stack-md">Projects</h2>
                    @if ($projects->isEmpty())
                        <p class="text-body-md text-on-surface-variant">No projects yet.</p>
                    @else
                        <div class="grid grid-cols-1 gap-stack-md">
                            @foreach ($projects as $project)
                                <div class="p-stack-md border border-outline-variant rounded-lg">
                                    <h3 class="text-title-md font-title-md text-on-surface">{{ $project->name }}</h3>
                                    <p class="text-body-sm text-on-surface-variant">{{ $project->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div>
                    <h2 class="text-title-lg font-title-lg text-on-surface mb-stack-md">Members</h2>
                    <ul class="space-y-2">
                        @foreach ($members as $member)
                            <li class="flex items-center gap-2">
                                <span class="text-body-md text-on-surface">{{ $member->name }}</span>
                                <span class="text-body-sm text-on-surface-variant">({{ $member->pivot->role }})</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
