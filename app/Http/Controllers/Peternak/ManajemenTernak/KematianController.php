<?php

namespace App\Http\Controllers\Peternak\ManajemenTernak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ternak;
use App\Models\Kegiatan;
use App\Models\DataKematian;


class KematianController extends Controller
{
    // Tampilkan semua kematian milik peternak
    public function index()
    {
        $kematians = DataKematian::where('user_id', auth()->id())->latest()->get();

        return view('peternak.manajementernak.kematian.index', compact('kematians'));
    }
    // Form tambah data kematian
    public function create()
    {
        $ternaks = Ternak::where('user_id', Auth::id())->get();
        return view('peternak.manajementernak.kematian.create', compact('ternaks'));
    }

    // Simpan data kematian


public function store(Request $request)
{
    $request->validate([
        'id_ternak' => 'required|exists:ternaks,id',
        'tgl_kegiatan' => 'required|date',
        'foto_kegiatan' => 'nullable|image|max:2048',
        'keterangan' => 'nullable|string|max:255',
    ]);

    $ternak = Ternak::findOrFail($request->id_ternak);

    // Upload foto jika ada
    $fotoPath = $request->file('foto_kegiatan')?->store('kegiatan', 'public');

    // Simpan ke tabel kegiatan (riwayat)
    Kegiatan::create([
        'id_ternak' => $ternak->id,
        'tgl_kegiatan' => $request->tgl_kegiatan,
        'jns_kegiatan' => 'kematian',
        'foto_kegiatan' => $fotoPath,
        'keterangan' => $request->keterangan,
    ]);

    // Simpan ke tabel data_kematian
    DataKematian::create([
        'user_id' => $ternak->user_id,
        'nama_ternak' => $ternak->nama ?? null,
        'jns_ternak' => $ternak->jns_ternak,
        'tgl_lahir' => $ternak->tgl_lahir,
        'tgl_kematian' => $request->tgl_kegiatan,
        'penyebab' => $request->keterangan,
        'foto_kegiatan' => $fotoPath,
        'keterangan' => $request->keterangan,
    ]);

    // Hapus dari tabel ternak
    $ternak->delete();

    return redirect()->route('peternak.manajementernak.kematian.index')
        ->with('success', 'Data kematian berhasil ditambahkan. Data ternak telah dipindahkan.');
}

}
