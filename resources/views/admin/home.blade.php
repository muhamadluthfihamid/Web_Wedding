@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ __('Dashboard') }}</h1>
        <p class="text-sm text-slate-500 mt-1">Ringkasan aktivitas dan metrik pernikahan Anda</p>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm" role="alert">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session('status'))
        <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm" role="alert">
            <div class="flex items-center gap-3">
                <i class="fas fa-info-circle text-emerald-500 text-lg"></i>
                <p class="text-sm font-medium text-emerald-800">{{ session('status') }}</p>
            </div>
        </div>
    @endif

    <!-- Welcome Banner -->
    <div class="mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 shadow-lg text-white">
        <div class="p-6 sm:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="space-y-2 max-w-2xl">
                <h2 class="text-2xl font-bold">Selamat Datang di Panel Kontrol Undangan Anda!</h2>
                <p class="text-indigo-100 text-sm leading-relaxed">Melalui panel ini, Anda dapat mengelola data biodata pengantin, detail waktu & lokasi acara, daftar konfirmasi kehadiran tamu (RSVP), ucapan & doa restu, serta nomor rekening hadiah.</p>
            </div>
            <a href="{{ route('dashboard') }}" target="_blank" 
                class="flex-shrink-0 inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white text-indigo-600 hover:bg-indigo-50 text-sm font-semibold shadow-sm transition-colors">
                <i class="fas fa-external-link-alt"></i> Buka Halaman Undangan
            </a>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total RSVP Card -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between hover:shadow-md transition-shadow">
            <div class="space-y-1">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 block">Total Pengisi RSVP</span>
                <span class="text-3xl font-extrabold text-slate-900 block">{{ $widget['totalRsvps'] }}</span>
            </div>
            <div class="p-3.5 bg-indigo-50 rounded-xl text-indigo-600">
                <i class="fas fa-envelope-open-text text-2xl"></i>
            </div>
        </div>

        <!-- Total Attending Guests Card -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between hover:shadow-md transition-shadow">
            <div class="space-y-1">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 block">Total Tamu Hadir (Pax)</span>
                <span class="text-3xl font-extrabold text-slate-900 block">{{ $widget['totalAttendingGuests'] }} <span class="text-sm font-semibold text-slate-500">Orang</span></span>
            </div>
            <div class="p-3.5 bg-emerald-50 rounded-xl text-emerald-600">
                <i class="fas fa-user-check text-2xl"></i>
            </div>
        </div>

        <!-- Total Wishes Card -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between hover:shadow-md transition-shadow">
            <div class="space-y-1">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 block">Total Ucapan & Doa</span>
                <span class="text-3xl font-extrabold text-slate-900 block">{{ $widget['totalWishes'] }}</span>
            </div>
            <div class="p-3.5 bg-sky-50 rounded-xl text-sky-600">
                <i class="fas fa-comments text-2xl"></i>
            </div>
        </div>

        <!-- Attendance Detail Card -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between hover:shadow-md transition-shadow">
            <div class="space-y-1">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 block">Detail Kehadiran</span>
                <span class="text-lg font-bold text-slate-900 block mt-1">
                    <span class="text-emerald-600">{{ $widget['confirmedAttending'] }} Hadir</span>
                    <span class="text-slate-300 mx-1">/</span>
                    <span class="text-slate-500">{{ $widget['confirmedNotAttending'] }} Absen</span>
                </span>
            </div>
            <div class="p-3.5 bg-amber-50 rounded-xl text-amber-500">
                <i class="fas fa-users text-2xl"></i>
            </div>
        </div>
    </div>
@endsection
