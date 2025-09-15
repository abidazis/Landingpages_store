@props(['href'])

@php
    $isActive = request()->is(ltrim($href, '/'));
    $classes = $isActive
                ? 'block p-2 rounded bg-blue-500 text-white'
                : 'block p-2 rounded hover:bg-gray-700';
@endphp

<a href="{{ $href }}" class="{{ $classes }}">
    {{ $slot }}
</a>