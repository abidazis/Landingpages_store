<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div 
            class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" 
            style="background-image: url('{{ asset('images/login-bg.jpg') }}'); background-size: cover; background-position: center;"
        >
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="flex justify-center mb-4">
                    <a href="/">
                        <h1 class="text-3xl font-bold text-gray-800">APC Admin</h1>
                    </a>
                </div>

                {{-- Ganti {{ $slot }} menjadi @yield('content') --}}
                @yield('content')

            </div>
        </div>
    </body>
</html>