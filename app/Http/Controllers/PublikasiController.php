<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function index()
    {
        $publikasi = Publikasi::orderBy('tanggal_rilis', 'desc')->get();

        return view('publikasi.index', compact('publikasi'));
    }
    public function hint(Request $request)
    {
        $keyword = $request->get('keyword', '');

        $result = Publikasi::where('judul', 'like', '%' . $keyword . '%')
                            ->orderBy('id')
                            ->get(['id', 'judul']);

        if ($result->isEmpty()) {
            return response()->json([['judul' => 'no suggestion']]);
        }

        return response()->json($result);
    }

    public function create()
    {
        return view('publikasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_rilis' => 'required|date',
            'frekuensi_terbit' => 'required|string',
            'ukuran_file' => 'required|numeric',
            'sampul' => 'nullable|image|max:2048',
            'unduh' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->only(['judul', 'tanggal_rilis', 'frekuensi_terbit', 'ukuran_file']);

        $namaFile = \Illuminate\Support\Str::slug($data['judul']);

        if ($request->hasFile('sampul')) {
            $ext = $request->file('sampul')->getClientOriginalExtension();
            $namaAkhir = $this->namaFileUnik('sampul', $namaFile, $ext);
            $data['sampul'] = $request->file('sampul')->storeAs('sampul', $namaAkhir, 'public');
        }

        if ($request->hasFile('unduh')) {
            $ext = $request->file('unduh')->getClientOriginalExtension();
            $namaAkhir = $this->namaFileUnik('dokumen', $namaFile, $ext);
            $data['unduh'] = $request->file('unduh')->storeAs('dokumen', $namaAkhir, 'public');
        }

        Publikasi::create($data);

        return redirect()->route('publikasi.index')->with('success', 'Publikasi berhasil ditambahkan.');
    }

    public function edit(Publikasi $publikasi)
    {
        return view('publikasi.edit', compact('publikasi'));
    }

    public function update(Request $request, Publikasi $publikasi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_rilis' => 'required|date',
            'frekuensi_terbit' => 'required|string',
            'ukuran_file' => 'required|numeric',
            'sampul' => 'nullable|image|max:2048',
            'unduh' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->only(['judul', 'tanggal_rilis', 'frekuensi_terbit', 'ukuran_file']);

        $namaFile = \Illuminate\Support\Str::slug($data['judul']);

        if ($request->hasFile('sampul')) {
            $ext = $request->file('sampul')->getClientOriginalExtension();
            $namaAkhir = $this->namaFileUnik('sampul', $namaFile, $ext);
            $data['sampul'] = $request->file('sampul')->storeAs('sampul', $namaAkhir, 'public');
        }

        if ($request->hasFile('unduh')) {
            $ext = $request->file('unduh')->getClientOriginalExtension();
            $namaAkhir = $this->namaFileUnik('dokumen', $namaFile, $ext);
            $data['unduh'] = $request->file('unduh')->storeAs('dokumen', $namaAkhir, 'public');
        }

        $publikasi->update($data);

        return redirect()->route('publikasi.index')->with('success', 'Publikasi berhasil diperbarui.');
    }

    public function destroy(Publikasi $publikasi)
    {
        $publikasi->delete();

        return redirect()->route('publikasi.index')->with('success', 'Publikasi berhasil dihapus.');
    }
    private function namaFileUnik($folder, $namaDasar, $ext)
    {
        $nama = $namaDasar . '.' . $ext;
        $counter = 1;

        while (\Illuminate\Support\Facades\Storage::disk('public')->exists($folder . '/' . $nama)) {
            $nama = $namaDasar . '-' . $counter . '.' . $ext;
            $counter++;
        }

        return $nama;
    }
}