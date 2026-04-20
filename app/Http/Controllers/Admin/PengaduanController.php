<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'petugas' && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $pengaduans = Pengaduan::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    public function show(Pengaduan $pengaduan)
    {
        if (Auth::user()->role !== 'petugas' && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $pengaduan->load(['user', 'tanggapans.user']);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        if (Auth::user()->role !== 'petugas' && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:pending,diproses,selesai',
            'tanggapan' => 'required|string',
        ]);

        $pengaduan->update([
            'status' => $request->status,
        ]);

        Tanggapan::create([
            'id_pengaduan' => $pengaduan->id,
            'id_user' => Auth::id(),
            'tanggapan' => $request->tanggapan,
        ]);

        return redirect()->route('admin.pengaduan.show', $pengaduan->id)->with('success', 'Tanggapan berhasil disimpan dan status diperbarui.');
    }
}
