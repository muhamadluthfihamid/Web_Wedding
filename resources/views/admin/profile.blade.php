@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ __('Profile') }}</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola informasi profil dan keamanan akun Anda</p>
    </div>


    @if ($errors->any())
        <div class="mb-6 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg shadow-sm" role="alert">
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <!-- Profile summary card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden lg:col-span-1">
            <div class="h-32 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
            <div class="px-6 pb-6 relative">
                <div class="flex justify-center -mt-16 mb-4">
                    <div class="h-32 w-32 rounded-full border-4 border-white bg-indigo-600 text-white flex items-center justify-center font-bold text-4xl shadow-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
                <div class="text-center space-y-1">
                    <h2 class="text-xl font-bold text-slate-900">{{ Auth::user()->fullName }}</h2>
                    <p class="text-sm text-slate-500 uppercase tracking-wider font-semibold">{{ ucfirst(Auth::user()->role) }}</p>
                </div>
            </div>
        </div>

        <!-- Edit Profile Form card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden lg:col-span-2">
            <div class="px-6 py-5 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">Informasi Akun</h3>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('profile.update') }}" autocomplete="off" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-400">Informasi Pribadi</h4>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700">Nama Depan<span class="text-rose-500">*</span></label>
                            <input type="text" id="name" name="name" required value="{{ old('name', Auth::user()->name) }}"
                                class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-slate-700">Nama Belakang</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}"
                                class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email<span class="text-rose-500">*</span></label>
                        <input type="email" id="email" name="email" required value="{{ old('email', Auth::user()->email) }}"
                            class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                    </div>

                    <div class="border-t border-slate-100 pt-6">
                        <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-400 mb-6">Ubah Password (Opsional)</h4>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-slate-700">Password Sekarang</label>
                                <input type="password" id="current_password" name="current_password" placeholder="••••••••"
                                    class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                            </div>

                            <div>
                                <label for="new_password" class="block text-sm font-medium text-slate-700">Password Baru</label>
                                <input type="password" id="new_password" name="new_password" placeholder="••••••••"
                                    class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                            </div>

                            <div>
                                <label for="confirm_password" class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                                <input type="password" id="confirm_password" name="password_confirmation" placeholder="••••••••"
                                    class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-6 flex justify-end">
                        <button type="submit"
                            class="inline-flex justify-center py-2.5 px-6 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
