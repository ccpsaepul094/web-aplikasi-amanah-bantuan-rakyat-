<?php


namespace App\Http\Controllers\Peternak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ternak;
use Illuminate\Support\Facades\Storage;

class TernakController extends Controller
{
public function index(Request $request)
{
    $query = Ternak::where('user_id', Auth::id());

    // Pencarian umum
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $search . '%')
              ->orWhere('jenis_kelamin', 'like', '%' . $search . '%')
              ->orWhere('ras', 'like', '%' . $search . '%');
        });
    }

    // Filter status hidup/mati
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Pagination
    $perPage = $request->get('per_page', 10);
    $ternaks = $query->latest()->paginate($perPage)->withQueryString();

    return view('peternak.manajementernak.ternak.index', compact('ternaks'));
}


    public function create()
    {
        return view('peternak.manajementernak.ternak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto_ternak' => 'nullable|image',
            'jns_ternak' => 'required|string|max:255',
            'umur_ternak' => 'required|string|max:100',
            'kesehatan' => 'required|in:sehat,sakit',
            'status' => 'required|in:hidup,mati',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_ternak')) {
            $fotoPath = $request->file('foto_ternak')->store('ternak', 'public');
        }

        Ternak::create([
            'user_id' => Auth::id(),
            'foto_ternak' => $fotoPath,
            'jns_ternak' => $request->jns_ternak,
            'umur_ternak' => $request->umur_ternak,
            'kesehatan' => $request->kesehatan,
            'status' => $request->status,
        ]);

        return redirect()->route('peternak.manajementernak.ternak.index')->with('success', 'Ternak berhasil ditambahkan.');
    }
        public function anak()
    {
        return $this->hasMany(Ternak::class, 'induk_id');
    }


    public function edit($id)
    {
        $ternak = Ternak::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('peternak.manajementernak.ternak.edit', compact('ternak'));
    }

    public function update(Request $request, $id)
    {
        $ternak = Ternak::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'foto_ternak' => 'nullable|image',
            'jns_ternak' => 'required|string|max:255',
            'umur_ternak' => 'required|string|max:100',
            'kesehatan' => 'required|in:sehat,sakit',
            'status' => 'required|in:hidup,mati',
        ]);

        if ($request->hasFile('foto_ternak')) {
            // hapus lama kalau ada
            if ($ternak->foto_ternak) {
                Storage::disk('public')->delete($ternak->foto_ternak);
            }
            $ternak->foto_ternak = $request->file('foto_ternak')->store('ternak', 'public');
        }

        $ternak->update([
            'jns_ternak' => $request->jns_ternak,
            'umur_ternak' => $request->umur_ternak,
            'kesehatan' => $request->kesehatan,
            'status' => $request->status,
        ]);

        return redirect()->route('peternak.manajementernak.ternak.index')->with('success', 'Data ternak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ternak = Ternak::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        if ($ternak->foto_ternak) {
            Storage::disk('public')->delete($ternak->foto_ternak);
        }

        $ternak->delete();

        return redirect()->route('peternak.manajementernak.ternak.index')->with('success', 'Data ternak berhasil dihapus.');
    }
}

