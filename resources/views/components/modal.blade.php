@props(['isOpen' => false, 'maxWidth' => '2xl'])

@php
$maxWidthClass = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

@if ($isOpen)
    {{-- Backdrop gelap di belakang --}}
    <div 
        class="fixed inset-0 z-40 bg-black bg-opacity-50"
        wire:click="closeModal()" 
        x-data 
        x-transition.opacity.duration.300ms
    ></div>

    {{-- Panel Modal --}}
    <div 
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        x-data 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        <div class="bg-white rounded-lg shadow-xl w-full {{ $maxWidthClass }} flex flex-col max-h-[90vh]">
            
            {{-- Header dengan Judul --}}
            @if (isset($title))
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h3 class="text-lg font-bold">{{ $title }}</h3>
                <button wire:click="closeModal()" class="text-gray-500 hover:text-gray-800">&times;</button>
            </div>
            @endif

            {{-- Konten Utama (Form) --}}
            <div class="px-6 py-4 flex-grow overflow-y-auto">
                {{ $slot }}
            </div>

            {{-- Footer dengan Tombol Aksi --}}
            @if (isset($footer))
            <div class="px-6 py-4 bg-gray-50 text-end rounded-b-lg">
                {{ $footer }}
            </div>
            @endif
        </div>
    </div>
@endif