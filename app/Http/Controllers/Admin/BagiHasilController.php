<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BagiHasil;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BagiHasilController extends Controller
{


public function index(Request $request)
{
    $status = $request->get('status');

    $query = BagiHasil::with(['user', 'kegiatan.ternak'])->latest();

    if ($status) {
        $query->where('status', $status);
    }

    $data = $query->get();

    return view('admin.bagihasil.index', compact('data', 'status'));
}

public function exportPdf(Request $request)
{
    $status = $request->get('status');

    $query = BagiHasil::with(['user', 'kegiatan.ternak']);

    if ($status) {
        $query->where('status', $status);
    }

    $data = $query->get();

    $pdf = Pdf::loadView('admin.bagihasil.pdf', compact('data', 'status'));
    return $pdf->download('laporan_bagi_hasil.pdf');
}

}
