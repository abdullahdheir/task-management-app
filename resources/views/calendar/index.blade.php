@extends('layouts.app')

@section('title', 'Calendar')

@push('styles')
    <style>
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-template-rows: auto repeat(5, 1fr);
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
@endpush

@section('content')

    {{-- Calendar Controls --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-4">
            <h2 class="font-headline-lg text-headline-lg text-on-surface">
                {{ $monthLabel ?? now()->format('F Y') }}
            </h2>
            <div class="flex bg-surface-container-low rounded-lg p-1">
                <a href="{{ route('calendar.index', ['month' => $prevMonth ?? now()->subMonth()->format('Y-m')]) }}"
                    class="p-1 hover:bg-surface-container-highest rounded-md transition-colors">
                    <span class="material-symbols-outlined">chevron_left</span>
                </a>
                <a href="{{ route('calendar.index', ['month' => $nextMonth ?? now()->addMonth()->format('Y-m')]) }}"
                    class="p-1 hover:bg-surface-container-highest rounded-md transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </a>
            </div>
            <a href="{{ route('calendar.index') }}"
                class="px-4 py-2 text-label-md font-bold text-primary hover:bg-primary-fixed rounded-lg transition-colors">
                Today
            </a>
        </div>

        <div class="flex items-center gap-2 bg-surface-container-low p-1 rounded-xl">
            <button
                class="px-6 py-2 rounded-lg text-label-md font-bold transition-all bg-surface shadow-sm text-primary">Month</button>
            <button
                class="px-6 py-2 rounded-lg text-label-md font-medium text-on-surface-variant hover:text-on-surface transition-all">Week</button>
        </div>
    </div>

    {{-- Calendar Grid --}}
    <div class="bg-surface border border-outline-variant rounded-2xl shadow-sm overflow-hidden flex flex-col"
        style="min-height: 600px;">

        {{-- Day Headers --}}
        <div class="grid grid-cols-7 border-b border-outline-variant bg-surface-container-lowest">
            @foreach (['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'] as $day)
                <div class="py-3 text-center text-label-sm font-bold text-on-surface-variant">{{ $day }}</div>
            @endforeach
        </div>

        {{-- Days Grid --}}
        <div class="flex-1 grid grid-cols-7 auto-rows-fr">
            @forelse($calendarDays ?? [] as $day)
                @php
                    $dayDate = $day['day']
                        ? Carbon::parse($monthLabel ?? now()->format('F Y'))->setDay($day['day'])
                        : null;
                @endphp
                <div class="border-r border-b border-outline-variant p-2 transition-colors cursor-pointer group min-h-[120px]
                    {{ $day['current_month'] ? 'hover:bg-surface-container-low' : 'bg-surface-container-low opacity-40' }}
                    {{ $day['is_today'] ? 'bg-primary-fixed/20' : '' }}"
                    @click="window.location.href = '{{ $dayDate ? route('tasks.index', ['due_from' => $dayDate->format('Y-m-d'), 'due_to' => $dayDate->format('Y-m-d')]) : '#' }}'">

                    <span
                        class="text-label-md {{ $day['is_today'] ? 'font-black text-white bg-primary w-6 h-6 flex items-center justify-center rounded-full -ml-1' : 'font-bold' }}">
                        {{ $day['day'] }}
                    </span>

                    @if (!empty($day['events']))
                        <div class="mt-2 space-y-1">
                            @foreach ($day['events'] as $event)
                                <a href="{{ route('tasks.show', $event['id'] ?? '#') }}" @click.stop
                                    class="block px-2 py-1 rounded {{ $event['color'] }} text-[10px] font-bold truncate hover:opacity-80 transition-opacity">
                                    {{ $event['title'] }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-7 flex items-center justify-center py-12">
                    <div class="text-center">
                        <span class="material-symbols-outlined text-on-surface-variant text-5xl mb-3">calendar_today</span>
                        <p class="text-on-surface-variant font-body-md">No calendar data available</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

@endsection
