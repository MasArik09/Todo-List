@props(['title', 'description', 'actionUrl' => null, 'actionText' => null])

<div {{ $attributes->merge(['class' => 'text-center py-12']) }}>
    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
    </svg>
    <h3 class="mt-2 text-sm font-medium text-gray-900">{{ __($title) }}</h3>
    <p class="mt-1 text-sm text-gray-500">{{ __($description) }}</p>
    @if ($actionUrl && $actionText)
        <div class="mt-6">
            <a href="{{ $actionUrl }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-750 focus:outline-none focus:ring focus:ring-indigo-300 transition duration-150 shadow-sm">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                {{ __($actionText) }}
            </a>
        </div>
    @endif
</div>
