@extends('admin.layouts.auth')

@section('main-content')
<div class="sm:mx-auto sm:w-full sm:max-w-xl">
    <div class="bg-white py-10 px-8 shadow-xl border border-slate-100 sm:rounded-2xl sm:px-12">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center p-3 bg-indigo-50 rounded-full text-indigo-600 mb-4 shadow-sm">
                <i class="fas fa-store text-4xl"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Pengajuan Sewa Web Undangan</h1>
            <p class="mt-2 text-sm text-slate-600">Halo, <strong class="text-slate-900">{{ Auth::user()->name }}</strong>. Akun Anda telah berhasil terdaftar!</p>
        </div>

        <div class="mb-6 bg-indigo-50 border-l-4 border-indigo-500 p-4 rounded-r-lg" role="alert">
            <div class="flex">
                <div class="flex-shrink-0 text-indigo-500">
                    <i class="fas fa-info-circle text-lg"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-bold text-indigo-800">Status Akun: User (Penyewa)</h3>
                    <p class="mt-2 text-sm text-indigo-700 leading-relaxed">Saat ini akun Anda berada dalam tahap peninjauan sewa. Untuk mulai mengaktifkan website undangan Anda dan mengelola data pengantin, silakan hubungi admin utama untuk peningkatan status ke role <strong>Admin</strong>.</p>
                </div>
            </div>
        </div>

        <div class="text-center my-6 space-y-4">
            <p class="text-sm font-semibold text-slate-800">Hubungi Kami Untuk Aktivasi Sewa:</p>
            <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20mengaktifkan%20sewa%20undangan%20saya%20dengan%20email%20{{ urlencode(Auth::user()->email) }}" target="_blank"
                class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-base font-semibold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors gap-2">
                <i class="fab fa-whatsapp text-lg"></i> Hubungi via WhatsApp
            </a>
        </div>

        <div class="border-t border-slate-200 pt-6 text-center">
            <a class="inline-flex items-center gap-1 text-sm font-semibold text-rose-600 hover:text-rose-500 transition-colors" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Keluar (Logout)
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
