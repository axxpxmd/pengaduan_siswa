@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-card">
        <div class="dashboard-header">
            <h1 class="dashboard-greeting">Halo, {{ Auth::user()->nama }}!</h1>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
        <p class="dashboard-message">Selamat datang di <b>Dashboard Pengaduan Siswa</b>.</p>
        <div class="dashboard-info">
            <div class="info-item">
                <span class="info-label">Username:</span>
                <span class="info-value">{{ Auth::user()->username }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Role:</span>
                <span class="info-value">{{ ucfirst(Auth::user()->role) }}</span>
            </div>
        </div>
        <div class="dashboard-tip">
            <span class="tip-title">Tips:</span>
            <span class="tip-content">Gunakan menu navigasi untuk mengelola pengaduan siswa dengan mudah dan cepat.</span>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.dashboard-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f7fafd;
}
.dashboard-card {
    background: #fff;
    padding: 2.5rem 2.2rem 2.2rem 2.2rem;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(4, 79, 160, 0.10);
    min-width: 340px;
    max-width: 420px;
    width: 100%;
    text-align: left;
    position: relative;
}
.dashboard-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.2rem;
}
.dashboard-greeting {
    color: #044FA0;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
}
.logout-form {
    margin: 0;
}
.btn-logout {
    background: #fff;
    color: #044FA0;
    border: 1.5px solid #044FA0;
    border-radius: 7px;
    padding: 0.45rem 1.1rem;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
    margin-left: 1.2rem;
}
.btn-logout:hover {
    background: #044FA0;
    color: #fff;
}
.dashboard-message {
    color: #044FA0;
    font-size: 1.1rem;
    font-weight: 500;
    margin-bottom: 1.3rem;
    text-align: left;
}
.dashboard-info {
    margin-bottom: 1.2rem;
}
.info-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.4rem;
}
.info-label {
    color: #044FA0;
    font-weight: 500;
    font-size: 1rem;
}
.info-value {
    color: #222;
    font-size: 1rem;
    font-weight: 400;
}
.dashboard-tip {
    background: #eaf3fb;
    border-left: 4px solid #044FA0;
    border-radius: 7px;
    padding: 0.7rem 1rem;
    margin-top: 1.2rem;
    color: #044FA0;
    font-size: 0.98rem;
    display: flex;
    flex-direction: column;
}
.tip-title {
    font-weight: 700;
    margin-bottom: 0.2rem;
}
.tip-content {
    font-weight: 400;
}
</style>
@endpush
