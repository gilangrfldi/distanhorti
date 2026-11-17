@props([
    'class' => '',
])

<span {{ $attributes->merge(['class' => 'material-icons-outlined ' . $class]) }}>
    {{ $slot }}
</span>
