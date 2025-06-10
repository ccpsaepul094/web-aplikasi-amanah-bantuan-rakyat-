<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PeternakController extends Controller
{
    public function index()
    {
        $peternaks = User::where('role', 'peternak')->get();
        return view('admin.peternak.index', compact('peternaks'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->back()->with('success', 'Akun peternak disetujui.');
    }
}
