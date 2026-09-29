<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use App\Services\BpsInflasiService;

class HomeController extends Controller
{
    public function index(BpsInflasiService $bps)
    {
        $totalPublikasi    = Publikasi::count();
        $publikasiTahunIni = Publikasi::whereYear('tanggal_rilis', now()->year)->count();
        $rilisTerakhir     = Publikasi::max('tanggal_rilis');
        $terbaru           = Publikasi::orderBy('tanggal_rilis', 'desc')->limit(6)->get();
        $inflasi           = $bps->get();

        return view('home', compact(
            'totalPublikasi', 'publikasiTahunIni', 'rilisTerakhir', 'terbaru', 'inflasi'
        ));
    }
}