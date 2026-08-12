@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                {{ Auth::user()->isKhitanan() ? 'Dashboard Undangan Khitanan 👦' : 'Dashboard Undangan Pernikahan 💍' }}
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                {{ Auth::user()->isKhitanan() ? 'Ringkasan aktivitas dan metrik syukuran khitanan Anda' : 'Ringkasan aktivitas dan metrik pernikahan Anda' }}
            </p>
        </div>
        <div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ Auth::user()->isKhitanan() ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-pink-100 text-pink-800 border border-pink-300' }}">
                {{ Auth::user()->isKhitanan() ? 'Kategori: Khitanan' : 'Kategori: Pernikahan' }}
            </span>
        </div>
    </div>

    @if (session('status'))
        <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm" role="alert">
            <div class="flex items-center gap-3">
                <i class="fas fa-info-circle text-emerald-500 text-lg"></i>
                <p class="text-sm font-medium text-emerald-800">{{ session('status') }}</p>
            </div>
        </div>
    @endif

    @php
        $userSlug = Auth::user()->getOrGenerateSlug();
        $userWeddingUrl = url('/undangan/' . $userSlug);
    @endphp

    <!-- Welcome Banner -->
    <div class="mb-8 overflow-hidden rounded-2xl bg-gradient-to-r {{ Auth::user()->isKhitanan() ? 'from-emerald-700 to-teal-800' : 'from-indigo-600 to-violet-600' }} shadow-lg text-white">
        <div class="p-6 sm:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="space-y-2 max-w-2xl">
                <h2 class="text-2xl font-bold">
                    {{ Auth::user()->isKhitanan() ? 'Selamat Datang di Panel Undangan Khitanan!' : 'Selamat Datang di Panel Undangan Pernikahan!' }}
                </h2>
                <p class="{{ Auth::user()->isKhitanan() ? 'text-emerald-100' : 'text-indigo-100' }} text-sm leading-relaxed">
                    @if(Auth::user()->isKhitanan())
                        Melalui panel ini, Anda dapat mengelola data ananda yang dikhitan, data orang tua, detail waktu & lokasi tasyakuran, daftar konfirmasi kehadiran (RSVP), ucapan & doa, serta rekening kado khitan.
                    @else
                        Melalui panel ini, Anda dapat mengelola data biodata pengantin, detail waktu & lokasi acara, daftar konfirmasi kehadiran tamu (RSVP), ucapan & doa restu, serta nomor rekening hadiah.
                    @endif
                </p>
            </div>
            <a href="{{ $userWeddingUrl }}" target="_blank" 
                class="flex-shrink-0 inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-white {{ Auth::user()->isKhitanan() ? 'text-emerald-800 hover:bg-emerald-50' : 'text-indigo-700 hover:bg-indigo-50' }} text-sm font-extrabold shadow-md hover:shadow-lg transition-all">
                <i class="fas fa-external-link-alt text-emerald-600"></i> Lihat Undangan Saya
            </a>
        </div>
    </div>

    <!-- Quick Link Card for Tenant's Website -->
    <div class="mb-8 p-6 bg-white rounded-2xl border border-indigo-100 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="p-3.5 bg-indigo-50 text-indigo-600 rounded-xl flex-shrink-0">
                <i class="fas fa-link text-2xl"></i>
            </div>
            <div>
                <span class="block text-xs font-bold text-indigo-600 uppercase tracking-wider">Link Website Undangan Saya</span>
                <span class="text-sm font-mono text-slate-800 font-semibold break-all">{{ $userWeddingUrl }}</span>
            </div>
        </div>
        <div class="flex items-center gap-2 w-full sm:w-auto flex-shrink-0">
            <button onclick="copyDashboardLink('{{ $userWeddingUrl }}')" 
                    class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-xl text-xs font-bold transition-colors">
                <i class="fas fa-copy"></i> Salin Link
            </button>
            <a href="{{ $userWeddingUrl }}" target="_blank" 
               class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition-colors shadow-sm">
                <i class="fas fa-external-link-alt"></i> Buka Website
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

@push('scripts')
<script>
    function copyDashboardLink(link) {
        navigator.clipboard.writeText(link).then(() => {
            alert('Link undangan Anda berhasil disalin:\n' + link);
        });
    }
</script>
@endpush
