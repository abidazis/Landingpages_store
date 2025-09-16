{{-- x-data="{ open: false }" adalah state awal dari menu (tertutup) --}}
<header x-data="{ open: false }" class="bg-white shadow-md sticky top-0 z-20">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="text-xl font-bold text-gray-800">
            <a href="/">APC</a>
        </div>
        
        {{-- Menu untuk Desktop --}}
        <div class="hidden md:flex space-x-8">
            <a href="/" class="text-gray-600 hover:text-blue-500">Beranda</a>
            <a href="/katalog" class="text-gray-600 hover:text-blue-500">Katalog</a>
            <a href="#kontak" class="text-gray-600 hover:text-blue-500">Kontak</a>
        </div>

        {{-- Tombol Hamburger untuk Mobile --}}
        {{-- @click="open = !open" akan mengubah state 'open' saat diklik --}}
        <div class="md:hidden">
            <button @click="open = !open" class="text-gray-800 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m4 6H4"></path></svg>
            </button>
        </div>
    </nav>

    {{-- Menu Dropdown untuk Mobile --}}
    {{-- x-show="open" berarti elemen ini hanya tampil jika state 'open' adalah true --}}
    <div x-show="open" @click.away="open = false" class="md:hidden bg-white shadow-lg">
        <a href="/" class="block px-6 py-3 text-gray-600 hover:bg-gray-100">Beranda</a>
        <a href="/katalog" class="block px-6 py-3 text-gray-600 hover:bg-gray-100">Katalog</a>
        <a href="#kontak" class="block px-6 py-3 text-gray-600 hover:bg-gray-100">Kontak</a>
    </div>
</header>