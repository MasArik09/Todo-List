<div class="mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Total Tasks -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg shadow-sm p-6 flex items-center justify-between">
        <div>
            <h3 class="text-xs font-semibold uppercase tracking-wider text-blue-600">{{ __('Total Tasks') }}</h3>
            <p class="mt-2 text-3xl font-extrabold text-blue-900">{{ $totalCount }}</p>
        </div>
        <div class="p-3 bg-blue-100 rounded-full text-blue-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
    </div>

    <!-- Completed Tasks -->
    <div class="bg-green-50 border border-green-200 rounded-lg shadow-sm p-6 flex items-center justify-between">
        <div>
            <h3 class="text-xs font-semibold uppercase tracking-wider text-green-600">{{ __('Completed Tasks') }}</h3>
            <p class="mt-2 text-3xl font-extrabold text-green-900">{{ $completedCount }}</p>
        </div>
        <div class="p-3 bg-green-100 rounded-full text-green-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <!-- Pending Tasks -->
    <div class="bg-amber-50 border border-amber-200 rounded-lg shadow-sm p-6 flex items-center justify-between">
        <div>
            <h3 class="text-xs font-semibold uppercase tracking-wider text-amber-600">{{ __('Pending Tasks') }}</h3>
            <p class="mt-2 text-3xl font-extrabold text-amber-900">{{ $pendingCount }}</p>
        </div>
        <div class="p-3 bg-amber-100 rounded-full text-amber-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <!-- Overdue Tasks -->
    <div class="{{ $overdueCount > 0 ? 'bg-red-50 border-red-200' : 'bg-gray-50 border-gray-200' }} rounded-lg shadow-sm p-6 flex items-center justify-between transition-all duration-300">
        <div>
            <h3 class="text-xs font-semibold uppercase tracking-wider {{ $overdueCount > 0 ? 'text-red-600' : 'text-gray-600' }}">{{ __('Overdue Tasks') }}</h3>
            <p class="mt-2 text-3xl font-extrabold {{ $overdueCount > 0 ? 'text-red-900' : 'text-gray-900' }}">{{ $overdueCount }}</p>
        </div>
        <div class="p-3 {{ $overdueCount > 0 ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600' }} rounded-full">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
    </div>
</div>
