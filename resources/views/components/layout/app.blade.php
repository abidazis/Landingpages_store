<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'APC - Atribut Paskibra Cikarang' }}</title>

    {{-- Tailwind CSS & Alpine.js via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts (Poppins) untuk tipografi yang lebih modern --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>

    @livewireStyles
</head>
<body class="bg-white text-gray-800">
    <x-public.navbar /> {{-- Panggil Navbar di sini --}}

    <main>
        {{ $slot }}
    </main>

    <x-public.footer /> {{-- Panggil Footer di sini --}}

    @livewireScripts
</body>
</html>