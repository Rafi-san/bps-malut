<x-app-layout>
    @vite('resources/js/publikasi-search.js')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Publikasi
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex justify-between items-center">
                <label class="block text-sm font-medium mb-1">Cari Judul Publikasi</label>
                <input type="text" id="txt1" onkeyup="showHint(this.value)" autocomplete="off"
                    class="border rounded p-2 w-80">
                <p class="text-sm text-blue-700 mt-1" id="txtHint"></p>
                <span class="text-gray-600">{{ $publikasi->count() }} publikasi tersedia</span>
                <a href="{{ route('publikasi.create') }}"
                class="bg-bps-blue text-white px-4 py-2 rounded hover:bg-blue-900">
                    + Tambah Publikasi
                </a>
            </div>

            <div class="bg-white shadow rounded overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-3 text-left">No</th>
                            <th class="p-3 text-left">Judul</th>
                            <th class="p-3 text-left">Tanggal Rilis</th>
                            <th class="p-3 text-left">Frekuensi</th>
                            <th class="p-3 text-left">Ukuran</th>
                            <th class="p-3 text-left">Sampul</th>
                            <th class="p-3 text-left">Unduh</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($publikasi as $item)
                        <tr class="border-b" id="pub-{{ $item->id }}">
                            <td class="p-3">{{ $loop->iteration }}</td>
                            <td class="p-3">{{ $item->judul }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($item->tanggal_rilis)->translatedFormat('d F Y') }}</td>
                            <td class="p-3">{{ $item->frekuensi_terbit }}</td>
                            <td class="p-3">{{ $item->ukuran_file }} MB</td>
                            <td class="p-3">
                                @if ($item->sampul)
                                    <img src="{{ asset('storage/' . $item->sampul) }}" width="60">
                                @endif
                            </td>
                            <td class="p-3">
                                @if ($item->unduh)
                                    <a href="{{ asset('storage/' . $item->unduh) }}" class="text-blue-600 underline" download>Unduh</a>
                                @endif
                            </td>
                            <td class="p-3 whitespace-nowrap">
                                <a href="{{ route('publikasi.edit', $item->id) }}"
                                   class="bg-yellow-400 px-3 py-1 rounded text-sm">Edit</a>
                                <form action="{{ route('publikasi.destroy', $item->id) }}" method="POST"
                                      class="inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="p-4 text-center text-gray-500">Belum ada data publikasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>