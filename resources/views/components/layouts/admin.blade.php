<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin APC' }}</title>
    {{-- Kita akan menggunakan CDN TailwindCSS untuk sementara agar cepat --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto">
            <h1 class="font-bold text-xl">Admin Panel - Atribut Paskibra Cikarang</h1>
        </div>
    </nav>

    <main class="container mx-auto p-4 mt-4">
        {{-- Semua konten halaman akan muncul di sini --}}
        {{ $slot }}
    </main>
</body>
</html>