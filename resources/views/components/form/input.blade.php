{{-- File: resources/views/components/form/input.blade.php --}}

@props(['label', 'wireModel', 'live' => false])

<div class="mb-4">
    <label for="{{ $wireModel }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $label }}:</label>
    <input 
        id="{{ $wireModel }}" 
        {{ $attributes->merge(['class' => 'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline']) }} 
        
        {{-- Logika baru: Gunakan wire:model.live jika prop 'live' adalah true --}}
        @if ($live)
            wire:model.live="{{ $wireModel }}"
        @else
            wire:model="{{ $wireModel }}"
        @endif
    >
    @error($wireModel) <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>