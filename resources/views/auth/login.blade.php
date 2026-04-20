@extends('layouts.app')

@section('title', 'Login')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
@endpush

@section('content')
<div class="flex min-h-screen items-center justify-center px-4 py-12 sm:px-6 lg:px-8 [background:radial-gradient(circle_at_12%_12%,rgba(4,79,160,0.15),transparent_36%),radial-gradient(circle_at_88%_88%,rgba(4,79,160,0.12),transparent_35%),linear-gradient(160deg,#f7fafd_0%,#edf4fc_100%)]">
    <div class="w-full max-w-[420px] rounded-2xl border border-[#e4ebf5] bg-white p-8 shadow-[0_18px_45px_rgba(15,23,42,0.08)] sm:p-10">
        <div class="text-center">
            <div class="mx-auto mb-4 inline-flex h-16 w-16 items-center justify-center rounded-full bg-[#e8f1fb]">
                <span class="material-symbols-rounded text-4xl text-[#044FA0]">account_circle</span>
            </div>
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
                <div class="flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 p-4">
                    <span class="material-symbols-rounded text-red-500">error</span>
                    <p class="text-sm font-medium text-red-600">
                        {{ $errors->first() }}
                    </p>
                </div>
            @endif

            <div class="space-y-5">
                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-slate-700">Username</label>
                    <div class="mt-2 relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 pl-3.5 flex items-center">
                            <span class="material-symbols-rounded text-[22px] text-slate-400">person</span>
                        </div>
                        <input id="username" type="text" name="username" required autofocus autocomplete="username" class="block w-full rounded-xl border-0 py-2.5 pl-11 pr-3.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-inset focus:ring-[#044FA0] sm:text-sm sm:leading-6 bg-slate-50/50 transition duration-200 outline-none">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-slate-700">Password</label>
                    <div class="mt-2 relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 pl-3.5 flex items-center">
                            <span class="material-symbols-rounded text-[22px] text-slate-400">lock</span>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-xl border-0 py-2.5 pl-11 pr-3.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:bg-white focus:ring-2 focus:ring-inset focus:ring-[#044FA0] sm:text-sm sm:leading-6 bg-slate-50/50 transition duration-200 outline-none">
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="group flex w-full items-center justify-center gap-2 rounded-xl bg-[#044FA0] px-4 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-[#03458c] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#044FA0]">
                    <span>Login</span>
                    <span class="material-symbols-rounded text-[20px] transition-transform group-hover:translate-x-1">login</span>
                </button>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-[#044FA0] hover:text-[#03458c] transition-colors">
                    <span class="material-symbols-rounded text-[18px]">arrow_back</span>
                    Kembali ke Beranda
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
