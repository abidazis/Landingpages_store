<div>
    <h2 class="text-2xl font-bold mb-4">Manajemen Hero Slider</h2>
    <x-button wire:click="create()" class="mb-4">Tambah Slider</x-button>

    {{-- Tabel Slider --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
         <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Gambar</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sliders as $slider)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><img src="{{ $slider->image_url }}" alt="Slider" class="w-32 h-16 object-cover rounded"></td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $slider->title }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $slider->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <button wire:click="edit({{ $slider->id }})" class="text-indigo-600">Edit</button>
                        <button wire:click="delete({{ $slider->id }})" wire:confirm="Yakin ingin hapus?" class="text-red-600 ml-4">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-10">Belum ada slider.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    <x-modal :isOpen="$isModalOpen">
        <x-slot name="title">{{ $sliderId ? 'Edit Slider' : 'Tambah Slider Baru' }}</x-slot>
        
        {{-- Tambahkan enctype untuk upload file --}}
        <form wire:submit="save" enctype="multipart/form-data">

            {{-- Input File Gambar dengan Preview --}}
            <div class="mb-4">
                <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2">Upload Gambar:</label>
                
                {{-- Tampilkan preview gambar --}}
                @if ($image_url)
                    <p>Preview:</p>
                    <img src="{{ $image_url->temporaryUrl() }}" class="w-full h-40 object-cover rounded mb-2">
                @elseif($existing_image_url)
                    <p>Gambar Saat Ini:</p>
                    <img src="{{ $existing_image_url }}" class="w-full h-40 object-cover rounded mb-2">
                @endif

                <input type="file" id="image_url" wire:model="image_url" class="w-full">
                
                {{-- Indikator loading saat upload --}}
                <div wire:loading wire:target="image_url" class="text-sm text-gray-500 mt-1">Uploading...</div>
                
                @error('image_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <x-form.input label="Judul (Opsional)" wireModel="title" type="text" />
            <x-form.textarea label="Sub Judul (Opsional)" wireModel="subtitle" />
            <label class="inline-flex items-center mt-3">
                <input type="checkbox" class="h-5 w-5 text-blue-600" wire:model="is_active"><span class="ml-2 text-gray-700">Aktif</span>
            </label>
        </form>
        <x-slot name="footer">
            <div class="flex justify-end">
                <x-button type="button" wire:click="closeModal()" variant="secondary" class="mr-2">Batal</x-button>
                <x-button type="button" wire:click="save">Simpan</x-button>
            </div>
        </x-slot>
    </x-modal>
</div>