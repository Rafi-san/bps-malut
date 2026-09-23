<?php

namespace Database\Seeders;

use App\Models\Publikasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PublikasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Indikator Kesejahteraan Rakyat Provinsi Maluku Utara 2025',
                'tanggal_rilis' => '2025-12-30',
                'frekuensi_terbit' => 'Tahunan',
                'ukuran_file' => 3.96,
            ],
            [
                'judul' => 'Provinsi Maluku Utara Dalam Infografis 2025',
                'tanggal_rilis' => '2025-12-31',
                'frekuensi_terbit' => 'Tahunan',
                'ukuran_file' => 10.06,
            ],
            [
                'judul' => 'Analisis Hasil Survei Kebutuhan Data BPS Provinsi Maluku Utara 2025',
                'tanggal_rilis' => '2026-01-30',
                'frekuensi_terbit' => 'Tahunan',
                'ukuran_file' => 0.06,
            ],
            [
                'judul' => 'Provinsi Maluku Utara Dalam Angka 2026',
                'tanggal_rilis' => '2026-02-27',
                'frekuensi_terbit' => 'Tahunan',
                'ukuran_file' => 15.73,
            ],
            [
                'judul' => 'Infografis Indikator Makro Sosial Ekonomi Provinsi Maluku Utara Triwulan IV 2025',
                'tanggal_rilis' => '2026-02-27',
                'frekuensi_terbit' => 'Triwulanan',
                'ukuran_file' => 13.48,
            ],
        ];

        foreach ($data as $item) {
            $slug = Str::slug($item['judul']);

            Publikasi::create([
                'judul' => $item['judul'],
                'tanggal_rilis' => $item['tanggal_rilis'],
                'frekuensi_terbit' => $item['frekuensi_terbit'],
                'ukuran_file' => $item['ukuran_file'],
                'sampul' => 'sampul/' . $slug . '.jpeg',
                'unduh' => 'dokumen/' . $slug . '.pdf',
            ]);
        }
    }
}