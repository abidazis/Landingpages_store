@props(['variant' => 'primary'])

@php
    $baseClass = 'font-bold py-2 px-4 rounded';
    $variantClass = [
        'primary' => 'bg-blue-500 hover:bg-blue-700 text-white',
        'secondary' => 'bg-gray-500 hover:bg-gray-700 text-white',
        'danger' => 'bg-red-500 hover:bg-red-700 text-white',
    ][$variant];
@endphp

<button {{ $attributes->merge(['class' => $baseClass . ' ' . $variantClass]) }}>
    {{ $slot }}
</button>