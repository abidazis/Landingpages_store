<div>
    <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

    {{-- Grid untuk menampung kartu statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
            <div class="bg-blue-500 p-3 rounded-full text-white mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-600">Total Produk</p>
                <p class="text-2xl font-bold">{{ $totalProducts }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
            <div class="bg-green-500 p-3 rounded-full text-white mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-600">Produk Dijual</p>
                <p class="text-2xl font-bold">{{ $productsForSale }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
            <div class="bg-yellow-500 p-3 rounded-full text-white mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-600">Produk Disewakan</p>
                <p class="text-2xl font-bold">{{ $productsForRent }}</p>
            </div>
        </div>

    </div>
</div>