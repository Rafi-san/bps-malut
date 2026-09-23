<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Publikasi
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('publikasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Judul</label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                               class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Tanggal Rilis</label>
                        <input type="date" name="tanggal_rilis" value="{{ old('tanggal_rilis') }}"
                               class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Frekuensi Terbit</label>
                        <select name="frekuensi_terbit" class="w-full border rounded p-2">
                            <option value="">-- Pilih Frekuensi --</option>
                            @foreach (['Bulanan','Triwulanan','Semesteran','Tahunan','3 Tahunan','5 Tahunan','10 Tahunan','Khusus/Ad Hoc/Lainnya'] as $opsi)
                                <option value="{{ $opsi }}" {{ old('frekuensi_terbit') == $opsi ? 'selected' : '' }}>
                                    {{ $opsi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Ukuran File (MB)</label>
                        <input type="number" step="0.01" name="ukuran_file" value="{{ old('ukuran_file') }}"
                               class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Sampul (gambar)</label>
                        <input type="file" name="sampul" accept=".jpg,.jpeg,.png" class="w-full">
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-1">File PDF</label>
                        <input type="file" name="unduh" accept=".pdf" class="w-full">
                    </div>

                    <button type="submit" class="bg-bps-blue text-white px-4 py-2 rounded hover:bg-blue-900">Simpan</button>
                    <a href="{{ route('publikasi.index') }}" class="ml-2 text-gray-600">Batal</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>