@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Edit Turut Mengundang</h1>
            <p class="text-sm text-slate-500 mt-1">Perbarui data nama yang turut mengundang</p>
        </div>
        <a href="{{ route('turutMengundang.index') }}" 
           class="inline-flex items-center gap-1.5 px-4 py-2 border border-slate-200 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm max-w-2xl">
        <div class="p-6 sm:p-8">
            <form action="{{ route('turutMengundang.update', $turutMengundang->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nama / Gelar / Keluarga Besar <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $turutMengundang->nama) }}" required 
                           placeholder="Contoh: Bpk. H. Ahmad & Istri / Keluarga Besar H. Mansyur"
                           class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                    @error('nama')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Hubungan / Keterangan (Opsional):</label>
                    <input type="text" name="hubungan" value="{{ old('hubungan', $turutMengundang->hubungan) }}" 
                           placeholder="Contoh: Paman Pengantin Pria / Keluarga Besar Pengantin Wanita"
                           class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                    @error('hubungan')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Urutan Tampilan:</label>
                    <input type="number" name="urutan" value="{{ old('urutan', $turutMengundang->urutan) }}" min="0" 
                           class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                    <p class="text-xs text-slate-400 mt-1">Angka lebih kecil akan ditampilkan lebih awal di halaman undangan.</p>
                </div>

                <div class="border-t border-slate-100 pt-6 flex justify-end gap-3">
                    <a href="{{ route('turutMengundang.index') }}" 
                       class="px-4 py-2 border border-slate-200 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold transition-colors shadow-sm">
                        <i class="fas fa-save mr-1"></i> Perbarui Nama
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
