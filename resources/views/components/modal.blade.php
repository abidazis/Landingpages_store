@props(['isOpen'])

@if ($isOpen)
    {{-- Backdrop --}}
    <div class="fixed inset-0 z-30 flex items-center justify-center bg-black bg-opacity-50 p-4 overflow-y-auto">
        
        {{-- Panel Modal: kita gunakan flexbox vertikal --}}
        <div 
            @click.outside="$wire.closeModal()" 
            {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-lg w-full max-w-lg flex flex-col max-h-[90vh]']) }}
        >
            
            {{-- 1. Bagian Header (Judul) - Tidak bisa di-scroll --}}
            @if (isset($title))
                <div class="p-6 border-b">
                    <h3 class="text-lg font-bold">{{ $title }}</h3>
                </div>
            @endif
            
            {{-- 2. Bagian Konten Utama - INI YANG BISA DI-SCROLL --}}
            <div class="p-6 flex-grow overflow-y-auto">
                {{ $slot }}
            </div>

            {{-- 3. Bagian Footer (Tombol Aksi) - Tidak bisa di-scroll --}}
            @if (isset($footer))
                <div class="p-6 border-t bg-gray-50 rounded-b-lg">
                    {{ $footer }}
                </div>
            @endif

        </div>
    </div>
@endif