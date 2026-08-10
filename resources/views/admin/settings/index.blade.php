@extends('admin.layouts.admin')

@section('title', 'Pengaturan Toko & Platform')

@section('main-content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
            <i class="fas fa-store text-indigo-600"></i> Pengaturan Toko & Platform
        </h1>
        <p class="text-sm text-slate-500 mt-1">Kelola nama platform/toko undangan digital. Hanya dapat diakses oleh <span class="font-semibold text-rose-600">Super Admin</span>.</p>
    </div>
    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200 shadow-sm">
        <i class="fas fa-shield-alt"></i> Super Admin Only
    </div>
</div>

<div class="max-w-4xl space-y-6">

    @if(session('success'))
    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-sm">
        <i class="fas fa-check-circle text-emerald-500 text-xl flex-shrink-0"></i>
        <span class="font-medium text-sm">{{ session('success') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-3 shadow-sm">
        <i class="fas fa-exclamation-circle text-rose-500 text-xl flex-shrink-0 mt-0.5"></i>
        <div>
            <h4 class="font-bold text-sm">Terjadi Kesalahan:</h4>
            <ul class="list-disc list-inside text-sm mt-1 space-y-0.5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 sm:p-8 border-b border-slate-100 bg-gradient-to-r from-slate-900 to-indigo-950 text-white">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-500/20 border border-indigo-400/30 flex items-center justify-center text-indigo-400 text-2xl shadow-inner">
                    <i class="fas fa-shop"></i>
                </div>
                <div>
                    <h3 class="text-lg font-extrabold tracking-tight">Identitas Toko / Brand Platform</h3>
                    <p class="text-xs text-slate-300 mt-0.5">Nama toko ini akan tampil secara otomatis di seluruh header admin, preloader, landing page, dan metadata aplikasi.</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Store Name Input -->
            <div class="space-y-2">
                <label for="store_name" class="block text-sm font-semibold text-slate-700">
                    Nama Toko / Platform <span class="text-rose-500">*</span>
                </label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-store"></i>
                    </div>
                    <input type="text" name="store_name" id="store_name" value="{{ old('store_name', $storeName) }}" required
                        class="block w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm transition-all"
                        placeholder="Contoh: Luiz-Wedding">
                </div>
                <p class="text-xs text-slate-500">Nama yang dimasukkan di sini akan langsung menggantikan nama default toko di seluruh antarmuka aplikasi.</p>
            </div>

            <!-- Preview Card -->
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block">Preview Brand</span>
                <div class="flex items-center gap-2 text-slate-900 font-extrabold text-lg">
                    <i class="fas fa-heart text-rose-500 text-xl animate-pulse"></i>
                    <span id="preview-store-name">{{ $storeName }}</span>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm shadow-md hover:shadow-indigo-500/25 transition-all">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('store_name');
        const preview = document.getElementById('preview-store-name');

        if (input && preview) {
            input.addEventListener('input', function() {
                preview.textContent = this.value.trim() || "Lu'iz-Wedding";
            });
        }
    });
</script>
@endsection
