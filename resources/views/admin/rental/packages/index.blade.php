@extends('admin.layouts.admin')

@section('main-content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Paket Sewa</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola daftar paket yang ditawarkan kepada penyewa</p>
    </div>
    <a href="{{ route('admin.rental.packages.create') }}"
        class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold transition-colors">
        <i class="fas fa-plus"></i> Tambah Paket
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($packages as $pkg)
    <div class="bg-white rounded-2xl border-2 {{ $pkg->is_populer ? 'border-violet-400' : 'border-slate-100' }} shadow-sm p-6 relative">
        @if($pkg->is_populer)
        <span class="absolute -top-3 left-4 px-3 py-1 bg-violet-600 text-white text-xs font-bold rounded-full">Terpopuler</span>
        @endif
        <div class="flex items-start justify-between mb-4">
            <div>
                <h3 class="text-lg font-extrabold text-slate-900">{{ $pkg->nama }}</h3>
                <p class="text-2xl font-black text-indigo-700 mt-1">{{ $pkg->harga_format }}</p>
                <p class="text-xs text-slate-400">{{ $pkg->durasi_teks }}</p>
            </div>
            <span class="px-2 py-1 rounded-lg text-xs font-semibold {{ $pkg->is_aktif ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                {{ $pkg->is_aktif ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>
        <p class="text-sm text-slate-500 mb-4">{{ $pkg->deskripsi }}</p>
        <ul class="space-y-1.5 mb-6 text-sm">
            @foreach ($pkg->fitur ?? [] as $f)
            <li class="flex items-start gap-2 text-slate-600">
                <i class="fas fa-check text-{{ $pkg->warna_badge }}-500 mt-0.5 flex-shrink-0"></i>{{ $f }}
            </li>
            @endforeach
        </ul>
        <div class="flex gap-2 border-t border-slate-100 pt-4">
            <a href="{{ route('admin.rental.packages.edit', $pkg) }}"
                class="flex-1 text-center py-2 bg-amber-50 text-amber-700 rounded-xl text-sm font-semibold hover:bg-amber-100 transition-colors">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <form action="{{ route('admin.rental.packages.destroy', $pkg) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="btn-delete-package px-4 py-2 bg-rose-50 text-rose-700 rounded-xl text-sm font-semibold hover:bg-rose-100 transition-colors"
                    data-nama="{{ $pkg->nama }}">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12 text-slate-400">
        <i class="fas fa-box-open text-4xl mb-3"></i>
        <p>Belum ada paket. <a href="{{ route('admin.rental.packages.create') }}" class="text-indigo-600 font-semibold">Tambah sekarang</a></p>
    </div>
    @endforelse
</div>

@push('scripts')
<script>
document.querySelectorAll('.btn-delete-package').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        const form = this.closest('form');
        Swal.fire({
            title: 'Hapus Paket?',
            text: `Paket "${this.dataset.nama}" akan dihapus permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(r => { if (r.isConfirmed) form.submit(); });
    });
});
</script>
@endpush
@endsection
