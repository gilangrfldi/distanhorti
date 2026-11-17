@props(['modalTarget'])

<a href="#" type="button" data-modal-target="{{ $modalTarget }}" data-modal-show="{{ $modalTarget }}"
    {{ $attributes->merge([
        'class' =>
            'block text-center py-3 text-gray-600 font-bold hover:underline hover:text-gray-500 transition-colors duration-300 ease-in-out',
    ]) }}>
    {{ $slot }}
</a>
