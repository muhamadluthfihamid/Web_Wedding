@extends('admin.layouts.auth')

@section('main-content')
<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <div class="flex justify-center text-indigo-600">
        <span class="text-4xl font-extrabold tracking-tight flex items-center gap-2">
            <i class="fas fa-heart text-rose-500 animate-pulse"></i>
            <span>{{ $store_name ?? config('app.name', "Lu'iz-Wedding") }}</span>
        </span>
    </div>
    <h2 class="mt-6 text-center text-3xl font-bold text-slate-900 tracking-tight">Verifikasi Email Anda</h2>
    <p class="mt-2 text-center text-sm text-slate-600">
        Silakan verifikasi alamat email Anda sebelum melanjutkan
    </p>
</div>

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow-xl border border-slate-100 sm:rounded-2xl sm:px-10">
        
        @if (session('resent'))
            <div class="mb-4 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm text-sm text-emerald-800 animate-fade-in" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <div class="text-sm text-slate-600 space-y-4 leading-relaxed">
            <p>
                {{ __('Before proceeding, please check your email for a verification link.') }}
            </p>
            <p>
                {{ __('If you did not receive the email') }}, silakan klik tombol di bawah ini untuk mengirim ulang link verifikasi.
            </p>
        </div>

        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <div class="mt-6">
                <button type="submit"
                    class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    {{ __('click here to request another') }}
                </button>
            </div>
        </form>

        <div class="mt-6 border-t border-slate-100 pt-6 text-center">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 text-sm font-semibold text-rose-600 hover:text-rose-500 transition-colors bg-transparent border-0 cursor-pointer">
                    <i class="fas fa-sign-out-alt"></i> Keluar / Logout
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
