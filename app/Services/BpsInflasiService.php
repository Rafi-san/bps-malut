<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class BpsInflasiService
{
    public function get(): array
    {
        if ($cached = Cache::get('bps_inflasi')) {
            return ['data' => $cached, 'error' => null];
        }

        try {
            $apiKey = config('services.bps.api_key');
            $domain = config('services.bps.domain');
            $varId  = config('services.bps.var_id');

            $thResponse = Http::timeout(8)->get("https://webapi.bps.go.id/v1/api/list/model/th/domain/{$domain}/var/{$varId}/key/{$apiKey}/");
            if (!$thResponse->successful()) {
                throw new \Exception('Tidak bisa menghubungi BPS API (list tahun).');
            }

            $thList = $thResponse->json('data.1') ?? [];
            if (empty($thList)) {
                throw new \Exception('Daftar tahun tidak tersedia dari BPS API.');
            }

            usort($thList, fn ($a, $b) => $b['th_id'] <=> $a['th_id']);
            $thParam = $thList[0]['th_id'];

            $response = Http::timeout(8)->get("https://webapi.bps.go.id/v1/api/list/model/data/domain/{$domain}/var/{$varId}/th/{$thParam}/key/{$apiKey}/");
            if (!$response->successful()) {
                throw new \Exception('Tidak bisa menghubungi BPS API.');
            }

            $json = $response->json();
            if (empty($json['datacontent'])) {
                throw new \Exception('Data belum tersedia dari BPS API.');
            }

            $vervarList   = $json['vervar'] ?? [];
            $turtahunList = $json['turtahun'] ?? [];
            $tahunList    = $json['tahun'] ?? [];
            $datacontent  = $json['datacontent'];

            $turvarId   = 630;
            $turtahunId = $turtahunList[0]['val'] ?? 0;
            $tahunLabel = $tahunList[0]['label'] ?? '';
            $tahunId    = $tahunList[0]['val'] ?? null;

            $items = [];
            foreach ($vervarList as $vervar) {
                $key = $vervar['val'] . $varId . $turvarId . $tahunId . $turtahunId;
                if (isset($datacontent[$key])) {
                    $items[] = [
                        'label'  => $vervar['label'] . ' ' . $tahunLabel,
                        'value'  => $datacontent[$key],
                        'vervar' => $vervar['val'],
                    ];
                }
            }

            usort($items, fn ($a, $b) => $b['vervar'] <=> $a['vervar']);
            $items = array_slice($items, 0, 6);

            if (empty($items)) {
                throw new \Exception('Data tidak dapat diproses.');
            }

            Cache::put('bps_inflasi', $items, now()->addHours(6));

            return ['data' => $items, 'error' => null];
        } catch (\Exception $e) {
            return ['data' => null, 'error' => $e->getMessage()];
        }
    }
}