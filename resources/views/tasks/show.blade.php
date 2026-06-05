<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Task Details') }}
            </h2>
            <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                &larr; {{ __('Back to Tasks') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-start border-b pb-4 mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-950">{{ $task->title }}</h1>
                            <div class="mt-2 flex flex-wrap gap-2 items-center">
                                <!-- Category -->
                                @if ($task->category)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        {{ $task->category->name }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400 italic">{{ __('No Category') }}</span>
                                @endif

                                <!-- Priority -->
                                <x-badge :value="$task->priority" />

                                <!-- Status -->
                                <x-badge :value="$task->status" />
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-750 focus:outline-none focus:ring focus:ring-indigo-350 transition duration-150">
                                {{ __('Edit') }}
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this task?') }}');">
                                @csrf
                                @method('DELETE')
                                <x-danger-button>{{ __('Delete') }}</x-danger-button>
                            </form>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">{{ __('Due Date') }}</h3>
                            <p class="mt-1 text-sm font-semibold text-gray-900">
                                @if ($task->due_date)
                                    @php
                                        $isOverdue = $task->status === 'Pending' && \Carbon\Carbon::parse($task->due_date)->isPast() && !\Carbon\Carbon::parse($task->due_date)->isToday();
                                    @endphp
                                    <span class="{{ $isOverdue ? 'text-red-600 font-bold inline-flex items-center gap-1' : 'text-gray-900' }}">
                                        @if ($isOverdue)
                                            <svg class="h-4 w-4 inline text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            {{ __('Overdue:') }}
                                        @endif
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('F d, Y') }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic text-xs">{{ __('No due date assigned') }}</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">{{ __('Created At') }}</h3>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ $task->created_at->format('F d, Y, h:i A') }}
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="border-t pt-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">{{ __('Description') }}</h3>
                        <div class="bg-gray-50 rounded-md p-4 text-sm text-gray-800 whitespace-pre-line leading-relaxed">
                            @if ($task->description)
                                {{ $task->description }}
                            @else
                                <span class="text-gray-400 italic text-xs">{{ __('No description provided.') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
