<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPublikasi = Publikasi::count();
        $terbaru = Publikasi::orderBy('tanggal_rilis', 'desc')->limit(5)->get();

        $bpsData = null;
        $bpsError = null;

        try {
            $apiKey = config('services.bps.api_key');
            $domain = config('services.bps.domain');
            $varId = config('services.bps.var_id');

            $thResponse = Http::timeout(8)->get("https://webapi.bps.go.id/v1/api/list/model/th/domain/{$domain}/var/{$varId}/key/{$apiKey}/");

            if (!$thResponse->successful()) {
                throw new \Exception('Tidak bisa menghubungi BPS API (list tahun).');
            }

            $thList = $thResponse->json('data.1') ?? [];

            if (empty($thList)) {
                throw new \Exception('Daftar tahun tidak tersedia dari BPS API.');
            }

            usort($thList, fn($a, $b) => $b['th_id'] <=> $a['th_id']);
            $thParam = $thList[0]['th_id'];

            $bpsResponse = Http::timeout(8)->get("https://webapi.bps.go.id/v1/api/list/model/data/domain/{$domain}/var/{$varId}/th/{$thParam}/key/{$apiKey}/");

            if (!$bpsResponse->successful()) {
                throw new \Exception('Tidak bisa menghubungi BPS API.');
            }

            $bpsJson = $bpsResponse->json();

            if (empty($bpsJson['datacontent'])) {
                throw new \Exception('Data belum tersedia dari BPS API.');
            }

            $vervarList = $bpsJson['vervar'] ?? [];
            $turtahunList = $bpsJson['turtahun'] ?? [];
            $tahunList = $bpsJson['tahun'] ?? [];
            $datacontent = $bpsJson['datacontent'];

            $turvarId = 630;
            $turtahunId = $turtahunList[0]['val'] ?? 0;
            $tahunLabel = $tahunList[0]['label'] ?? '';
            $tahunId = $tahunList[0]['val'] ?? null;

            $items = [];
            foreach ($vervarList as $vervar) {
                $key = $vervar['val'] . $varId . $turvarId . $tahunId . $turtahunId;
                if (isset($datacontent[$key])) {
                    $items[] = [
                        'label' => $vervar['label'] . ' ' . $tahunLabel,
                        'value' => $datacontent[$key],
                        'vervar' => $vervar['val'],
                    ];
                }
            }

            usort($items, fn($a, $b) => $b['vervar'] <=> $a['vervar']);
            $bpsData = array_slice($items, 0, 6);

            if (empty($bpsData)) {
                throw new \Exception('Data tidak dapat diproses.');
            }
        } catch (\Exception $e) {
            $bpsError = $e->getMessage();
        }

        return view('dashboard', compact('totalPublikasi', 'terbaru', 'bpsData', 'bpsError'));
    }
}