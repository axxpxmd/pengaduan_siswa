@extends('layouts.app')

@section('title', 'Dashboard')

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
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#044FA0]">
                        <span class="material-symbols-rounded text-white text-[20px]">shield_person</span>
                    </div>
                    <span class="font-bold text-xl text-slate-900 tracking-tight">Pengaduan<span class="text-[#044FA0]">Siswa</span></span>
                </div>

                <!-- Right Side (Profile & Logout) -->
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex flex-col items-end">
                        <span class="text-sm font-bold text-slate-900 leading-tight">{{ Auth::user()->nama }}</span>
                        <span class="text-[11px] font-bold tracking-wide text-[#044FA0] uppercase bg-[#e8f1fb] px-2 py-0.5 rounded-md mt-0.5">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-500">
                        <span class="material-symbols-rounded">person</span>
                    </div>

                    <!-- Divider -->
                    <div class="h-8 w-px bg-slate-200 mx-1"></div>

                    <!-- Logout action -->
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="group flex items-center justify-center rounded-xl p-2 text-slate-400 transition duration-200 hover:bg-red-50 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-red-100" title="Logout">
                            <span class="material-symbols-rounded text-[24px]">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid gap-6 md:grid-cols-3 lg:gap-8">

            <!-- Welcome Info Card (Left) -->
            <div class="md:col-span-2 space-y-6">
                <!-- Profile / Welcome Panel -->
                <div class="rounded-3xl border border-slate-200/60 bg-white p-6 shadow-sm sm:p-8">
                    <div class="flex items-start sm:items-center gap-5 mb-8 flex-col sm:flex-row">
                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 shrink-0 border border-blue-200 shadow-inner">
                            <span class="material-symbols-rounded text-[36px] text-[#044FA0]">waving_hand</span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight sm:text-3xl">Halo, {{ Auth::user()->nama }}!</h2>
                            <p class="text-slate-500 text-sm mt-1.5 sm:text-base">Selamat datang di Dashboard Pengaduan Siswa.</p>
                        </div>
                    </div>

                    <!-- Statistics Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                        <!-- Total -->
                        <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4 text-center hover:bg-slate-100 transition-colors">
                            <span class="material-symbols-rounded text-slate-400 mb-1">list_alt</span>
                            <h4 class="text-2xl font-extrabold text-slate-800">{{ $total ?? 0 }}</h4>
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1">Total</p>
                        </div>
                        <!-- Pending -->
                        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-4 text-center hover:bg-amber-100 transition-colors">
                            <span class="material-symbols-rounded text-amber-500 mb-1">hourglass_empty</span>
                            <h4 class="text-2xl font-extrabold text-amber-600">{{ $pending ?? 0 }}</h4>
                            <p class="text-[10px] font-bold text-amber-600 uppercase tracking-widest mt-1">Menunggu</p>
                        </div>
                        <!-- Diproses -->
                        <div class="rounded-2xl border border-blue-200 bg-blue-50 p-4 text-center hover:bg-blue-100 transition-colors">
                            <span class="material-symbols-rounded text-[#044FA0] mb-1">sync</span>
                            <h4 class="text-2xl font-extrabold text-[#044FA0]">{{ $diproses ?? 0 }}</h4>
                            <p class="text-[10px] font-bold text-[#044FA0] uppercase tracking-widest mt-1">Diproses</p>
                        </div>
                        <!-- Selesai -->
                        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-center hover:bg-emerald-100 transition-colors">
                            <span class="material-symbols-rounded text-emerald-500 mb-1">check_circle</span>
                            <h4 class="text-2xl font-extrabold text-emerald-600">{{ $selesai ?? 0 }}</h4>
                            <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest mt-1">Selesai</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Card (Right) -->
            <div class="space-y-6">
                <!-- Tips / Guidance -->
                <div class="rounded-2xl border border-[#b6d0ee] bg-[#f0f7ff] p-6 shadow-sm">
                    <div class="flex items-center gap-2.5 mb-3">
                        <div class="flex items-center justify-center h-8 w-8 rounded-full bg-white text-[#044FA0] shadow-sm">
                            <span class="material-symbols-rounded text-[18px]">lightbulb</span>
                        </div>
                        <h3 class="font-bold text-[#044FA0] tracking-tight">Tips Penggunaan</h3>
                    </div>
                    <p class="text-[13px] leading-relaxed text-[#033a75] sm:text-sm">
                        Gunakan menu navigasi untuk mengelola pengaduan dengan mudah dan cepat. Semua laporan akan tercatat di sistem secara transparan sesuai hak akses Anda.
                    </p>
                </div>
            </div>

            <!-- Menu Cards for Siswa -->
            @if(Auth::user()->role === 'siswa')
            <div class="md:col-span-3 grid gap-6 sm:grid-cols-2">
                <!-- Menu Buat Laporan -->
                <a href="{{ route('pengaduan.create') }}" class="group relative rounded-2xl border border-[#e4ebf5] bg-white p-6 shadow-sm hover:shadow-md transition-all sm:p-8 flex items-center gap-5 overflow-hidden">
                    <div class="absolute inset-y-0 left-0 w-1 bg-[#044FA0] rounded-l-2xl"></div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#044FA0] text-white group-hover:scale-105 transition-transform shrink-0">
                        <span class="material-symbols-rounded text-[30px]">add_circle</span>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-slate-900 group-hover:text-[#044FA0] transition-colors">Buat Laporan Baru</h3>
                        <p class="text-sm text-slate-500 mt-1">Sampaikan keluhan, aspirasi, atau pertanyaan ke sekolah.</p>
                    </div>
                    <span class="material-symbols-rounded text-slate-300 group-hover:text-[#044FA0] transition-colors">chevron_right</span>
                </a>

                <!-- Menu Riwayat Laporan -->
                <a href="{{ route('pengaduan.index') }}" class="group relative rounded-2xl border border-[#e4ebf5] bg-white p-6 shadow-sm hover:shadow-md transition-all sm:p-8 flex items-center gap-5 overflow-hidden">
                    <div class="absolute inset-y-0 left-0 w-1 bg-amber-500 rounded-l-2xl"></div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-amber-500 text-white group-hover:scale-105 transition-transform shrink-0">
                        <span class="material-symbols-rounded text-[30px]">history</span>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-slate-900 group-hover:text-amber-600 transition-colors">Riwayat Laporan</h3>
                        <p class="text-sm text-slate-500 mt-1">Pantau status & proses seluruh laporan yang Anda kirim.</p>
                    </div>
                    <span class="material-symbols-rounded text-slate-300 group-hover:text-amber-500 transition-colors">chevron_right</span>
                </a>
            </div>
            @endif

            <!-- Menu Cards for Admin/Petugas -->
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'petugas')
            <div class="md:col-span-3 grid gap-6 sm:grid-cols-2">
                <!-- Menu Kelola Laporan -->
                <a href="{{ route('admin.pengaduan.index') }}" class="group relative rounded-2xl border border-[#e4ebf5] bg-white p-6 shadow-sm hover:shadow-md transition-all sm:p-8 flex items-center gap-5 overflow-hidden">
                    <div class="absolute inset-y-0 left-0 w-1 bg-emerald-500 rounded-l-2xl"></div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-500 text-white group-hover:scale-105 transition-transform shrink-0">
                        <span class="material-symbols-rounded text-[30px]">admin_panel_settings</span>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-slate-900 group-hover:text-emerald-600 transition-colors">Kelola Laporan</h3>
                        <p class="text-sm text-slate-500 mt-1">Verifikasi, tanggapi, dan kelola semua pengaduan siswa.</p>
                    </div>
                    <span class="material-symbols-rounded text-slate-300 group-hover:text-emerald-500 transition-colors">chevron_right</span>
                </a>
            </div>
            @endif

        </div>
    </main>
</div>
@endsection
