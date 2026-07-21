@extends('admin.layouts.auth')

@section('main-content')
<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <div class="flex justify-center text-indigo-600">
        <span class="text-4xl font-extrabold tracking-tight flex items-center gap-2">
            <i class="fas fa-heart text-rose-500 animate-pulse"></i>
            <span>Luiz-Wedding</span>
        </span>
    </div>
    <h2 class="mt-6 text-center text-3xl font-bold text-slate-900 tracking-tight">Masuk ke Akun Anda</h2>
    <p class="mt-2 text-center text-sm text-slate-600">
        Atau
        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
            daftar akun baru
        </a>
    </p>
</div>

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow-xl border border-slate-100 sm:rounded-2xl sm:px-10">

        @if ($errors->any())
        <div class="mb-4 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg" role="alert">
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

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}" autofocus
                        class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all"
                        placeholder="nama@email.com">
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="block w-full pl-10 pr-10 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all"
                        placeholder="••••••••">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" id="togglePassword"
                            onclick="togglePasswordVisibility()"
                            class="text-slate-400 hover:text-indigo-500 focus:outline-none transition-colors"
                            aria-label="Toggle password visibility">
                            <i id="togglePasswordIcon" class="fas fa-eye text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            @push('scripts')
            <script>
                function togglePasswordVisibility() {
                    const passwordInput = document.getElementById('password');
                    const toggleIcon = document.getElementById('togglePasswordIcon');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        toggleIcon.classList.remove('fa-eye');
                        toggleIcon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        toggleIcon.classList.remove('fa-eye-slash');
                        toggleIcon.classList.add('fa-eye');
                    }
                }
            </script>
            @endpush

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded cursor-pointer">
                    <label for="remember" class="ml-2 block text-sm text-slate-900 cursor-pointer">Ingat Saya</label>
                </div>

                @if (\Illuminate\Support\Facades\Route::has('password.request'))
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors">
                        Lupa password?
                    </a>
                </div>
                @endif
            </div>

            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Masuk
                </button>
            </div>
        </form>

        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-slate-500">Atau masuk dengan</span>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-3 gap-3">
                <div>
                    <button type="button" class="w-full inline-flex justify-center py-2 px-4 border border-slate-200 rounded-lg bg-white text-sm font-medium text-slate-500 hover:bg-slate-50 transition-colors shadow-sm">
                        <i class="fab fa-github text-lg"></i>
                    </button>
                </div>

                <div>
                    <button type="button" class="w-full inline-flex justify-center py-2 px-4 border border-slate-200 rounded-lg bg-white text-sm font-medium text-slate-500 hover:bg-slate-50 transition-colors shadow-sm">
                        <i class="fab fa-twitter text-lg text-sky-400"></i>
                    </button>
                </div>

                <div>
                    <button type="button" class="w-full inline-flex justify-center py-2 px-4 border border-slate-200 rounded-lg bg-white text-sm font-medium text-slate-500 hover:bg-slate-50 transition-colors shadow-sm">
                        <i class="fab fa-facebook text-lg text-blue-600"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection