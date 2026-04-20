<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        // Siswa views their own reports
        if (Auth::user()->role === 'siswa') {
            $pengaduans = Pengaduan::where('id_user', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
            return view('pengaduan.index', compact('pengaduans'));
        }

        // Admin view (Can be refined later)
        $pengaduans = Pengaduan::orderBy('created_at', 'desc')->get();
        return view('pengaduan.index', compact('pengaduans'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'siswa') {
            return redirect('/dashboard')->with('error', 'Hanya siswa yang dapat membuat pengaduan.');
        }
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'siswa') {
            return redirect('/dashboard')->with('error', 'Hanya siswa yang dapat membuat pengaduan.');
        }

        $request->validate([
            'klasifikasi' => 'required|in:pengaduan,aspirasi,permintaan_informasi',
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'tanggal_kejadian' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan_fotos', 'public');
        }

        Pengaduan::create([
            'id_user' => Auth::id(),
            'klasifikasi' => $request->klasifikasi,
            'judul' => $request->judul,
            'isi_laporan' => $request->isi_laporan,
            'foto' => $fotoPath,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'status' => 'pending',
            'is_anonim' => $request->has('is_anonim') ? true : false,
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Laporan pengaduan berhasil dikirim.');
    }

    public function edit(Pengaduan $pengaduan)
    {
        if ($pengaduan->id_user !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($pengaduan->status !== 'pending') {
            return redirect()->route('pengaduan.index')->with('error', 'Laporan yang sudah diproses tidak dapat diedit.');
        }

        return view('pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        if ($pengaduan->id_user !== Auth::id() || $pengaduan->status !== 'pending') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'klasifikasi' => 'required|in:pengaduan,aspirasi,permintaan_informasi',
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'tanggal_kejadian' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['klasifikasi', 'judul', 'isi_laporan', 'tanggal_kejadian']);
        $data['is_anonim'] = $request->has('is_anonim') ? true : false;

        if ($request->hasFile('foto')) {
            if ($pengaduan->foto) {
                Storage::disk('public')->delete($pengaduan->foto);
            }
            $data['foto'] = $request->file('foto')->store('pengaduan_fotos', 'public');
        }

        $pengaduan->update($data);

        return redirect()->route('pengaduan.index')->with('success', 'Laporan pengaduan berhasil diperbarui.');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->id_user !== Auth::id() || $pengaduan->status !== 'pending') {
            abort(403, 'Unauthorized action.');
        }

        if ($pengaduan->foto) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Laporan pengaduan berhasil ditarik/dihapus.');
    }
}
