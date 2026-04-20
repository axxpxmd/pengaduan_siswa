@extends('layouts.app')

@section('title', 'Kelola Laporan Siswa - Admin')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
@endpush

@section('content')
<div class="min-h-screen bg-[#f7fafd]">
    <!-- Navbar / Header -->
    <nav class="bg-white border-b border-[#e4ebf5] sticky top-0 z-10 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Brand -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#044FA0] text-white hover:bg-[#033a75] transition-colors">
                        <span class="material-symbols-rounded text-[20px]">arrow_back</span>
                    </a>
                    <span class="font-bold text-xl text-slate-900 tracking-tight ml-2">Manajemen Laporan</span>
                </div>

                <!-- Right Side -->
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex flex-col items-end">
                        <span class="text-sm font-bold text-slate-900 leading-tight">{{ Auth::user()->nama }}</span>
                        <span class="text-[11px] font-bold tracking-wide text-[#044FA0] uppercase bg-[#e8f1fb] px-2 py-0.5 rounded-md mt-0.5">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 flex items-center gap-3 text-green-700">
                <span class="material-symbols-rounded">check_circle</span>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="rounded-2xl border border-[#e4ebf5] bg-white shadow-sm overflow-hidden">
            <div class="p-6 border-b border-[#e4ebf5] flex justify-between items-center bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-900">Daftar Pengaduan Masuk</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-[#e4ebf5]">
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pelapor</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Judul / Kategori</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e4ebf5]">
                        @forelse($pengaduans as $index => $pengaduan)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-slate-500 font-medium">
                                    #{{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 leading-tight">
                                    @if($pengaduan->is_anonim)
                                        <p class="font-bold text-slate-800 flex items-center gap-1">
                                            <span class="material-symbols-rounded text-[16px] text-slate-400">visibility_off</span>
                                            Anonim
                                        </p>
                                        <p class="text-xs text-slate-400 mt-1">Identitas disembunyikan</p>
                                    @else
                                        <p class="font-bold text-slate-800">{{ $pengaduan->user->nama ?? 'Siswa' }}</p>
                                        <p class="text-xs text-slate-500 mt-1">{{ $pengaduan->user->username ?? '-' }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-semibold text-slate-900 border-b border-transparent hover:border-slate-300 w-max cursor-default">{{ Str::limit($pengaduan->judul, 40) }}</p>
                                    <span class="inline-flex mt-1.5 px-2 py-0.5 rounded text-[10px] font-bold tracking-wide uppercase 
                                        {{ $pengaduan->klasifikasi == 'pengaduan' ? 'bg-red-50 text-red-600' : 
                                           ($pengaduan->klasifikasi == 'aspirasi' ? 'bg-blue-50 text-[#044FA0]' : 'bg-emerald-50 text-emerald-600') }}">
                                        {{ str_replace('_', ' ', $pengaduan->klasifikasi) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-slate-700">{{ $pengaduan->tanggal_lapor ? $pengaduan->tanggal_lapor->format('d M Y') : $pengaduan->created_at->format('d M Y') }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $pengaduan->created_at->format('H:i') }} WIB</p>
                                </td>
                                <td class="px-6 py-4">
                                    @if($pengaduan->status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-amber-50 border border-amber-200 text-amber-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>Menunggu
                                        </span>
                                    @elseif($pengaduan->status === 'diproses')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-[#e8f1fb] border border-[#b6d0ee] text-[#044FA0]">
                                            <span class="h-1.5 w-1.5 rounded-full bg-[#044FA0]"></span>Diproses
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 border border-emerald-200 text-emerald-700">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Selesai
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-[#e4ebf5] rounded-lg text-sm font-medium text-[#044FA0] hover:bg-[#f0f7ff] hover:border-[#b6d0ee] transition-colors focus:outline-none focus:ring-2 focus:ring-[#044FA0]/20 shadow-sm">
                                        <span class="material-symbols-rounded text-[18px]">quick_reference_all</span>
                                        Tindak Lanjut
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="material-symbols-rounded text-4xl text-slate-300">inbox</span>
                                        <p>Belum ada laporan pengaduan masuk.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection