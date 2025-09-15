<div>
    <h2 class="text-2xl font-bold mb-4">Manajemen Produk</h2>

    {{-- Tombol untuk menambah produk baru, sekarang memanggil method "create" --}}
    <x-button wire:click="create()" class="mb-4">
        Tambah Produk
    </x-button>

    {{-- Tabel untuk menampilkan produk --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Produk</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipe</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Harga</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stok</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $index => $product)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $products->firstItem() + $index }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $product->name }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight {{ $product->type == 'dijual' ? 'text-green-900 bg-green-200' : 'text-blue-900 bg-blue-200' }} rounded-full">
                                {{ ucfirst($product->type) }}
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $product->stock }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{-- Tombol Edit & Hapus yang sudah fungsional --}}
                            <button wire:click="edit({{ $product->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button wire:click="delete({{ $product->id }})" wire:confirm="Apakah Anda yakin ingin menghapus produk '{{ $product->name }}'?" class="text-red-600 hover:text-red-900 ml-4">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-10">Tidak ada data produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Link Paginasi --}}
    <div class="mt-4">
        {{ $products->links() }}
    </div>

    {{-- Komponen Modal yang sudah benar --}}
    <x-modal :isOpen="$isModalOpen">
        {{-- Slot untuk judul, sekarang berada DI DALAM komponen modal dan dinamis --}}
        <x-slot name="title">
            {{ $productId ? 'Edit Produk' : 'Tambah Produk Baru' }}
        </x-slot>

        <form wire:submit="save">
            <x-form.input label="Nama Produk" wireModel="name" type="text" />
            <x-form.textarea label="Deskripsi" wireModel="description" />
            
            <div class="grid grid-cols-2 gap-4">
                <x-form.input label="Harga" wireModel="price" type="number" />
                <x-form.input label="Stok" wireModel="stock" type="number" />
            </div>

            <x-form.select label="Tipe" wireModel="type">
                <option value="dijual">Dijual</option>
                <option value="disewakan">Disewakan</option>
            </x-form.select>

            <div class="flex items-center justify-end mt-4">
                <x-button type="button" wire:click="closeModal()" variant="secondary" class="mr-2">
                    Batal
                </x-button>
                <x-button type="submit">
                    Simpan
                </x-button>
            </div>
        </form>
    </x-modal>

    {{-- Notifikasi Sukses --}}
    @if (session()->has('message'))
        <div class="fixed bottom-5 right-5 bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg">
            {{ session('message') }}
        </div>
    @endif
</div>