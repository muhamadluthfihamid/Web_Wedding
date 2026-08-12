@extends('admin.layouts.admin')

@section('main-content')
<div class="mb-6">
    <a href="{{ route('admin.themes.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition-colors mb-3">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Tema
    </a>
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Edit Tema: {{ $theme->name }}</h1>
    <p class="text-sm text-slate-500 mt-1">Perbarui detail, lokasi view blade, atau thumbnail dari tema ini.</p>
</div>

@if ($errors->any())
    <div class="mb-6 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-xl shadow-sm">
        <ul class="list-disc list-inside text-sm text-rose-700 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="max-w-3xl bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="p-6 sm:p-8">
        <form action="{{ route('admin.themes.update', $theme) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- Nama Tema --}}
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-1" for="name">
                        Nama Tema <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" required value="{{ old('name', $theme->name) }}"
                           class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                </div>

                {{-- Kategori Tema --}}
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-1" for="category">
                        Kategori Undangan <span class="text-rose-500">*</span>
                    </label>
                    <select name="category" id="category" required 
                            class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-slate-900 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                        <option value="wedding" {{ old('category', $theme->category) == 'wedding' ? 'selected' : '' }}>💍 Undangan Pernikahan</option>
                        <option value="khitanan" {{ old('category', $theme->category) == 'khitanan' ? 'selected' : '' }}>👦 Undangan Khitanan</option>
                    </select>
                </div>
            </div>

            {{-- Path File Blade View --}}
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-1" for="blade_path">
                    Lokasi View Blade (blade_path) <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="blade_path" id="blade_path" required value="{{ old('blade_path', $theme->blade_path) }}"
                       class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-slate-900 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- Deskripsi Tema --}}
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-1" for="description">
                    Deskripsi Tema
                </label>
                <textarea name="description" id="description" rows="3"
                          class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $theme->description) }}</textarea>
            </div>

            {{-- Thumbnail Gambar --}}
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-1" for="thumbnail">
                    Thumbnail Gambar Preview (Opsional)
                </label>
                @if($theme->thumbnail)
                    <div class="mb-3 flex items-center gap-3">
                        <img src="{{ asset('storage/' . $theme->thumbnail) }}" alt="{{ $theme->name }}" class="w-20 h-20 rounded-xl object-cover border border-slate-200 shadow-xs">
                        <span class="text-xs text-slate-400">Thumbnail saat ini</span>
                    </div>
                @endif
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                       class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-slate-200 rounded-xl cursor-pointer">
            </div>

            {{-- Checkbox Status Aktif --}}
            <div class="flex items-center gap-3 pt-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $theme->is_active) ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500">
                <label for="is_active" class="text-sm font-semibold text-slate-800 cursor-pointer">
                    Aktifkan tema ini
                </label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex gap-3">
                <a href="{{ route('admin.themes.index') }}" class="px-5 py-2.5 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold shadow-sm transition-colors">
                    <i class="fas fa-save mr-1"></i> Perbarui Tema
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
