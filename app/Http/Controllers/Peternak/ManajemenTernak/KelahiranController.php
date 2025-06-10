<?php

namespace App\Http\Controllers\Peternak\ManajemenTernak;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Ternak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\BagiHasil;

class KelahiranController extends Controller
{
    // Tampilkan semua kelahiran milik user
    public function index()
    {
        $kegiatans = Kegiatan::where('jns_kegiatan', 'kelahiran')
            ->whereHas('ternak', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with('ternak')
            ->latest()
            ->get();

        return view('peternak.manajementernak.kelahiran.index', compact('kegiatans'));
    }

    // Tampilkan form tambah kelahiran
    public function create()
    {
        $ternaks = Ternak::where('user_id', Auth::id())->get();
        return view('peternak.manajementernak.kelahiran.create', compact('ternaks'));
    }

    // Simpan data kelahiran dan anak ke tabel ternak
    public function store(Request $request)
    {
    $request->validate([
        'id_ternak' => 'required|exists:ternaks,id',
        'tgl_kegiatan' => 'required|date',
        'foto_kegiatan' => 'nullable|image|max:2048',
        'keterangan' => 'nullable|string|max:255',

        // Data anak
        'jns_kelamin' => 'required|in:jantan,betina',
    ]);

    $path = $request->file('foto_kegiatan')?->store('kegiatan', 'public');

    // Simpan kegiatan kelahiran
    $kegiatan = Kegiatan::create([
        'id_ternak' => $request->id_ternak,
        'tgl_kegiatan' => $request->tgl_kegiatan,
        'jns_kegiatan' => 'kelahiran', // atau 'kematian' sesuai fitur
        'foto_kegiatan' => $path,
        'keterangan' => $request->keterangan,
    ]);
    BagiHasil::create([
        'id_kegiatan' => $kegiatan->id,
        'user_id' => auth()->id(),
        'total_tagihan' => 250000,
        'jumlah_dibayar' => 0,
        'status' => 'belum_lunas',
    ]);

    // Simpan data anak ternak
    Ternak::create([
        'user_id'     => Auth::id(),
        'induk_id'    => $request->id_ternak,
        'nama'        => 'ANAK-' . strtoupper(uniqid()),
        'foto_ternak' => null,
        'jns_ternak'  => 'domba', // Bisa juga ambil dari induknya jika perlu
        'jns_kelamin' => $request->jns_kelamin,
        'tgl_lahir'   => $request->tgl_kegiatan,
        'umur_ternak' => 0,
        'kesehatan'   => 'sehat',
        'status'      => 'hidup',
    ]);
    

    return redirect()->route('peternak.manajementernak.kelahiran.index')
        ->with('success', 'Data kelahiran dan anak ternak berhasil ditambahkan.');
    }
    public function riwayat()
    {
    $kegiatans = Kegiatan::where('jns_kegiatan', 'kelahiran')
        ->whereHas('ternak', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->with(['ternak.anak'])
        ->latest()
        ->get();


    return view('peternak.manajementernak.kelahiran.riwayat', compact('kegiatans'));
    }


    public function destroyAnak($id)
    {
    $anak = Ternak::where('id', $id)->where('induk_id', '!=', null)->firstOrFail();

    // Optional: pastikan hanya anak milik user yang bisa dihapus
    if ($anak->user_id !== Auth::id()) {
        abort(403);
    }

    $anak->delete();

    return redirect()->back()->with('success', 'Anak ternak berhasil dihapus.');
    }



}
