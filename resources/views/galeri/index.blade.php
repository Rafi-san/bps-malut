<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Galeri Kegiatan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">

                <div class="flex flex-col md:flex-row gap-6">

                    <div class="md:w-3/5">
                        <img id="preview-utama"
                             src="{{ asset('images/galeri/kegiatan3.jpg') }}"
                             alt="Preview Kegiatan"
                             class="w-full h-80 object-cover rounded border-4 border-blue-900">
                    </div>

                    <div class="md:w-2/5">
                        <div class="grid grid-cols-2 gap-2">
                            <img src="{{ asset('images/galeri/kegiatan1.jpg') }}"
                                 title="Supervisi Lapangan Deputi Bidang Statistik Produksi"
                                 class="thumb w-full h-28 object-cover rounded cursor-pointer border-2 border-transparent hover:opacity-70"
                                 onclick="gantiPreview(this, 'Supervisi Lapangan Deputi Bidang Statistik Produksi')">

                            <img src="{{ asset('images/galeri/kegiatan2.jpg') }}"
                                 title="Peresmian AGRO ST2023 BPS Provinsi Maluku Utara"
                                 class="thumb w-full h-28 object-cover rounded cursor-pointer border-2 border-transparent hover:opacity-70"
                                 onclick="gantiPreview(this, 'Peresmian AGRO ST2023 BPS Provinsi Maluku Utara')">

                            <img src="{{ asset('images/galeri/kegiatan3.jpg') }}"
                                 title="Kick Off Hari Statistik Nasional 2024"
                                 class="thumb w-full h-28 object-cover rounded cursor-pointer border-2 border-blue-900"
                                 onclick="gantiPreview(this, 'Kick Off Hari Statistik Nasional 2024')">

                            <img src="{{ asset('images/galeri/kegiatan4.jpg') }}"
                                 title="Penyampaian Hasil Evaluasi Penyelenggaraan Statistik Sektoral (EPSS) 2024"
                                 class="thumb w-full h-28 object-cover rounded cursor-pointer border-2 border-transparent hover:opacity-70"
                                 onclick="gantiPreview(this, 'Penyampaian Hasil Evaluasi Penyelenggaraan Statistik Sektoral (EPSS) 2024')">

                            <img src="{{ asset('images/galeri/kegiatan5.jpg') }}"
                                 title="Pembinaan Desa Cinta Statistik (Desa Cantik)"
                                 class="thumb w-full h-28 object-cover rounded cursor-pointer border-2 border-transparent hover:opacity-70"
                                 onclick="gantiPreview(this, 'Pembinaan Desa Cinta Statistik (Desa Cantik)')">

                            <img src="{{ asset('images/galeri/kegiatan6.jpg') }}"
                                 title="Upacara dan Sarasehan Hari Statistik Nasional 2024"
                                 class="thumb w-full h-28 object-cover rounded cursor-pointer border-2 border-transparent hover:opacity-70"
                                 onclick="gantiPreview(this, 'Upacara dan Sarasehan Hari Statistik Nasional 2024')">
                        </div>
                    </div>

                </div>

                <p class="text-center text-gray-500 italic mt-4" id="caption-galeri">
                    Kick Off Hari Statistik Nasional 2024
                </p>

            </div>
        </div>
    </div>

    <script>
        function gantiPreview(thumbEl, caption) {
            const preview = document.getElementById('preview-utama');
            preview.src = thumbEl.src;
            preview.alt = thumbEl.alt;

            document.getElementById('caption-galeri').textContent = caption;

            document.querySelectorAll('.thumb').forEach(t => {
                t.classList.remove('border-blue-900');
                t.classList.add('border-transparent');
            });

            thumbEl.classList.remove('border-transparent');
            thumbEl.classList.add('border-blue-900');
        }
    </script>
</x-app-layout>