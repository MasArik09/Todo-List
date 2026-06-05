@props(['value'])

@php
    $classes = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ';
    
    $colorClass = match(strtolower($value)) {
        'pending' => 'bg-yellow-100 text-yellow-800',
        'completed' => 'bg-green-100 text-green-800',
        'low' => 'bg-gray-100 text-gray-800',
        'medium' => 'bg-blue-100 text-blue-800',
        'high' => 'bg-red-100 text-red-800',
        default => 'bg-gray-100 text-gray-800',
    };
@endphp

<span {{ $attributes->merge(['class' => $classes . $colorClass]) }}>
    {{ $slot->isEmpty() ? __($value) : $slot }}
</span>
