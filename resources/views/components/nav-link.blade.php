@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-4 align-middle bg-orange-600'
            : 'inline-flex items-center px-4 py-4 align-middle';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
