<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        $publikasi = Publikasi::when($q, fn ($query) => $query->where('judul', 'like', "%{$q}%"))
            ->orderBy('tanggal_rilis', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('katalog.index', compact('publikasi', 'q'));
    }
}