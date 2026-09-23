<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow rounded p-6">
                <h3 class="text-lg font-semibold text-gray-800">Selamat datang, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600 mt-1">Ini adalah sistem pengelolaan publikasi BPS Provinsi Maluku Utara.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-blue-900 text-white rounded p-6 text-center">
                    <div class="text-3xl font-bold">{{ $totalPublikasi }}</div>
                    <div class="text-sm opacity-80 mt-1">Total Publikasi Tersimpan</div>
                    <a href="{{ route('publikasi.index') }}" class="text-sm underline mt-2 inline-block">Lihat semua &rarr;</a>
                </div>
                <div class="bg-blue-900 text-white rounded p-6 text-center">
                    <div class="text-3xl font-bold">+</div>
                    <div class="text-sm opacity-80 mt-1">Tambah Publikasi Baru</div>
                    <a href="{{ route('publikasi.create') }}" class="text-sm underline mt-2 inline-block">Tambah sekarang &rarr;</a>
                </div>
            </div>

            <div class="bg-white shadow rounded p-6">
                <h3 class="text-lg font-semibold text-gray-800">Inflasi Kota Ternate (2022=100)</h3>
                <p class="text-xs text-gray-400 mb-4">Sumber: Web API BPS Pusat (webapi.bps.go.id)</p>

                @if ($bpsError)
                    <p class="text-red-600 text-sm">{{ $bpsError }}</p>
                @else
                    <div class="flex flex-wrap gap-3">
                        @foreach ($bpsData as $item)
                        <div class="bg-gray-50 rounded p-4 text-center min-w-[120px]">
                            <div class="text-xl font-bold text-blue-900">{{ $item['value'] }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $item['label'] }}</div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Publikasi Terbaru</h3>
                <div class="flex flex-wrap gap-4">
                    @forelse ($terbaru as $pub)
                    <div class="bg-white shadow rounded p-4 w-48 text-center">
                        @if ($pub->sampul)
                            <img src="{{ asset('storage/' . $pub->sampul) }}" class="mx-auto mb-2 h-24 object-cover">
                        @endif
                        <div class="text-sm font-semibold text-blue-900">{{ $pub->judul }}</div>
                        <div class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($pub->tanggal_rilis)->translatedFormat('d F Y') }}</div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm">Belum ada data publikasi.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>