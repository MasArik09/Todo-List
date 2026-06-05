@props(['type' => 'success'])

@if (session($type))
    @php
        $theme = match($type) {
            'success' => 'bg-green-50 text-green-700 border-green-200 text-green-400',
            'error', 'danger' => 'bg-red-50 text-red-700 border-red-200 text-red-400',
            'warning' => 'bg-amber-50 text-amber-700 border-amber-200 text-amber-400',
            default => 'bg-gray-50 text-gray-700 border-gray-200 text-gray-400',
        };
        $textColors = explode(' ', $theme);
        $bgBorderClass = "{$textColors[0]} {$textColors[1]} {$textColors[2]}";
        $iconColor = $textColors[3];
    @endphp
    <div {{ $attributes->merge(['class' => "mb-6 p-4 rounded-md flex items-center shadow-sm border {$bgBorderClass}"]) }}>
        @if ($type === 'success')
            <svg class="h-5 w-5 {{ $iconColor }} mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        @else
            <svg class="h-5 w-5 {{ $iconColor }} mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        @endif
        <span>{{ session($type) }}</span>
    </div>
@endif
