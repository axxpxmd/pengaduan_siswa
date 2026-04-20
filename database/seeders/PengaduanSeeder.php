<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil id user siswa (pelapor) dan admin/petugas (penanggap)
        $siswaArr = User::where('role', 'siswa')->get();
        $adminArr = User::whereIn('role', ['admin', 'petugas'])->get();

        $siswa = count($siswaArr) > 0 ? $siswaArr->random() : User::first();
        $admin = count($adminArr) > 0 ? $adminArr->random() : User::first();

        $siswaId = $siswa->id;
        $adminId = $admin->id;

        // 1. Data 1: Menunggu (Pending)
        $id_pengaduan_1 = DB::table('pengaduan')->insertGetId([
            'id_user' => $siswaId,
            'klasifikasi' => 'pengaduan',
            'judul' => 'Fasilitas Kamar Mandi Kurang Bersih',
            'isi_laporan' => 'Kamar mandi laki-laki di lantai 2 sangat kotor, berbau, dan airnya sering mati sejak kemarin sore. Mohon segera dibersihkan dan diperbaiki karena sangat mengganggu kenyamanan siswa saat jam istirahat.',
            'foto' => null,
            'tanggal_kejadian' => Carbon::now()->subDays(1)->toDateString(),
            'status' => 'pending',
            'is_anonim' => false,
            'tanggal_lapor' => Carbon::now()->subHours(5),
            'created_at' => Carbon::now()->subHours(5),
            'updated_at' => Carbon::now()->subHours(5),
        ]);

        // 2. Data 2: Diproses (Mendapatkan tanggapan status)
        $id_pengaduan_2 = DB::table('pengaduan')->insertGetId([
            'id_user' => $siswaId,
            'klasifikasi' => 'aspirasi',
            'judul' => 'Saran Penambahan Buku Perpustakaan untuk Jurusan RPL',
            'isi_laporan' => 'Buku-buku referensi untuk jurusan Rekayasa Perangkat Lunak (RPL) menurut saya sangat kurang dan banyak yang edisinya sudah terlalu lama. Kami berharap perpustakaan bisa menambah koleksi buku pemrograman (contoh: Laravel, React, dll).',
            'foto' => null,
            'tanggal_kejadian' => null,
            'status' => 'diproses',
            'is_anonim' => true, // Contoh laporan anonim
            'tanggal_lapor' => Carbon::now()->subDays(6),
            'created_at' => Carbon::now()->subDays(6),
            'updated_at' => Carbon::now()->subDays(4), // Update diproses
        ]);

        DB::table('tanggapans')->insert([
            'id_pengaduan' => $id_pengaduan_2,
            'id_user' => $adminId,
            'tanggapan' => 'Terima kasih atas aspirasinya dari pengirim anonim. Saran ini sudah kami catat dan dikoordinasikan dengan pihak perpustakaan sekolah. Tim perpustakaan saat ini sedang mendata anggaran untuk pengadaan buku referensi RPL baru.',
            'created_at' => Carbon::now()->subDays(4),
            'updated_at' => Carbon::now()->subDays(4),
        ]);

        // 3. Data 3: Selesai (Sudah terselesaikan dengan bukti)
        $id_pengaduan_3 = DB::table('pengaduan')->insertGetId([
            'id_user' => $siswaId,
            'klasifikasi' => 'permintaan_informasi',
            'judul' => 'Kapan Jadwal Resmi PTS Ganjil?',
            'isi_laporan' => 'Selamat Pagi, mohon informasinya kapan jadwal resmi Penilaian Tengah Semester (PTS) dari kurikulum dibagikan? Mengingat sudah memasuki minggu-minggu akhir bulan.',
            'foto' => null,
            'tanggal_kejadian' => null,
            'status' => 'selesai',
            'is_anonim' => false,
            'tanggal_lapor' => Carbon::now()->subDays(14),
            'created_at' => Carbon::now()->subDays(14),
            'updated_at' => Carbon::now()->subDays(12),
        ]);

        DB::table('tanggapans')->insert([
            'id_pengaduan' => $id_pengaduan_3,
            'id_user' => $adminId,
            'tanggapan' => 'Halo! Jadwal PTS sudah disahkan oleh pihak kurikulum. Sesuai agenda, pengumuman akan dibagikan secarak serentak besok siang kepada wali kelas masing-masing. Silakan ditunggu informasinya di grup kelas.',
            'created_at' => Carbon::now()->subDays(13),
            'updated_at' => Carbon::now()->subDays(13),
        ]);

        DB::table('tanggapans')->insert([
            'id_pengaduan' => $id_pengaduan_3,
            'id_user' => $adminId,
            'tanggapan' => 'Jadwal PTS sudah dibagikan kemari ke masing-masing kelas. Laporan ini kami tutup/selesaikan.',
            'created_at' => Carbon::now()->subDays(12),
            'updated_at' => Carbon::now()->subDays(12),
        ]);

        // 4. Data 4: Menunggu (Pending) Lintas masalah
        $id_pengaduan_4 = DB::table('pengaduan')->insertGetId([
            'id_user' => $siswaId,
            'klasifikasi' => 'pengaduan',
            'judul' => 'Kerusakan Ac di Ruang Lab Komputer 2',
            'isi_laporan' => 'AC di Lab Komputer 2 bocor dan airnya berceceran mengenai stop kontak komputer sejak jam pelajaran pertama. Bahaya jika sampai terjadi korsleting listrik.',
            'foto' => null,
            'tanggal_kejadian' => Carbon::now()->toDateString(),
            'status' => 'pending',
            'is_anonim' => true,
            'tanggal_lapor' => Carbon::now()->subHours(2),
            'created_at' => Carbon::now()->subHours(2),
            'updated_at' => Carbon::now()->subHours(2),
        ]);
    }
}
