<?php

// app/Http/Controllers/Peternak/DashboardController.php
namespace App\Http\Controllers\Peternak;

use App\Models\Ternak;
use App\Models\BagiHasil;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
        {
            // Hitung jumlah ternak milik peternak login
            $jumlahTernak = Ternak::where('user_id', Auth::id())->count();

            // Hitung jumlah data bagi hasil milik peternak login
            $jumlahBagiHasil = BagiHasil::where('user_id', Auth::id())->count();

            // Kirim ke view
            return view('peternak.dashboard', compact('jumlahTernak', 'jumlahBagiHasil'));
        }

}
