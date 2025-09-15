@props(['label', 'wireModel'])

<div class="mb-4">
    <label for="{{ $wireModel }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $label }}:</label>
    <textarea id="{{ $wireModel }}" {{ $attributes->merge(['class' => 'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline', 'rows' => 3]) }} wire:model="{{ $wireModel }}"></textarea>
    @error($wireModel) <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>