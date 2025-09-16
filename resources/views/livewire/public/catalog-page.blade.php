<div>
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Katalog Produk</h2>

            <div class="flex justify-center space-x-4 mb-12">
                <button wire:click="setFilter('semua')" class="{{ $filterType == 'semua' ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} font-bold py-2 px-6 rounded-full shadow">Semua</button>
                <button wire:click="setFilter('dijual')" class="{{ $filterType == 'dijual' ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} font-bold py-2 px-6 rounded-full shadow">Dijual</button>
                <button wire:click="setFilter('disewakan')" class="{{ $filterType == 'disewakan' ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} font-bold py-2 px-6 rounded-full shadow">Disewakan</button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $product)
                    <a href="/produk/{{ $product->slug }}" class="block bg-white rounded-lg shadow-lg overflow-hidden group">
                        <div class="overflow-hidden">
                            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/400x300' }}" alt="{{ $product->name }}" class="w-full h-56 object-cover transform group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-6">
                            <span class="text-xs font-semibold {{ $product->type == 'dijual' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }} px-3 py-1 rounded-full">
                                {{ ucfirst($product->type) }}
                            </span>
                            <h3 class="text-xl font-semibold my-2">{{ $product->name }}</h3>
                            <p class="text-gray-800 font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-center col-span-3 text-gray-500">Tidak ada produk yang cocok dengan filter ini.</p>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </section>
</div>