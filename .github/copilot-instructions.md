# Project Context
- Framework: Laravel
- Bahasa utama untuk UI dan prompt: Bahasa Indonesia
- Aplikasi: Pengaduan Siswa

# Styling & UI Pattern
- Gunakan Tailwind CSS untuk semua kebutuhan styling.
- Gunakan Tailwind CDN, BUKAN via Vite (kecuali diinstruksikan sebaliknya).
- Terapkan gaya desain "minimalist modern".
- Gunakan warna `#044FA0` sebagai warna utama (primary color) untuk tombol, border, aksen, dan elemen interaktif lainnya.

# Database & Laravel Conventions
- Pada Migration, gunakan metode modern seperti `$table->foreignId('kolom')->constrained()->onDelete('cascade')` untuk foreign keys.
- Gunakan tipe `enum` untuk field pilihan yang sudah pasti (contoh: status, klasifikasi).
- Pastikan menyertakan default value yang sesuai untuk field boolean, enum, atau timestamp.

# Alur Sistem (Workflow)
Berdasarkan arsitektur Helpdesk Pengaduan Siswa, patuhi alur kerja berikut saat membangun fitur:
- **Autentikasi & Pengaturan Akses (Middleware)**: Gunakan Middleware untuk memisahkan hak akses antara Pelapor (Siswa) dan Petugas (Admin), serta arahkan login ke dashboard masing-masing.
- **Sisi Siswa (Pelapor)**:
  1. Login untuk mengakses **Dashboard Siswa** (untuk melihat status laporan).
  2. Melakukan pengaduan dengan **Mengisi Form Laporan** (Judul, Isi Laporan, Foto). Sertakan **opsi Anonim** yang bila dipilih, identitas pelapor akan dirahasiakan dari petugas/admin.
  3. Sistem memvalidasi input form & foto, lalu menyimpan ke tabel `pengaduan` dengan status awal **"Menunggu"** (Pending).
  4. Siswa bertugas **Memantau Tanggapan** dan perubahan status laporan dari halaman mereka.
- **Sisi Admin (Petugas)**:
  1. Login untuk mengakses **Dashboard Admin** (berisi Statistik Laporan).
  2. Melihat **Daftar Laporan Siswa** lalu memilih laporan (dimulai dari yang berstatus "Menunggu"). Jika laporan ditandai sebagai **Anonim**, pastikan identitas asli siswa disembunyikan (tidak ditampilkan) di tampilan Admin.
  3. Melakukan **Verifikasi & Tindak Lanjut**.
  4. Melakukan aksi: **Input Tanggapan** & **Ganti Status** (menjadi "Diproses" atau "Selesai").
  5. Sistem akan menyimpan hasil balasan ke tabel `tanggapan` dan meng-update status di tabel `pengaduan`.
