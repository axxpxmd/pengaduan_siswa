@extends('layouts.app')

@section('title', 'Riwayat Pengaduan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
@endpush

@section('content')
<div class="min-h-screen bg-[#f7fafd]">
    <nav class="bg-white border-b border-[#e4ebf5] sticky top-0 z-10 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Back & Brand -->
                <div class="flex items-center gap-4">
                    <a href="{{ url('/dashboard') }}" class="flex items-center justify-center h-10 w-10 rounded-xl bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-[#044FA0] transition">
                        <span class="material-symbols-rounded">arrow_back</span>
                    </a>
                    <span class="font-bold text-xl text-slate-900 tracking-tight">Riwayat<span class="text-[#044FA0]">Laporan</span></span>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                    <span class="material-symbols-rounded text-[#044FA0]">folder_open</span>
                    Daftar Pengaduan Anda
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Berikut adalah seluruh laporan, aspirasi, dan permintaan informasi yang telah Anda buat.
                </p>
            </div>
            @if(Auth::user()->role === 'siswa')
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-[#044FA0] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#03458c]">
                    <span class="material-symbols-rounded text-[18px]">add</span>
                    Buat Laporan Baru
                </a>
            </div>
            @endif
        </div>

        @if(session('success'))
            <div class="mb-6 flex relative items-center gap-3 rounded-xl border border-green-200 bg-green-50 p-4">
                <span class="material-symbols-rounded text-green-500">check_circle</span>
                <p class="text-sm font-medium text-green-700">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 flex relative items-center gap-3 rounded-xl border border-red-200 bg-red-50 p-4">
                <span class="material-symbols-rounded text-red-500">error</span>
                <p class="text-sm font-medium text-red-700">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-[#e4ebf5] shadow-[0_8px_30px_rgba(15,23,42,0.04)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-[13px] font-bold text-slate-600 uppercase tracking-wider">Tiket</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-[13px] font-bold text-slate-600 uppercase tracking-wider">Klasifikasi</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-[13px] font-bold text-slate-600 uppercase tracking-wider">Judul & Tanggal</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-[13px] font-bold text-slate-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-6 text-right"><span class="sr-only">Aksi</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($pengaduans as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-slate-900">
                                #{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 capitalize">
                                @if($item->klasifikasi == 'pengaduan')
                                    <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Pengaduan</span>
                                @elseif($item->klasifikasi == 'aspirasi')
                                    <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/10">Aspirasi</span>
                                @else
                                    <span class="inline-flex items-center rounded-md bg-zinc-50 px-2 py-1 text-xs font-medium text-zinc-700 ring-1 ring-inset ring-zinc-600/10">Informasi</span>
                                @endif
                            </td>
                            <td class="py-4 px-3 text-sm">
                                <div class="font-bold text-slate-900">{{ $item->judul }}</div>
                                <div class="text-slate-500 text-xs mt-0.5">{{ $item->created_at->format('d M Y - H:i') }}</div>
                                @if($item->is_anonim)
                                    <div class="inline-flex mt-1 text-[10px] items-center gap-1 text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded">
                                        <span class="material-symbols-rounded text-[12px]">visibility_off</span> Anonim
                                    </div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                @if($item->status == 'pending')
                                    <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-semibold text-amber-800">Menunggu</span>
                                @elseif($item->status == 'diproses')
                                    <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-800">Diproses</span>
                                @elseif($item->status == 'selesai')
                                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-semibold text-emerald-800">Selesai</span>
                                @endif
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium">
                                @if($item->status == 'pending' && Auth::user()->role === 'siswa')
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('pengaduan.edit', $item->id) }}" class="text-[#044FA0] hover:text-[#033a75] bg-[#e8f1fb] p-1.5 rounded-lg flex transition items-center" title="Edit Laporan">
                                            <span class="material-symbols-rounded text-[18px]">edit</span>
                                        </a>
                                        <form action="{{ route('pengaduan.destroy', $item->id) }}" method="POST" class="m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 p-1.5 rounded-lg flex transition items-center" title="Hapus Laporan">
                                                <span class="material-symbols-rounded text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-slate-400 text-xs italic">Dikunci</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-500">
                                <span class="material-symbols-rounded text-4xl text-slate-300 block mb-2">inbox</span>
                                Belum ada pengaduan yang Anda ajukan.
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
