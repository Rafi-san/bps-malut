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

    $inflasi  = app(\App\Services\BpsInflasiService::class)->get();
    $bpsData  = $inflasi['data'];
    $bpsError = $inflasi['error'];

    return view('dashboard', compact('totalPublikasi', 'terbaru', 'bpsData', 'bpsError'));
}
}