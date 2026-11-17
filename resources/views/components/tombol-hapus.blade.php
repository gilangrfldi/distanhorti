@props(['action'])

@php
    $formId = 'delete-form-' . uniqid();
@endphp

<form id="{{ $formId }}" action="{{ $action }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<a href="#"
    {{ $attributes->merge([
        'class' =>
            'block text-center py-3 text-red-500 font-bold hover:underline hover:text-red-600 transition-colors duration-300 ease-in-out',
    ]) }}
    onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus data ini?')) { document.getElementById('{{ $formId }}').submit(); }">
    {{ $slot }}
</a>
