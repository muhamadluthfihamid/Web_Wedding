@extends('admin.layouts.admin')

@section('main-content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Kelola Katalog Tema</h1>
        <p class="text-sm text-slate-500 mt-1">Daftar semua tema desain undangan pernikahan & khitanan yang dapat ditinjau dan disewa customer.</p>
    </div>
    <div class="flex-shrink-0">
        <a href="{{ route('admin.themes.create') }}" 
           class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold text-sm transition-all shadow-sm">
            <i class="fas fa-plus-circle"></i> Tambah Tema Baru
        </a>
    </div>
</div>

@if (session('success'))
    <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm">
        <div class="flex items-center gap-3">
            <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
            <p class="text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
        </div>
    </div>
@endif

{{-- Filter Category & Status --}}
<div class="mb-6 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-wrap items-center justify-between gap-4">
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.themes.index') }}" 
           class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all {{ !request('category') ? 'bg-indigo-600 text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            Semua Category
        </a>
        <a href="{{ route('admin.themes.index', ['category' => 'wedding']) }}" 
           class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all {{ request('category') === 'wedding' ? 'bg-pink-600 text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            💍 Pernikahan
        </a>
        <a href="{{ route('admin.themes.index', ['category' => 'khitanan']) }}" 
           class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all {{ request('category') === 'khitanan' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            👦 Khitanan
        </a>
    </div>

    <form method="GET" action="{{ route('admin.themes.index') }}" class="flex items-center gap-2">
        @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama tema..." 
               class="px-3 py-1.5 text-xs border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <button type="submit" class="px-3 py-1.5 bg-slate-800 text-white rounded-lg text-xs font-semibold hover:bg-slate-900">
            Cari
        </button>
    </form>
</div>

{{-- Grid Tema --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($themes as $theme)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition-all">
            <div>
                {{-- Thumbnail or Gradient Header --}}
                <div class="h-44 bg-slate-900 relative overflow-hidden flex items-center justify-center">
                    @if($theme->thumbnail)
                        <img src="{{ asset('storage/' . $theme->thumbnail) }}" alt="{{ $theme->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br {{ $theme->category == 'wedding' ? 'from-pink-600 to-rose-700' : 'from-emerald-600 to-teal-800' }} flex items-center justify-center text-white">
                            <i class="fas {{ $theme->category == 'wedding' ? 'fa-rings-wedding' : 'fa-child' }} text-5xl opacity-40"></i>
                        </div>
                    @endif

                    <div class="absolute top-3 left-3 flex gap-2">
                        <span class="px-2.5 py-1 text-[10px] font-extrabold uppercase rounded-full text-white bg-black/40 backdrop-blur-md">
                            {{ $theme->category == 'wedding' ? '💍 Pernikahan' : '👦 Khitanan' }}
                        </span>
                    </div>

                    <div class="absolute top-3 right-3">
                        <span class="px-2.5 py-1 text-[10px] font-extrabold uppercase rounded-full text-white {{ $theme->is_active ? 'bg-emerald-600' : 'bg-rose-600' }}">
                            {{ $theme->is_active ? 'Aktif' : 'Non-Aktif' }}
                        </span>
                    </div>
                </div>

                {{-- Information Body --}}
                <div class="p-5">
                    <h3 class="font-bold text-slate-900 text-lg mb-1">{{ $theme->name }}</h3>
                    <p class="text-xs font-mono text-indigo-600 mb-2">blade: {{ $theme->blade_path }}</p>
                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">{{ $theme->description }}</p>
                </div>
            </div>

            {{-- Card Footer & Actions --}}
            <div class="p-5 pt-0 border-t border-slate-50 mt-auto flex flex-col gap-2">
                <div class="flex items-center gap-2 pt-3">
                    <a href="{{ route('dashboard.demo', ['theme' => $theme->slug]) }}" target="_blank" 
                       class="flex-1 text-center py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-xl text-xs font-bold transition-colors">
                        <i class="fas fa-external-link-alt mr-1"></i> Review Live Demo
                    </a>

                    <a href="{{ route('admin.themes.edit', $theme) }}" 
                       class="p-2 bg-amber-50 hover:bg-amber-100 text-amber-700 rounded-xl text-xs font-bold transition-colors" title="Edit Tema">
                        <i class="fas fa-edit text-sm"></i>
                    </a>

                    <form action="{{ route('admin.themes.toggleStatus', $theme) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 rounded-xl text-xs font-bold transition-colors {{ $theme->is_active ? 'bg-rose-50 hover:bg-rose-100 text-rose-700' : 'bg-emerald-50 hover:bg-emerald-100 text-emerald-700' }}" 
                                title="{{ $theme->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                            <i class="fas {{ $theme->is_active ? 'fa-eye-slash' : 'fa-check' }} text-sm"></i>
                        </button>
                    </form>

                    <form action="{{ route('admin.themes.destroy', $theme) }}" method="POST" id="delete-theme-{{ $theme->id }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDeleteTheme({{ $theme->id }}, '{{ $theme->name }}')" 
                                class="p-2 bg-slate-100 hover:bg-rose-100 hover:text-rose-700 text-slate-500 rounded-xl text-xs font-bold transition-colors" title="Hapus Tema">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-2xl border border-slate-100 p-12 text-center text-slate-400">
            <i class="fas fa-palette text-4xl mb-3 text-slate-300"></i>
            <p class="text-base font-bold text-slate-700">Belum ada tema ditemukan.</p>
            <p class="text-xs text-slate-500 mt-1">Klik tombol 'Tambah Tema Baru' untuk menambahkan tema undangan baru.</p>
        </div>
    @endforelse
</div>

@if($themes->hasPages())
    <div class="mt-6">
        {{ $themes->appends(request()->query())->links() }}
    </div>
@endif

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDeleteTheme(id, name) {
        Swal.fire({
            title: 'Hapus Tema?',
            text: "Tema '" + name + "' akan dihapus dari katalog!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-theme-' + id).submit();
            }
        });
    }
</script>
@endpush
@endsection
