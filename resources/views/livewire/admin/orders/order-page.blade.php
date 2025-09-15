<div>
    <h2 class="text-2xl font-bold mb-4">Manajemen Pesanan</h2>

    <x-button wire:click="create()" class="mb-4">
        Tambah Pesanan
    </x-button>

    {{-- Tabel Pesanan --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
             <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pelanggan</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $index => $order)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $orders->firstItem() + $index }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $order->customer_name }}</p>
                            <p class="text-gray-600 whitespace-no-wrap">{{ $order->customer_contact }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight text-green-900 bg-green-200 rounded-full">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <button wire:click="edit({{ $order->id }})" class="text-indigo-600 hover:text-indigo-900">Detail/Edit</button>
                            <button wire:click="delete({{ $order->id }})" wire:confirm="Yakin ingin menghapus pesanan ini?" class="text-red-600 hover:text-red-900 ml-4">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-10">Belum ada data pesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $orders->links() }}</div>

    {{-- Modal untuk Tambah/Edit Pesanan --}}
    <x-modal :isOpen="$isModalOpen">
        <x-slot name="title">{{ $orderId ? 'Edit Pesanan' : 'Tambah Pesanan Baru' }}</x-slot>

        <form wire:submit="save">
            {{-- Detail Pelanggan --}}
            <h4 class="font-bold text-gray-700 mb-2">Detail Pelanggan & Pesanan</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.input label="Nama Pelanggan" wireModel="customer_name" type="text" />
                <x-form.input label="Kontak (WA)" wireModel="customer_contact" type="text" />
                <x-form.input label="Tanggal Pesan" wireModel="order_date" type="date" />
                <x-form.select label="Status" wireModel="status">
                    <option value="Baru">Baru</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                </x-form.select>
            </div>
            <x-form.textarea label="Catatan" wireModel="notes" />

            {{-- Pencarian & Penambahan Produk --}}
            <h4 class="font-bold text-gray-700 mt-6 mb-2">Item Pesanan</h4>
            <div class="relative">
                <x-form.input label="Cari Produk" wireModel="searchQuery" type="text" placeholder="Ketik nama produk..." :live="true" />
                @if(!empty($searchResults))
                    <ul class="absolute z-10 w-full bg-white border border-gray-300 rounded-md mt-1 shadow-lg max-h-40 overflow-y-auto">
                        @foreach($searchResults as $product)
                            <li wire:click="addProduct({{ $product->id }})" class="p-2 cursor-pointer hover:bg-gray-100">{{ $product->name }} (Rp {{ number_format($product->price) }})</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Daftar Item yang Dipesan --}}
            <div class="mt-4 border-t pt-4">
                @forelse($orderItems as $index => $item)
                    <div class="flex justify-between items-center mb-2 p-2 bg-gray-50 rounded">
                        <div>
                            <p class="font-semibold">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-600">Rp {{ number_format($item['price']) }}</p>
                        </div>
                        <div class="flex items-center">
                            <input type="number" wire:model="orderItems.{{ $index }}.quantity" wire:change="calculateTotal" class="w-16 text-center border rounded mx-2">
                            <button type="button" wire:click="removeProduct({{ $index }})" class="text-red-500 hover:text-red-700">&times;</button>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada produk yang ditambahkan.</p>
                @endforelse
            </div>
        
        
        {{-- Total Harga --}}
        <div class="text-right font-bold text-xl mt-4">
            Total: ...
        </div>

        </form> {{-- Form ditutup di sini --}}

        {{-- Tombol dipindahkan ke slot footer, DI LUAR form --}}
        <x-slot name="footer">
            <div class="flex items-center justify-end">
                <x-button type="button" wire:click="closeModal()" variant="secondary" class="mr-2">
                    Batal
                </x-button>
                {{-- Tombol simpan ini akan tetap men-trigger form karena berada dalam satu komponen Livewire --}}
                <x-button type="button" wire:click="save"> 
                    Simpan Pesanan
                </x-button>
            </div>
        </x-slot>
    </x-modal>
    
    {{-- Notifikasi --}}
    @if (session()->has('message'))
        <div class="fixed bottom-5 right-5 bg-green-500 text-white py-2 px-4 rounded-lg shadow-lg">
            {{ session('message') }}
        </div>
    @endif
</div>