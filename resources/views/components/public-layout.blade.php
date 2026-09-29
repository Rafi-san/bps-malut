@props(['title' => 'BPS Provinsi Maluku Utara'])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800 flex flex-col min-h-screen">

@php
    $links = [
        ['Beranda', route('home'), request()->routeIs('home')],
        ['Katalog Publikasi', route('katalog.index'), request()->routeIs('katalog.*')],
        ['Galeri Kegiatan', route('galeri.index'), request()->routeIs('galeri.*')],
    ];
@endphp

<nav x-data="{ open: false }" class="bg-bps-blue text-white sticky top-0 z-50 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-bps.png') }}" alt="Logo BPS" class="h-9 w-9">
                <div class="leading-tight">
                    <div class="font-bold text-sm">BADAN PUSAT STATISTIK</div>
                    <div class="text-xs text-blue-200">Provinsi Maluku Utara</div>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-6 text-sm">
                @foreach ($links as [$label, $url, $active])
                    <a href="{{ $url }}"
                       class="py-1 {{ $active ? 'border-b-2 border-white' : 'text-blue-200 hover:text-white' }}">{{ $label }}</a>
                @endforeach

                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white text-bps-blue font-semibold px-4 py-2 rounded hover:bg-blue-50">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-bps-blue font-semibold px-4 py-2 rounded hover:bg-blue-50">Masuk</a>
                @endauth
            </div>

            <button @click="open = !open" class="md:hidden p-2" aria-label="Menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" style="display: none;" class="md:hidden border-t border-blue-800 px-4 py-3 space-y-2 text-sm">
        @foreach ($links as [$label, $url, $active])
            <a href="{{ $url }}" class="block py-1 {{ $active ? 'font-semibold' : 'text-blue-200' }}">{{ $label }}</a>
        @endforeach
        @auth
            <a href="{{ route('dashboard') }}" class="block py-1 font-semibold">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="block py-1 font-semibold">Masuk</a>
        @endauth
    </div>
</nav>

@isset($header)
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">{{ $header }}</div>
    </header>
@endisset

<main class="flex-1">{{ $slot }}</main>

<footer class="bg-bps-blue text-blue-100 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid gap-8 md:grid-cols-3 text-sm">
        <div>
            <div class="flex items-center gap-3 mb-3">
                <img src="{{ asset('images/logo-bps.png') }}" alt="Logo BPS" class="h-10 w-10">
                <div class="font-bold text-white leading-tight">BPS Provinsi<br>Maluku Utara</div>
            </div>
            <p>Penyedia data dan informasi statistik resmi untuk wilayah Maluku Utara.</p>
        </div>
        <div>
            <div class="font-semibold text-white mb-3">Hubungi Kami</div>
            <p>Jl. Stadion No 65, Ternate 97712</p>
            <p>Telp (0921) 3127878</p>
            <p>Faks (0921) 3126301</p>
            <p>bps8200@bps.go.id</p>
        </div>
        <div>
            <div class="font-semibold text-white mb-3">Tautan</div>
            <ul class="space-y-1">
                <li><a href="{{ route('katalog.index') }}" class="hover:text-white">Katalog Publikasi</a></li>
                <li><a href="{{ route('galeri.index') }}" class="hover:text-white">Galeri Kegiatan</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-white">Masuk Admin</a></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-blue-800 text-center text-xs py-4">
        &copy; {{ now()->year }} BPS Provinsi Maluku Utara
    </div>
</footer>

</body>
</html>