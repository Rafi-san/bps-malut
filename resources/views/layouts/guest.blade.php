<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="relative min-h-screen flex flex-col items-center justify-center px-4 py-10 overflow-hidden bg-gradient-to-br from-blue-900 via-blue-800 to-sky-700">

            {{-- Dekorasi lingkaran blur di latar --}}
            <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-sky-400/20 blur-3xl"></div>
            <div class="absolute -bottom-32 -right-24 w-[28rem] h-[28rem] rounded-full bg-blue-300/20 blur-3xl"></div>

            <div class="relative w-full sm:max-w-md">
                {{-- Logo dan judul --}}
                <div class="text-center mb-6">
                    <a href="/" class="inline-block bg-white rounded-2xl p-3 shadow-lg">
                        <img src="{{ asset('images/logo-bps.png') }}" alt="Logo BPS" class="h-16 w-auto">
                    </a>
                    <h1 class="mt-4 text-2xl font-semibold text-white">Sistem Publikasi BPS</h1>
                    <p class="text-sm text-blue-100">Provinsi Maluku Utara</p>
                </div>

                {{-- Kartu form (isi login/register masuk di sini) --}}
                <div class="bg-white shadow-2xl rounded-2xl px-6 py-6 sm:px-8">
                    {{ $slot }}
                </div>

                <p class="mt-6 text-center text-xs text-blue-200">
                    &copy; {{ date('Y') }} BPS Provinsi Maluku Utara
                </p>
            </div>
        </div>
    </body>
</html>
