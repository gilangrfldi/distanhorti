@props(['href', 'active' => false])

@php
    // Base + "after" untuk indikator yang bisa berubah bentuk
    $base = 'relative inline-flex items-center text-md rounded-xl px-6 py-1
           transition-all duration-300 ease-in-out
           after:content-[""] after:absolute after:-bottom-1.5 after:bg-black
           after:left-1/2 after:-translate-x-1/2
           after:w-0 after:h-0 after:opacity-0
           after:transition-all after:duration-300';

    // Saat AKTIF: bold + titik hitam di tengah bawah (dan "freeze" agar hover tidak berubah jadi garis)
    $activeClasses = 'font-semibold text-gray-900
                    after:opacity-100 after:w-1.5 after:h-1.5 after:rounded-full
                    hover:after:w-1.5 hover:after:h-1.5 hover:after:rounded-full';

    // Saat INAKTIF (hover → garis bawah yang muncul dari tengah)
    $inactiveClasses = 'text-gray-800
                      hover:after:opacity-100 hover:after:w-[72%] hover:after:h-0.5 hover:after:rounded-none';
@endphp

<a href="{{ $href }}" aria-current="{{ $active ? 'page' : null }}"
    {{ $attributes->merge(['class' => $base . ' ' . ($active ? $activeClasses : $inactiveClasses)]) }}>
    {{ $slot }}
</a>
