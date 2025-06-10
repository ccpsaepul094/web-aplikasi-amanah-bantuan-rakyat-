<?php

namespace App\Http\Controllers\Peternak;

use App\Models\BagiHasil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BagiHasilController extends Controller
{
        public function index()
    {
        
        $bagiHasils = BagiHasil::where('user_id', auth()->id())
            ->with('kegiatan.ternak')
            ->latest()->get();
        
        return view('peternak.bagihasil.index', compact('bagiHasils'));
    }

    public function store(Request $request, BagiHasil $bagiHasil)
    {
        $request->validate([
            'jumlah_bayar' => 'required|numeric|min:1',
        ]);

        $bagiHasil->jumlah_dibayar += $request->jumlah_bayar;

        if ($bagiHasil->jumlah_dibayar >= $bagiHasil->total_tagihan) {
            $bagiHasil->jumlah_dibayar = $bagiHasil->total_tagihan;
            $bagiHasil->status = 'lunas';
        }

        $bagiHasil->save();

        return back()->with('success', 'Pembayaran berhasil dicatat.');
    }

}
