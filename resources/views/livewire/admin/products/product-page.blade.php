<div>
    <h2 class="text-2xl font-bold mb-4">Manajemen Produk</h2>

    {{-- Tombol untuk menambah produk baru --}}
    <button wire:click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
        Tambah Produk
    </button>

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
                            <button class="text-indigo-600 hover:text-indigo-900">Edit</button>
                            <button class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
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

    {{-- Modal untuk Tambah/Edit Produk --}}
    @if ($isModalOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
                <h3 class="text-lg font-bold mb-4">Tambah Produk Baru</h3>
                <form wire:submit="save">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Produk:</label>
                        <input type="text" id="name" wire:model="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
                        <textarea id="description" wire:model="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Harga:</label>
                            <input type="number" id="price" wire:model="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="stock" class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
                            <input type="number" id="stock" wire:model="stock" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('stock') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Tipe:</label>
                        <select id="type" wire:model="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="dijual">Dijual</option>
                            <option value="disewakan">Disewakan</option>
                        </select>
                        @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="button" wire:click="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Notifikasi Sukses --}}
    @if (session()->has('message'))
        <div class="fixed bottom-5 right-5 bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg">
            {{ session('message') }}
        </div>
    @endif
    {{-- Link Paginasi --}}
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>