<div>
    <h2 class="text-2xl font-bold mb-4">Manajemen Keuangan</h2>

    {{-- Kartu Statistik Keuangan --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-green-100 p-6 rounded-lg shadow">
            <p class="text-sm text-green-800">Total Pemasukan</p>
            <p class="text-3xl font-bold text-green-900">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
        </div>
        <div class="bg-red-100 p-6 rounded-lg shadow">
            <p class="text-sm text-red-800">Total Pengeluaran</p>
            <p class="text-3xl font-bold text-red-900">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
        </div>
        <div class="bg-blue-100 p-6 rounded-lg shadow">
            <p class="text-sm text-blue-800">Laba Bersih</p>
            <p class="text-3xl font-bold text-blue-900">Rp {{ number_format($netProfit, 0, ',', '.') }}</p>
        </div>
    </div>

    <x-button wire:click="create()" class="mb-4">
        Tambah Transaksi
    </x-button>

    {{-- Tabel Transaksi --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keterangan</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $transaction->description }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-semibold {{ $transaction->type == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaction->type == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center py-10">Belum ada data transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $transactions->links() }}</div>

    {{-- Modal untuk Tambah Transaksi --}}
    <x-modal :isOpen="$isModalOpen">
        <x-slot name="title">Tambah Transaksi Baru</x-slot>
        <form wire:submit="save">
            <x-form.input label="Tanggal" wireModel="date" type="date" />
            <x-form.select label="Tipe Transaksi" wireModel="type">
                <option value="pengeluaran">Pengeluaran</option>
                <option value="pemasukan">Pemasukan (Manual)</option>
            </x-form.select>
            <x-form.textarea label="Keterangan" wireModel="description" />
            <x-form.input label="Jumlah (Rp)" wireModel="amount" type="number" />
        </form>
        <x-slot name="footer">
            <div class="flex justify-end">
                <x-button type="button" wire:click="closeModal()" variant="secondary" class="mr-2">Batal</x-button>
                <x-button type="button" wire:click="save">Simpan</x-button>
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