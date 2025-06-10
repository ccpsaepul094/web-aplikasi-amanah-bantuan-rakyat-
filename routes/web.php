<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Peternak\TernakController;
use App\Http\Controllers\Peternak\KegiatanController;
use App\Http\Controllers\Peternak\BagiHasilController;
use App\Http\Controllers\Admin\PeternakController as AdminPeternak;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Peternak\ManajemenTernak\KematianController;
use App\Http\Controllers\Peternak\ManajemenTernak\KelahiranController;
use App\Http\Controllers\Peternak\DashboardController as PeternakDashboard;
use App\Http\Controllers\Superadmin\DashboardController as SuperadminDashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Login Register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperadminDashboard::class, 'index'])->name('superadmin.dashboard');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('/peternak', AdminPeternak::class);
    
    // Untuk menyetujui akun peternak
    Route::post('/peternak/{id}/approve', [AdminPeternak::class, 'approve'])->name('peternak.approve');

    Route::get('/bagihasil', [\App\Http\Controllers\Admin\BagiHasilController::class, 'index'])->name('bagihasil.index');
    Route::get('/bagihasil/export/pdf', [\App\Http\Controllers\Admin\BagiHasilController::class, 'exportPdf'])->name('bagihasil.export.pdf');
});

Route::middleware(['auth', 'role:peternak'])->prefix('peternak')->name('peternak.')->group(function () {

    // Dashboard Peternak
    Route::get('/dashboard', [PeternakDashboard::class, 'index'])->name('dashboard');
    

    // ✅ Manajemen Ternak
    Route::prefix('manajementernak')->name('manajementernak.')->group(function () {
        
        Route::resource('ternak', TernakController::class)->names('ternak');

        // ✅ Kelahiran
        Route::get('/kelahiran', [KelahiranController::class, 'index'])->name('kelahiran.index');
        Route::get('/kelahiran/create', [KelahiranController::class, 'create'])->name('kelahiran.create');
        Route::post('/kelahiran', [KelahiranController::class, 'store'])->name('kelahiran.store');
        Route::delete('/anak-ternak/{id}', [KelahiranController::class, 'destroyAnak'])->name('kelahiran.anak.destroy');
        Route::get('/kelahiran/riwayat', [KelahiranController::class, 'riwayat'])->name('kelahiran.riwayat');

        // ✅ Kematian
        Route::get('/kematian', [KematianController::class, 'index'])->name('kematian.index');
        Route::get('/kematian/create', [KematianController::class, 'create'])->name('kematian.create');
        Route::post('/kematian', [KematianController::class, 'store'])->name('kematian.store');
    });

    // ✅ Bagi Hasil (di luar manajementernak, tapi tetap di dalam peternak)
    Route::get('/bagi-hasil', [BagiHasilController::class, 'index'])->name('bagihasil.index');
    Route::post('/bagi-hasil/{bagiHasil}/bayar', [BagiHasilController::class, 'store'])->name('bagihasil.bayar');
});



