@extends('layouts.master')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="mb-8">
                <a href="{{ route('tasks.index') }}"
                    class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4 transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Tasks
                </a>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Task Details</h1>
                <p class="text-gray-600">View and manage your task</p>
            </div>

            <div class="space-y-6">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 h-12 w-12">
                            @if ($task->status === 'completed')
                                <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            @elseif($task->status === 'doing')
                                <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="h-12 w-12 rounded-full bg-gray-100 flex items-center justify-center">
                                    <svg class="h-7 w-7 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $task->title }}</h2>
                            <div class="flex items-center space-x-2">
                                @if ($task->status === 'completed')
                                    <span
                                        class="px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Completed</span>
                                @elseif($task->status === 'doing')
                                    <span class="px-3 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">In
                                        Progress</span>
                                @else
                                    <span
                                        class="px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-full">Pending</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Started At</span>
                        <p class="mt-1 text-sm font-medium text-gray-900">
                            {{ $task->started_at?->format('M d, Y H:i') ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Completed At</span>
                        <p class="mt-1 text-sm font-medium text-gray-900">
                            {{ $task->completed_at?->format('M d, Y H:i') ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Created At</span>
                        <p class="mt-1 text-sm font-medium text-gray-900">{{ $task->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Updated At</span>
                        <p class="mt-1 text-sm font-medium text-gray-900">{{ $task->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex flex-wrap gap-3">
                    <form action="{{ route('tasks.toggle-status', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white transition duration-200
                            @if ($task->status === 'pending') bg-blue-500 hover:bg-blue-600
                            @elseif($task->status === 'doing') bg-green-500 hover:bg-green-600
                            @else bg-yellow-500 hover:bg-yellow-600 @endif">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if ($task->status === 'pending')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                @elseif($task->status === 'doing')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                @endif
                            </svg>
                            @if ($task->status === 'pending')
                                Start
                            @elseif($task->status === 'doing')
                                Complete
                            @else
                                Restart
                            @endif
                        </button>
                    </form>
                    <a href="{{ route('tasks.edit', $task->id) }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 transition duration-200"
                            onclick="return confirm('Are you sure you want to delete this task?')">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
