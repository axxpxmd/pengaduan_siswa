@extends('layouts.app')

@section('title', 'Tindak Lanjut & Verifikasi - Admin')

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
                    <a href="{{ route('admin.pengaduan.index') }}" class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#044FA0] text-white hover:bg-[#033a75] transition-colors focus:outline-none focus:ring-2 focus:ring-[#044FA0]/40 ring-offset-1">
                        <span class="material-symbols-rounded text-[20px]">arrow_back</span>
                    </a>
                    <span class="font-bold text-xl text-slate-900 tracking-tight ml-2">Detail Laporan</span>
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

        <div class="grid gap-6 md:grid-cols-3">

            <!-- Laporan Detail (Left) -->
            <div class="md:col-span-2 space-y-6">
                <div class="rounded-2xl border border-[#e4ebf5] bg-white p-6 shadow-sm overflow-hidden relative">
                    <!-- Status Header Banner -->
                    <div class="absolute top-0 left-0 right-0 h-10
                        {{ $pengaduan->status == 'pending' ? 'bg-amber-100/50' : ($pengaduan->status == 'diproses' ? 'bg-[#e8f1fb]' : 'bg-emerald-100/50') }}">
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mt-1 mb-6 border-b border-[#e4ebf5] pb-5">
                            <div>
                                <span class="inline-flex px-2 py-0.5 mb-2 rounded text-[10px] font-bold tracking-wide uppercase
                                    {{ $pengaduan->klasifikasi == 'pengaduan' ? 'bg-red-50 text-red-600 border border-red-200' :
                                        ($pengaduan->klasifikasi == 'aspirasi' ? 'bg-blue-50 text-[#044FA0] border border-blue-200' : 'bg-emerald-50 text-emerald-600 border border-emerald-200') }}">
                                    {{ str_replace('_', ' ', $pengaduan->klasifikasi) }}
                                </span>
                                <h2 class="text-2xl font-bold text-slate-800 leading-tight">{{ $pengaduan->judul }}</h2>
                            </div>
                            <!-- Status -->
                            @if($pengaduan->status === 'pending')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-bold bg-amber-500 border border-amber-600 text-white shadow-sm">
                                    Menunggu
                                </span>
                            @elseif($pengaduan->status === 'diproses')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-bold bg-[#044FA0] border border-[#033a75] text-white shadow-sm">
                                    Diproses
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-bold bg-emerald-500 border border-emerald-600 text-white shadow-sm">
                                    Selesai
                                </span>
                            @endif
                        </div>

                        <!-- Pelapor Information -->
                        <div class="grid sm:grid-cols-2 gap-4 mb-6 p-4 rounded-xl bg-slate-50 border border-[#e4ebf5]">
                            <div class="flex gap-3 items-center">
                                <div class="h-10 w-10 shrink-0 rounded-full flex items-center justify-center
                                    {{ $pengaduan->is_anonim ? 'bg-slate-200 text-slate-500' : 'bg-[#e8f1fb] text-[#044FA0]' }}">
                                    <span class="material-symbols-rounded">{{ $pengaduan->is_anonim ? 'visibility_off' : 'person' }}</span>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-0.5">Dikirim Oleh</p>
                                    @if($pengaduan->is_anonim)
                                        <p class="font-bold text-slate-700">Pelapor Anonim</p>
                                    @else
                                        <p class="font-bold text-slate-900">{{ $pengaduan->user->nama ?? '-' }}</p>
                                        <p class="text-xs text-slate-500">{{ $pengaduan->user->username ?? '-' }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex gap-3 items-center sm:justify-end">
                                <div class="text-left sm:text-right">
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-0.5 sm:text-right text-left">Waktu Masuk</p>
                                    <p class="font-bold text-slate-700 flex items-center justify-start sm:justify-end gap-1.5">
                                        <span class="material-symbols-rounded text-[18px] text-slate-400">calendar_month</span>
                                        {{ $pengaduan->tanggal_lapor ? $pengaduan->tanggal_lapor->format('d M Y - H:i') : $pengaduan->created_at->format('d M Y - H:i') }} WIB
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Isi Detail Laporan -->
                        <div class="prose max-w-none text-slate-700 mb-6 bg-white p-4 border-l-4 border-[#044FA0] rounded-r-xl shadow-sm text-sm sm:text-base leading-relaxed">
                            <p class="whitespace-pre-line">{{ $pengaduan->isi_laporan }}</p>
                        </div>

                        <!-- Info Tambahan -->
                        @if($pengaduan->tanggal_kejadian)
                            <div class="flex items-center gap-2 text-sm text-slate-600 mb-4 bg-amber-50 border border-amber-200 text-amber-800 p-3 rounded-xl max-w-max">
                                <span class="material-symbols-rounded text-[18px]">event_note</span>
                                <span class="font-semibold">Tanggal Kejadian:</span> {{ $pengaduan->tanggal_kejadian->format('d F Y') }}
                            </div>
                        @endif

                        <!-- Foto / Lampiran -->
                        <div>
                            <h3 class="text-sm font-bold text-slate-700 mb-3 flex items-center gap-1.5 focus-within:">
                                <span class="material-symbols-rounded text-[18px] text-slate-400">photo_library</span> Lampiran Foto
                            </h3>
                            @if($pengaduan->foto)
                                <div class="rounded-xl overflow-hidden border border-[#e4ebf5] bg-slate-50 relative group">
                                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Lampiran Laporan" class="w-full object-contain max-h-[400px] bg-slate-100" onerror="this.onerror=null; this.src='https://placehold.co/600x400/e2e8f0/64748b?text=Gambar+Tidak+Ditemukan'; this.alt='Broken Link';">
                                    <a href="{{ asset('storage/' . $pengaduan->foto) }}" target="_blank" class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg text-sm font-bold text-[#044FA0] shadow flex items-center gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity border border-white/50 hover:bg-white focus:outline-none focus:ring-2 focus:ring-[#044FA0]">
                                        <span class="material-symbols-rounded text-[18px]">open_in_new</span> Buka Penuh
                                    </a>
                                </div>
                            @else
                                <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-6 flex flex-col items-center justify-center text-slate-500">
                                    <span class="material-symbols-rounded text-[32px] text-slate-300 mb-2">image_not_supported</span>
                                    <p class="text-sm font-medium">Tidak ada lampiran foto yang disertakan.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Rekam Tindak Lanjut (Responses) -->
                @if($pengaduan->tanggapans->count() > 0)
                <div class="space-y-4">
                    <h3 class="font-bold text-slate-800 text-lg flex items-center gap-2">
                        <span class="material-symbols-rounded text-[#044FA0]">forum</span>
                        Riwayat Tindak Lanjut
                    </h3>
                    <div class="space-y-4">
                        @foreach($pengaduan->tanggapans as $tanggapan)
                            <div class="rounded-2xl border border-[#e4ebf5] bg-white p-5 shadow-sm">
                                <div class="flex items-center gap-3 mb-3 border-b border-[#e4ebf5] pb-3">
                                    <div class="h-8 w-8 rounded-full bg-[#f0f7ff] border border-[#b6d0ee] flex items-center justify-center text-[#044FA0] font-bold text-xs shrink-0">
                                        <span class="material-symbols-rounded text-[18px]">admin_panel_settings</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">{{ $tanggapan->user->nama ?? 'Admin/Petugas' }} <span class="font-normal text-xs text-slate-500 ml-1">({{ $tanggapan->user->role ?? '-' }})</span></p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">{{ $tanggapan->created_at->translatedFormat('d M Y - H:i') }}</p>
                                    </div>
                                </div>
                                <div class="text-sm text-slate-700 leading-relaxed bg-[#f8fafc] p-3 rounded-xl whitespace-pre-line border border-slate-100">
                                    {{ $tanggapan->tanggapan }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Form Tindak Lanjut (Right Sidebar) -->
            <div class="space-y-6">
                <!-- Action Form Container -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm sticky top-24">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="flex items-center justify-center h-8 w-8 rounded-full bg-[#e8f1fb] text-[#044FA0] shrink-0">
                            <span class="material-symbols-rounded text-[18px]">edit_document</span>
                        </div>
                        <h3 class="font-bold text-slate-900 tracking-tight">Kirim Tindak Lanjut</h3>
                    </div>

                    <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <!-- Change Status -->
                        <div>
                            <label for="status" class="block text-sm font-bold text-slate-700 mb-1.5 focus-within:text-[#044FA0] transition-colors">Perbarui Status</label>
                            <div class="relative">
                                <select id="status" name="status" class="block w-full appearance-none rounded-xl border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-[#044FA0] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#044FA0]/10 transition-all @error('status') border-red-500 bg-red-50 focus:ring-red-100 @enderror">
                                    <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>⏳ Menunggu (Pending)</option>
                                    <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>⚙️ Sedang Diproses</option>
                                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                    <span class="material-symbols-rounded text-[20px]">expand_more</span>
                                </div>
                            </div>
                            @error('status') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            <p class="text-[11px] text-slate-400 mt-2 leading-tight">Ubah status ini untuk memberitahu siswa tentang perkembangan laporan.</p>
                        </div>

                        <!-- Response Message -->
                        <div>
                            <label for="tanggapan" class="block text-sm font-bold text-slate-700 mb-1.5 focus-within:text-[#044FA0] transition-colors">Isi Pesan / Tanggapan <span class="text-red-500">*</span></label>
                            <textarea id="tanggapan" name="tanggapan" rows="4"
                                      class="block w-full appearance-none rounded-xl border border-slate-300 bg-slate-50 p-4 text-sm text-slate-900 focus:border-[#044FA0] focus:bg-white focus:outline-none focus:ring-4 focus:ring-[#044FA0]/10 transition-all placeholder:text-slate-400 resize-none font-medium leading-relaxed @error('tanggapan') border-red-500 bg-red-50 focus:ring-red-100 @enderror"
                                      placeholder="Tuliskan respon, jawaban, atau hasil penyelesaian laporan di sini..." required>{{ old('tanggapan') }}</textarea>
                            @error('tanggapan') <p class="mt-1.5 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <hr class="border-dashed border-slate-200">

                        <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-xl bg-[#044FA0] px-4 py-3 text-sm font-bold text-white shadow-sm hover:bg-[#033a75] focus:outline-none focus:ring-4 focus:ring-[#044FA0]/30 transition-all">
                            <span class="material-symbols-rounded text-[20px]">send</span>
                            Simpan & Kirim
                        </button>
                    </form>
                </div>

                <!-- Admin Policy Note -->
                <div class="rounded-xl border border-blue-200 bg-blue-50 p-4">
                    <h4 class="text-xs font-bold text-[#044FA0] uppercase flex items-center gap-1.5 mb-2 tracking-wider">
                        <span class="material-symbols-rounded text-[16px]">policy</span>
                        Kebijakan Privasi
                    </h4>
                    <p class="text-[11px] text-slate-700 leading-relaxed text-justify">
                        Tindak lanjut yang Anda berikan bersifat permanen dan sah. Jika pelapor menggunakan identitas "Anonim", pastikan kerahasiaan masalah mereka terlindungi demi keamanan pelapor.
                    </p>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection
