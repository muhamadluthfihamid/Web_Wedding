@extends('admin.layouts.auth')

@section('main-content')
<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <div class="flex justify-center text-indigo-600">
        <span class="text-4xl font-extrabold tracking-tight flex items-center gap-2">
            <i class="fas fa-heart text-rose-500 animate-pulse"></i>
            <span>Luiz-Wedding</span>
        </span>
    </div>
    <h2 class="mt-6 text-center text-3xl font-bold text-slate-900 tracking-tight">Konfirmasi Password</h2>
    <p class="mt-2 text-center text-sm text-slate-600">
        Silakan konfirmasi password Anda sebelum melanjutkan
    </p>
</div>

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow-xl border border-slate-100 sm:rounded-2xl sm:px-10">
        
        @if ($errors->any())
            <div class="mb-4 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg shadow-sm" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-rose-500"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-rose-800">Terdapat beberapa kesalahan:</h3>
                        <ul class="mt-2 list-disc list-inside text-sm text-rose-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if (session('status'))
            <div class="mb-4 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm text-sm text-emerald-800" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input id="password" name="password" type="password" required autocomplete="current-password" autofocus
                        class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all"
                        placeholder="••••••••">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Konfirmasi Password
                </button>
            </div>
        </form>

        <div class="mt-6 border-t border-slate-100 pt-6 flex justify-between items-center text-sm">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                    Lupa Password?
                </a>
            @endif
            <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                <i class="fas fa-arrow-left"></i> Login
            </a>
        </div>
    </div>
</div>
@endsection
