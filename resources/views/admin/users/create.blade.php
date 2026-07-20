@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ __('Tambah User Baru') }}</h1>
        <p class="text-sm text-slate-500 mt-1">Buat akun pengguna baru dengan hak akses tertentu</p>
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

    <div class="max-w-3xl bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-900">Form Informasi User</h3>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700" for="name">Nama Depan<span class="text-rose-500">*</span></label>
                        <input type="text" id="name" class="mt-1 block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all" 
                               name="name" placeholder="Nama Depan" value="{{ old('name') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700" for="last_name">Nama Belakang<span class="text-rose-500">*</span></label>
                        <input type="text" id="last_name" class="mt-1 block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all" 
                               name="last_name" placeholder="Nama Belakang" value="{{ old('last_name') }}" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="email">Alamat Email<span class="text-rose-500">*</span></label>
                    <input type="email" id="email" class="mt-1 block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all" 
                           name="email" placeholder="contoh@mail.com" value="{{ old('email') }}" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700" for="role">Hak Akses / Role<span class="text-rose-500">*</span></label>
                    <select name="role" id="role" class="mt-1 block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all" required>
                        <option value="" disabled selected>Pilih Role...</option>
                        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User (Penyewa)</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin (Akses Edit Undangan)</option>
                        <option value="superadmin" {{ old('role') === 'superadmin' ? 'selected' : '' }}>Superadmin (Akses Penuh)</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700" for="password">Password<span class="text-rose-500">*</span></label>
                        <input type="password" id="password" class="mt-1 block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all" 
                               name="password" placeholder="Minimal 8 karakter" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700" for="password_confirmation">Konfirmasi Password<span class="text-rose-500">*</span></label>
                        <input type="password" id="password_confirmation" class="mt-1 block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all" 
                               name="password_confirmation" placeholder="Tulis ulang password" required>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-6 flex flex-col sm:flex-row justify-between gap-4">
                    <a href="{{ route('users.index') }}" 
                       class="inline-flex justify-center items-center gap-1.5 px-4 py-2 border border-slate-200 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex justify-center items-center gap-1.5 px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="fas fa-save"></i> Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
