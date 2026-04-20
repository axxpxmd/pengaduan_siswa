<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PengaduanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'siswa') {
            $total = \App\Models\Pengaduan::where('id_user', $user->id)->count();
            $pending = \App\Models\Pengaduan::where('id_user', $user->id)->where('status', 'pending')->count();
            $diproses = \App\Models\Pengaduan::where('id_user', $user->id)->where('status', 'diproses')->count();
            $selesai = \App\Models\Pengaduan::where('id_user', $user->id)->where('status', 'selesai')->count();
        } else {
            $total = \App\Models\Pengaduan::count();
            $pending = \App\Models\Pengaduan::where('status', 'pending')->count();
            $diproses = \App\Models\Pengaduan::where('status', 'diproses')->count();
            $selesai = \App\Models\Pengaduan::where('status', 'selesai')->count();
        }

        return view('dashboard', compact('total', 'pending', 'diproses', 'selesai'));
    })->name('dashboard');

    // Routing untuk manajemen pendaftaran laporan pengaduan
    Route::resource('pengaduan', PengaduanController::class);

    // Routing untuk Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('pengaduan', App\Http\Controllers\Admin\PengaduanController::class)->only(['index', 'show', 'update']);
    });
});
