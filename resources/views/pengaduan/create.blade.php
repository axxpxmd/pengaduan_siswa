@extends('layouts.app')

@section('title', 'Buat Laporan Pengaduan')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
@endpush

@section('content')
<div class="min-h-screen bg-[#f7fafd]">
    <!-- Navbar / Header (Simple) -->
    <nav class="bg-white border-b border-[#e4ebf5] sticky top-0 z-10 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Back & Brand -->
                <div class="flex items-center gap-4">
                    <a href="{{ url('/dashboard') }}" class="flex items-center justify-center h-10 w-10 rounded-xl bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-[#044FA0] transition">
                        <span class="material-symbols-rounded">arrow_back</span>
                    </a>
                    <span class="font-bold text-xl text-slate-900 tracking-tight">Ketik<span class="text-[#044FA0]">Laporan</span></span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="rounded-2xl border border-[#e4ebf5] bg-white p-6 shadow-[0_8px_30px_rgba(15,23,42,0.04)] sm:p-8">
            <div class="mb-8 border-b border-slate-100 pb-5">
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <span class="material-symbols-rounded text-[#044FA0] text-[28px]">edit_document</span>
                    Formulir Pengaduan Siswa
                </h1>
                <p class="text-slate-500 text-sm mt-2">
                    Sampaikan keluhan, aspirasi, atau permintaan informasi Anda. Laporan akan ditindaklanjuti oleh petugas sekolah.
                </p>
            </div>

            <form action="{{ url('/pengaduan') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Klasifikasi Laporan -->
                <div>
                    <label for="klasifikasi" class="block text-sm font-semibold leading-6 text-slate-800">Klasifikasi Laporan <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <select id="klasifikasi" name="klasifikasi" required class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-[#044FA0] sm:text-sm sm:leading-6 bg-white outline-none">
                            <option value="pengaduan">Pengaduan (Keluhan/Masalah)</option>
                            <option value="aspirasi">Aspirasi (Saran/Gagasan)</option>
                            <option value="permintaan_informasi">Permintaan Informasi (Pertanyaan)</option>
                        </select>
                    </div>
                </div>

                <!-- Judul Laporan -->
                <div>
                    <label for="judul" class="block text-sm font-semibold leading-6 text-slate-800">Judul Laporan <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="text" id="judul" name="judul" required placeholder="Contoh: Lampu Kelas 10A Rusak" class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-[#044FA0] sm:text-sm sm:leading-6 bg-white outline-none">
                    </div>
                </div>

                <!-- Isi Laporan -->
                <div>
                    <label for="isi_laporan" class="block text-sm font-semibold leading-6 text-slate-800">Isi Laporan <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <textarea id="isi_laporan" name="isi_laporan" rows="5" required placeholder="Ceritakan detail kejadian atau masalah yang Anda alami..." class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-[#044FA0] sm:text-sm sm:leading-6 bg-white outline-none resize-y"></textarea>
                    </div>
                </div>

                <!-- Tanggal Kejadian (Opsional) -->
                <div>
                    <label for="tanggal_kejadian" class="block text-sm font-semibold leading-6 text-slate-800">Tanggal Kejadian <span class="text-slate-400 font-normal">(Opsional)</span></label>
                    <div class="mt-2 relative">
                        <input type="date" id="tanggal_kejadian" name="tanggal_kejadian" class="block w-full rounded-xl border-0 py-3 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-[#044FA0] sm:text-sm sm:leading-6 bg-white outline-none">
                    </div>
                    <p class="text-[12px] text-slate-500 mt-1.5">Kosongkan jika laporan tidak berkaitan dengan kejadian pada tanggal tertentu.</p>
                </div>

                <!-- Foto (Opsional) -->
                <div>
                    <label for="foto" class="block text-sm font-semibold leading-6 text-slate-800">Upload Lampiran (Foto) <span class="text-slate-400 font-normal">(Opsional)</span></label>
                    <div class="mt-2">
                        <!-- Tempat Preview Gambar -->
                        <div id="preview-container" class="hidden relative mb-4 rounded-xl border border-slate-200 bg-slate-50 p-2">
                            <img id="image-preview" src="#" alt="Preview Lampiran" class="w-full h-auto max-h-64 object-contain rounded-lg" />
                            <button type="button" id="remove-image" class="absolute top-4 right-4 flex h-8 w-8 items-center justify-center rounded-lg bg-white/90 text-red-500 shadow-sm backdrop-blur-sm transition hover:bg-red-50" title="Hapus gambar">
                                <span class="material-symbols-rounded text-[20px]">delete</span>
                            </button>
                        </div>

                        <!-- Upload Area -->
                        <label id="upload-area" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <span class="material-symbols-rounded text-slate-400 text-3xl mb-2">cloud_upload</span>
                                <p class="text-sm text-slate-500"><span class="font-semibold text-[#044FA0]">Klik untuk upload</span> atau drag and drop</p>
                                <p class="text-xs text-slate-400 mt-1">PNG, JPG, JPEG (Maks. 2MB)</p>
                            </div>
                            <input id="foto" name="foto" type="file" class="hidden" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event)" />
                        </label>
                    </div>
                </div>

                <!-- Opsi Anonim (Check Box) -->
                <div class="bg-[#f0f7ff] rounded-xl p-4 border border-[#b6d0ee]">
                    <div class="relative flex items-start">
                        <div class="flex h-6 items-center">
                            <input id="is_anonim" name="is_anonim" type="checkbox" value="1" class="h-4 w-4 rounded border-slate-300 text-[#044FA0] focus:ring-[#044FA0]">
                        </div>
                        <div class="ml-3 leading-6">
                            <label for="is_anonim" class="font-semibold text-[#033a75]">Kirim sebagai Anonim</label>
                            <p class="text-sm text-[#044FA0]/80">Jika dicentang, identitas dan nama Anda akan dirahasiakan dari petugas maupun siswa lain saat melihat laporan ini.</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 flex items-center justify-end border-t border-slate-100">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-[#044FA0] px-6 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-[#03458c] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#044FA0]">
                        <span class="material-symbols-rounded text-[20px]">send</span>
                        Kirim Laporan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const uploadArea = document.getElementById('upload-area');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
                uploadArea.classList.add('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('remove-image').addEventListener('click', function() {
        document.getElementById('foto').value = '';
        document.getElementById('image-preview').src = '#';
        document.getElementById('preview-container').classList.add('hidden');
        document.getElementById('upload-area').classList.remove('hidden');
    });
</script>
@endsection
