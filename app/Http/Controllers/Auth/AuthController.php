<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Peternak;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (!Auth::user()->is_approved) {
                Auth::logout();
                return back()->with('error', 'Akun Anda belum disetujui oleh Admin.');
            }

            $role = Auth::user()->role;
            return match($role) {
                'superadmin' => redirect()->route('superadmin.dashboard'),
                'admin' => redirect()->route('admin.dashboard'),
                'peternak' => redirect()->route('peternak.dashboard'),
                default => redirect('/login'),
            };
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'nama' => 'required|string',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'peternak',
            'is_approved' => false,
        ]);

        Peternak::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan tunggu persetujuan Admin.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
