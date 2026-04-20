@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
    <section class="grid min-h-screen place-items-center px-6 py-8 [background:radial-gradient(circle_at_12%_12%,rgba(4,79,160,0.15),transparent_36%),radial-gradient(circle_at_88%_88%,rgba(4,79,160,0.12),transparent_35%),linear-gradient(160deg,#f7fafd_0%,#edf4fc_100%)]">
        <div class="w-full max-w-[760px] rounded-[22px] border border-[#e4ebf5] bg-white px-6 py-8 shadow-[0_18px_45px_rgba(15,23,42,0.08)] sm:px-9 sm:py-11">
            <span class="inline-flex items-center rounded-full bg-[#e8f1fb] px-3.5 py-2 text-[13px] font-semibold tracking-[0.02em] text-[#044FA0]">
                Portal Pengaduan Siswa
            </span>

            <h1 class="mt-5 text-4xl leading-tight font-bold tracking-[-0.02em] text-slate-900 sm:text-5xl">
                Selamat Datang di <span class="text-[#044FA0]">Pengaduan Siswa</span>
            </h1>

            <p class="mt-3 max-w-[60ch] text-base leading-7 text-slate-500">
                Sampaikan laporan dengan cepat dan terstruktur. Platform ini dirancang untuk membantu
                pengelolaan pengaduan secara rapi, transparan, dan mudah diakses.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a
                    class="inline-flex min-h-[46px] items-center justify-center rounded-xl border border-transparent bg-[#044FA0] px-5 font-semibold text-white transition duration-200 hover:-translate-y-0.5 hover:bg-[#03458c] focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-[#044FA0]/20"
                    href="{{ route('login') }}"
                >
                    Login
                </a>
            </div>
        </div>
    </section>
@endsection
