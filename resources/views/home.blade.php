<x-public-layout title="Beranda BPS Provinsi Maluku Utara">

    {{-- HERO / UCAPAN SELAMAT DATANG --}}
    <section class="relative text-white bg-cover bg-center"
             style="background-image: url('{{ asset('images/galeri/kegiatan3.jpg') }}');">
        <div class="absolute inset-0 bg-bps-blue/80"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 text-center">
            <p class="text-sm tracking-widest text-blue-200 mb-3">SELAMAT DATANG</p>
            <h1 class="text-3xl sm:text-5xl font-bold leading-tight">
                Sistem Publikasi<br>BPS Provinsi Maluku Utara
            </h1>
            <p class="mt-5 max-w-2xl mx-auto text-blue-100">
                Akses publikasi statistik resmi, data inflasi terbaru, dan dokumentasi kegiatan
                BPS Provinsi Maluku Utara dalam satu tempat.
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ route('katalog.index') }}"
                   class="bg-white text-bps-blue font-semibold px-6 py-3 rounded hover:bg-blue-50">Lihat Publikasi</a>
                <a href="{{ route('login') }}"
                   class="border border-white text-white font-semibold px-6 py-3 rounded hover:bg-white/10">Masuk</a>
            </div>
        </div>
    </section>

    {{-- STATISTIK RINGKAS --}}
    @php
        $stats = [
            [$totalPublikasi, 'Total Publikasi'],
            [$publikasiTahunIni, 'Publikasi Tahun ' . now()->year],
            [$rilisTerakhir ? \Carbon\Carbon::parse($rilisTerakhir)->translatedFormat('d M Y') : '-', 'Rilis Terakhir'],
        ];
    @endphp
    <section class="max-w-5xl mx-auto px-4 -mt-10 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach ($stats as [$angka, $label])
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div class="text-3xl font-bold text-bps-blue">{{ $angka }}</div>
                    <div class="text-sm text-gray-500 mt-1">{{ $label }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- INFLASI --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-14">
        <h2 class="text-2xl font-bold text-bps-blue">Inflasi Kota Ternate (2022=100)</h2>
        <p class="text-xs text-gray-400 mb-4">Sumber: Web API BPS (webapi.bps.go.id)</p>

        @if ($inflasi['error'])
            <div class="bg-white rounded shadow p-6 text-sm text-gray-500">
                Data inflasi belum dapat ditampilkan saat ini.
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach ($inflasi['data'] as $item)
                    <div class="bg-white rounded-lg shadow p-4 text-center">
                        <div class="text-2xl font-bold text-bps-blue">{{ $item['value'] }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ $item['label'] }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- PUBLIKASI TERBARU --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-14">
        <div class="flex justify-between items-end mb-4">
            <h2 class="text-2xl font-bold text-bps-blue">Publikasi Terbaru</h2>
            <a href="{{ route('katalog.index') }}" class="text-sm text-bps-blue hover:underline">Lihat semua &rarr;</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @forelse ($terbaru as $pub)
                <div class="bg-white rounded-lg shadow overflow-hidden flex flex-col">
                    @if ($pub->sampul)
                        <img src="{{ asset('storage/' . $pub->sampul) }}" alt="{{ $pub->judul }}"
                             class="h-48 w-full object-cover bg-gray-100">
                    @else
                        <div class="h-48 bg-gray-100 flex items-center justify-center text-xs text-gray-400">Tanpa sampul</div>
                    @endif
                    <div class="p-3 flex-1 flex flex-col">
                        <div class="text-sm font-semibold text-bps-blue leading-snug">{{ $pub->judul }}</div>
                        <div class="text-xs text-gray-400 mt-2">
                            {{ \Carbon\Carbon::parse($pub->tanggal_rilis)->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-sm text-gray-500">Belum ada publikasi.</p>
            @endforelse
        </div>
    </section>

    {{-- CUPLIKAN GALERI --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-14">
        <div class="flex justify-between items-end mb-4">
            <h2 class="text-2xl font-bold text-bps-blue">Galeri Kegiatan</h2>
            <a href="{{ route('galeri.index') }}" class="text-sm text-bps-blue hover:underline">Lihat semua &rarr;</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach ([1, 2, 4, 5] as $n)
                <a href="{{ route('galeri.index') }}">
                    <img src="{{ asset('images/galeri/kegiatan' . $n . '.jpg') }}" alt="Kegiatan {{ $n }}"
                         class="h-40 w-full object-cover rounded-lg shadow hover:opacity-80 transition">
                </a>
            @endforeach
        </div>
    </section>

    {{-- TENTANG --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-14">
        <div class="bg-white rounded-lg shadow p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-bps-blue mb-3">Tentang BPS</h2>
            <p class="text-gray-600 leading-relaxed">
                Badan Pusat Statistik (BPS) adalah lembaga pemerintah nonkementerian yang
                menyelenggarakan kegiatan statistik di Indonesia. BPS Provinsi Maluku Utara
                melayani kebutuhan data statistik untuk wilayah Maluku Utara, mulai dari
                publikasi, infografis, hingga data strategis.
            </p>
        </div>
    </section>

</x-public-layout>