@props(['href', 'active' => false, 'icon'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center p-2 font-bold rounded-lg text-gray-900 group transition-all duration-300 ease-in-out'
            : 'flex items-center p-2 text-gray-600 rounded-lg group hover:text-gray-700 transition-all duration-300 ease-in-out';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    <x-icon>{{ $icon }}</x-icon>
    {{-- Teks (Slot) --}}
    <span class="ms-3">{{ $slot }}</span>
</a>
