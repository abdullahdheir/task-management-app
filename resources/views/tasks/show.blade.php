@extends('layouts.master')
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Task Details</h1>
            <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:text-gray-800">Back to Tasks</a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="mb-4">
                <span class="text-gray-500 text-sm">ID</span>
                <p class="text-gray-900 font-semibold">{{ $task->id }}</p>
            </div>

            <div class="mb-4">
                <span class="text-gray-500 text-sm">Title</span>
                <p class="text-gray-900 font-semibold">{{ $task->title }}</p>
            </div>

            <div class="mb-4">
                <span class="text-gray-500 text-sm">Status</span>
                <p class="text-gray-900">
                    @if ($task->status === 'completed')
                        <span
                            class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Completed</span>
                    @elseif($task->status === 'doing')
                        <span class="px-2 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">In
                            Progress</span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-full">Pending</span>
                    @endif
                </p>
            </div>

            <div class="mb-4">
                <span class="text-gray-500 text-sm">Started At</span>
                <p class="text-gray-900">{{ $task->started_at?->format('M d, Y H:i') ?? '-' }}</p>
            </div>

            <div class="mb-4">
                <span class="text-gray-500 text-sm">Completed At</span>
                <p class="text-gray-900">{{ $task->completed_at?->format('M d, Y H:i') ?? '-' }}</p>
            </div>

            <div class="mb-4">
                <span class="text-gray-500 text-sm">Created At</span>
                <p class="text-gray-900">{{ $task->created_at->format('M d, Y H:i') }}</p>
            </div>

            <div class="mb-4">
                <span class="text-gray-500 text-sm">Updated At</span>
                <p class="text-gray-900">{{ $task->updated_at->format('M d, Y H:i') }}</p>
            </div>

            <div class="mt-6 pt-6 border-t">
                <form action="{{ route('tasks.toggle-status', $task->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-3 transition duration-200">
                        {{ $task->status === 'completed' ? 'Mark Pending' : 'Mark Complete' }}
                    </button>
                </form>
                <a href="{{ route('tasks.edit', $task->id) }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-3 transition duration-200">
                    Edit
                </a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-200"
                        onclick="return confirm('Are you sure you want to delete this task?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
