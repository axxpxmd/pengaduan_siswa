<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard utama.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'siswa') {
            $total = Pengaduan::where('id_user', $user->id)->count();
            $pending = Pengaduan::where('id_user', $user->id)->where('status', 'pending')->count();
            $diproses = Pengaduan::where('id_user', $user->id)->where('status', 'diproses')->count();
            $selesai = Pengaduan::where('id_user', $user->id)->where('status', 'selesai')->count();
        } else {
            $total = Pengaduan::count();
            $pending = Pengaduan::where('status', 'pending')->count();
            $diproses = Pengaduan::where('status', 'diproses')->count();
            $selesai = Pengaduan::where('status', 'selesai')->count();
        }

        return view('dashboard', compact('total', 'pending', 'diproses', 'selesai'));
    }
}
