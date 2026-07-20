@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Tambah Biodata Wanita</h1>
        <p class="text-sm text-slate-500 mt-1">Lengkapi informasi biodata pengantin wanita</p>
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
            <h3 class="text-lg font-bold text-slate-900">Form Biodata Pengantin Wanita</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('biodataWanita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1" for="nama">Nama Lengkap Pengantin Wanita<span class="text-rose-500">*</span></label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                                   placeholder="Contoh: Hamidah Salsabila"
                                   class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1" for="bapak">Nama Bapak<span class="text-rose-500">*</span></label>
                            <input type="text" id="bapak" name="bapak" value="{{ old('bapak') }}" required
                                   placeholder="Nama Bapak"
                                   class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1" for="asal">Asal / Lokasi (Kota/Kabupaten)</label>
                            <input type="text" id="asal" name="asal" value="{{ old('asal') }}"
                                   placeholder="Contoh: Sukabumi"
                                   class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1" for="ibu">Nama Ibu<span class="text-rose-500">*</span></label>
                            <input type="text" id="ibu" name="ibu" value="{{ old('ibu') }}" required
                                   placeholder="Nama Ibu"
                                   class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1" for="foto">Foto Profil</label>
                            <input type="file" id="foto" name="foto"
                                   class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1" for="deskripsi">Deskripsi Singkat / Kutipan Kata Pengantin Wanita:<span class="text-rose-500">*</span></label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" required placeholder="Tuliskan cerita singkat atau kutipan mutiara dari pengantin wanita..."
                              class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="border-t border-slate-100 pt-6 flex flex-col sm:flex-row justify-between gap-4">
                    <a href="{{ route('biodataWanita.index') }}" 
                       class="inline-flex justify-center items-center gap-1.5 px-4 py-2 border border-slate-200 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex justify-center items-center gap-1.5 px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
