<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Luiz-Wedding') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/wa-preview.png') }}">

    <!-- Fonts & Icons -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="h-full font-sans antialiased text-slate-800 bg-gradient-to-tr from-slate-900 via-slate-800 to-indigo-950 flex items-center justify-center p-4">

    <div class="max-w-lg w-full bg-white/95 backdrop-blur-xl rounded-3xl p-8 sm:p-10 shadow-2xl border border-white/20 text-center relative overflow-hidden my-auto">
        <!-- Subtle Glow Background Effect -->
        <div class="absolute -top-24 -left-24 w-48 h-48 bg-rose-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Brand Logo -->
        <div class="flex items-center justify-center gap-2 mb-6 text-slate-800">
            <span class="text-2xl">❤️</span>
            <span class="text-xl font-extrabold tracking-tight">{{ $store_name ?? config('app.name', "Lu'iz-Wedding") }}</span>
        </div>

        <!-- Error Icon Badge -->
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl mb-6 shadow-inner @yield('icon-bg', 'bg-rose-50 text-rose-500')">
            @yield('icon')
        </div>

        <!-- Status Code Badge -->
        <div class="mb-2">
            <span class="inline-block px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full @yield('code-bg', 'bg-rose-100 text-rose-700')">
                Error @yield('code')
            </span>
        </div>

        <!-- Title -->
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-3">
            @yield('header')
        </h1>

        <!-- Description -->
        <p class="text-sm sm:text-base text-slate-600 mb-8 leading-relaxed">
            @yield('message')
        </p>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
            @auth
                <a href="{{ route('admin.home') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl transition-all shadow-md shadow-indigo-200">
                    <i class="fas fa-tachometer-alt"></i> Kembali ke Dashboard
                </a>
            @else
                <a href="{{ url('/') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl transition-all shadow-md shadow-indigo-200">
                    <i class="fas fa-home"></i> Halaman Utama
                </a>
            @endauth

            <button onclick="window.history.back()" 
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm rounded-xl transition-all">
                <i class="fas fa-arrow-left"></i> Halaman Sebelumnya
            </button>
        </div>

        <!-- Footer Notice -->
        <div class="mt-8 pt-6 border-t border-slate-100 text-xs text-slate-400">
            Jika Anda merasa ini adalah kesalahan, silakan hubungi tim administrator.
        </div>
    </div>

</body>
</html>
