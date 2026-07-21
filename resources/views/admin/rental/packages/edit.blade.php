@extends('admin.layouts.admin')

@section('main-content')
<div class="mb-6">
    <a href="{{ route('admin.rental.packages.index') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-slate-700 mb-3">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <h1 class="text-2xl font-bold text-slate-900">Edit Paket: {{ $package->nama }}</h1>
</div>

<div class="max-w-2xl bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
    <form action="{{ route('admin.rental.packages.update', $package) }}" method="POST" class="space-y-5">
        @csrf @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Paket <span class="text-rose-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $package->nama) }}" required
                    class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Warna Badge</label>
                <select name="warna_badge" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach(['indigo', 'violet', 'rose', 'amber', 'emerald', 'blue'] as $color)
                    <option value="{{ $color }}" {{ old('warna_badge', $package->warna_badge) === $color ? 'selected' : '' }}>{{ ucfirst($color) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Harga (Rp) <span class="text-rose-500">*</span></label>
                <input type="number" name="harga" value="{{ old('harga', $package->harga) }}" required min="0"
                    class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Durasi (hari) <span class="text-rose-500">*</span></label>
                <input type="number" name="durasi_hari" value="{{ old('durasi_hari', $package->durasi_hari) }}" required min="1"
                    class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="2" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('deskripsi', $package->deskripsi) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Fitur <span class="text-xs text-slate-400">(satu fitur per baris)</span></label>
            <textarea name="fitur" rows="6" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-sm font-mono focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('fitur', implode("\n", $package->fitur ?? [])) }}</textarea>
        </div>

        <div class="flex gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_aktif" value="1" {{ old('is_aktif', $package->is_aktif) ? 'checked' : '' }}
                    class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                <span class="text-sm font-medium text-slate-700">Paket Aktif</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_populer" value="1" {{ old('is_populer', $package->is_populer) ? 'checked' : '' }}
                    class="rounded border-slate-300 text-violet-600 focus:ring-violet-500">
                <span class="text-sm font-medium text-slate-700">Tandai sebagai Terpopuler</span>
            </label>
        </div>

        <div class="flex gap-3 pt-2">
            <a href="{{ route('admin.rental.packages.index') }}"
                class="flex-1 text-center py-3 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                Batal
            </a>
            <button type="submit"
                class="flex-1 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold transition-colors">
                <i class="fas fa-save mr-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
