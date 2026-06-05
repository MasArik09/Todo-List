<div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-150">
    <div class="p-6 text-gray-900">
        <div class="flex justify-between items-center mb-2">
            <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">{{ __('Completion Progress') }}</h3>
            <span class="text-sm font-bold text-indigo-600">
                {{ __(':percent% Complete', ['percent' => $progressPercent]) }}
                <span class="text-xs font-normal text-gray-500">
                    ({{ __(':completed of :total tasks', ['completed' => $completedCount, 'total' => $totalCount]) }})
                </span>
            </span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-indigo-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ $progressPercent }}%"></div>
        </div>
    </div>
</div>
