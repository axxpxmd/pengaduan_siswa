@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex min-h-screen items-center justify-center px-4 py-12 sm:px-6 lg:px-8 [background:radial-gradient(circle_at_12%_12%,rgba(4,79,160,0.15),transparent_36%),radial-gradient(circle_at_88%_88%,rgba(4,79,160,0.12),transparent_35%),linear-gradient(160deg,#f7fafd_0%,#edf4fc_100%)]">
    <div class="w-full max-w-[420px] rounded-2xl border border-[#e4ebf5] bg-white p-8 shadow-[0_18px_45px_rgba(15,23,42,0.08)] sm:p-10">
        <div class="text-center">
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                Masuk ke <span class="text-[#044FA0]">Akun</span>
            </h2>
            <p class="mt-2 text-sm text-slate-500">
                Silakan login untuk melanjutkan
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
            @csrf

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 p-4">
                    <p class="text-center text-sm font-medium text-red-600">
                        {{ $errors->first() }}
                    </p>
                </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-slate-700">Username</label>
                    <div class="mt-2 text-slate-900">
                        <input id="username" type="text" name="username" required autofocus autocomplete="username" class="block w-full rounded-xl border-0 py-2.5 px-3.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-inset focus:ring-[#044FA0] sm:text-sm sm:leading-6 bg-slate-50/50 transition duration-200 outline-none">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-slate-700">Password</label>
                    <div class="mt-2">
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-xl border-0 py-2.5 px-3.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-inset focus:ring-[#044FA0] sm:text-sm sm:leading-6 bg-slate-50/50 transition duration-200 outline-none">
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="flex w-full items-center justify-center rounded-xl bg-[#044FA0] px-4 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-[#03458c] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#044FA0]">
                    Login
                </button>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="text-sm font-medium text-[#044FA0] hover:text-[#03458c] transition-colors">
                    &larr; Kembali ke Beranda
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
