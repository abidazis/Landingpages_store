<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin APC' }}</title>
    
    {{-- HAPUS baris script Tailwind CDN ini, karena akan di-handle oleh @vite --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    
    {{-- Google Fonts (bisa tetap dipertahankan) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>

    {{-- TAMBAHKAN directive @vite di sini --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="bg-gray-100">

    <div x-data="{ sidebarOpen: window.innerWidth > 768 }" @resize.window="sidebarOpen = window.innerWidth > 768" class="relative min-h-screen md:flex">

        <div 
            @click="sidebarOpen = false" 
            x-show="sidebarOpen" 
            x-transition.opacity.duration.300ms
            class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"
            aria-hidden="true"
        ></div>

        <aside 
            x-show="sidebarOpen"
            x-transition:enter="transition ease-in-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white p-4 z-30 md:relative md:translate-x-0"
        >
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">APC Admin</h2>
                <button @click="sidebarOpen = false" class="md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <nav>
                <ul>
                    <li class="mb-2">
                        <x-layout.nav-link href="/admin/dashboard">Dashboard</x-layout.nav-link>
                    </li>
                    <li class="mb-2">
                        <x-layout.nav-link href="/admin/products">Manajemen Produk</x-layout.nav-link>
                    </li>
                    <li class="mb-2">
                        <x-layout.nav-link href="/admin/orders">Manajemen Pesanan</x-layout.nav-link>
                    </li>
                    <li class="mb-2">
                        <x-layout.nav-link href="/admin/finance">Manajemen Keuangan</x-layout.nav-link>
                    </li>
                    <li class="mb-2">
                        <x-layout.nav-link href="/admin/sliders">Manajemen Slider</x-layout.nav-link>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                {{-- Tombol Logout --}}
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-gray-600 hover:text-red-500 font-semibold transition duration-300">
                            Logout
                        </a>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                {{ $slot }}
            </main>
        </div>

    </div>

    @livewireScripts
</body>
</html>