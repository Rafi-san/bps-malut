<x-public-layout title="Katalog Publikasi - BPS Provinsi Maluku Utara">
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-bps-blue">Katalog Publikasi</h1>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

        <form method="GET" action="{{ route('katalog.index') }}" class="flex gap-2 mb-6">
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari judul publikasi..."
                   class="border rounded p-2 w-full sm:w-96">
            <button class="bg-bps-blue text-white px-4 rounded hover:bg-blue-900">Cari</button>
            @if ($q)
                <a href="{{ route('katalog.index') }}" class="px-3 py-2 text-gray-600">Reset</a>
            @endif
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($publikasi as $item)
                <div class="bg-white rounded-lg shadow overflow-hidden flex">
                    @if ($item->sampul)
                        <img src="{{ asset('storage/' . $item->sampul) }}" alt="{{ $item->judul }}"
                             class="w-32 object-cover bg-gray-100">
                    @else
                        <div class="w-32 bg-gray-100 flex items-center justify-center text-xs text-gray-400">Tanpa sampul</div>
                    @endif
                    <div class="p-4 flex-1 flex flex-col">
                        <div class="font-semibold text-bps-blue leading-snug">{{ $item->judul }}</div>
                        <dl class="text-xs text-gray-500 mt-2 space-y-0.5">
                            <div>Rilis: {{ \Carbon\Carbon::parse($item->tanggal_rilis)->translatedFormat('d F Y') }}</div>
                            <div>Frekuensi: {{ $item->frekuensi_terbit }}</div>
                            <div>Ukuran: {{ $item->ukuran_file }} MB</div>
                        </dl>
                        @if ($item->unduh)
                            <a href="{{ asset('storage/' . $item->unduh) }}" download
                               class="mt-auto pt-3 text-sm font-semibold text-bps-blue hover:underline">Unduh PDF</a>
                        @endif
                    </div>
                </div>
            @empty
                <p class="col-span-full text-gray-500">Tidak ada publikasi yang cocok.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $publikasi->links() }}</div>
    </div>
</x-public-layout>