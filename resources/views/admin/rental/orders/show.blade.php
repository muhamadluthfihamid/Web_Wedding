@extends('admin.layouts.admin')

@section('main-content')
<div class="mb-6">
    <a href="{{ route('admin.rental.orders.index') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-slate-700 mb-4">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>
    <h1 class="text-2xl font-bold text-slate-900">Detail Pesanan #{{ $order->id }}</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Left: Info --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Status Card --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-slate-900">Info Pesanan</h2>
                @php $c = $order->status_color; @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-{{ $c }}-100 text-{{ $c }}-700">
                    {{ $order->status_label }}
                </span>
            </div>
            <dl class="grid grid-cols-2 gap-4 text-sm">
                <div><dt class="text-slate-400 font-medium">Penyewa</dt><dd class="font-semibold text-slate-900 mt-0.5">{{ $order->user->full_name }}</dd></div>
                <div><dt class="text-slate-400 font-medium">Email</dt><dd class="font-semibold text-slate-900 mt-0.5">{{ $order->user->email }}</dd></div>
                <div>
                    <dt class="text-slate-400 font-medium">Jenis Acara</dt>
                    <dd class="font-bold text-slate-900 mt-0.5 flex items-center gap-1.5">
                        <span class="inline-block px-2.5 py-0.5 text-xs font-bold uppercase rounded-full {{ $order->event_type == 'khitanan' ? 'bg-emerald-100 text-emerald-700' : 'bg-pink-100 text-pink-700' }}">
                            {{ $order->event_type == 'khitanan' ? '👦 Undangan Khitanan' : '💍 Undangan Pernikahan' }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-slate-400 font-medium">Tema Pilihan</dt>
                    <dd class="font-semibold text-slate-900 mt-0.5">{{ $order->theme ? $order->theme->name : '-' }}</dd>
                </div>
                <div><dt class="text-slate-400 font-medium">Paket</dt><dd class="font-semibold text-slate-900 mt-0.5">{{ $order->package->nama }} ({{ $order->package->harga_format }})</dd></div>
                <div><dt class="text-slate-400 font-medium">Durasi</dt><dd class="font-semibold text-slate-900 mt-0.5">{{ $order->package->durasi_teks }}</dd></div>
                <div><dt class="text-slate-400 font-medium">Dipesan Pada</dt><dd class="font-semibold text-slate-900 mt-0.5">{{ $order->created_at->format('d M Y, H:i') }}</dd></div>
                @if($order->tanggal_mulai)
                <div><dt class="text-slate-400 font-medium">Masa Aktif</dt><dd class="font-semibold text-slate-900 mt-0.5">{{ $order->tanggal_mulai->format('d M Y') }} – {{ $order->tanggal_selesai->format('d M Y') }}</dd></div>
                @endif
                @if($order->catatan_user)
                <div class="col-span-2"><dt class="text-slate-400 font-medium">Catatan Penyewa</dt><dd class="font-semibold text-slate-900 mt-0.5">{{ $order->catatan_user }}</dd></div>
                @endif
            </dl>
        </div>

        {{-- Bukti Transfer --}}
        @if($order->bukti_transfer)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-bold text-slate-900 mb-4">Bukti Transfer</h2>
            @if(str_ends_with(strtolower($order->bukti_transfer), '.pdf'))
                <a href="{{ Storage::url($order->bukti_transfer) }}" target="_blank"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-rose-50 text-rose-700 rounded-xl font-semibold text-sm hover:bg-rose-100 transition-colors">
                    <i class="fas fa-file-pdf text-lg"></i> Lihat PDF Bukti Transfer
                </a>
            @else
                <img src="{{ Storage::url($order->bukti_transfer) }}" alt="Bukti Transfer"
                    class="max-w-full rounded-xl border border-slate-100 shadow-sm">
            @endif
        </div>
        @endif
    </div>

    {{-- Right: Actions --}}
    <div class="space-y-5">

        @if($order->status === 'pending')
        {{-- Approve --}}
        <div class="bg-white rounded-2xl border border-emerald-200 shadow-sm p-6">
            <h2 class="font-bold text-emerald-800 mb-1"><i class="fas fa-check-circle text-emerald-500 mr-1"></i> Setujui Pesanan</h2>
            <p class="text-xs text-slate-500 mb-4">Menyetujui akan mengaktifkan akun penyewa sebagai admin dan mengatur masa sewa.</p>
            <form action="{{ route('admin.rental.orders.approve', $order) }}" method="POST">
                @csrf
                <textarea name="catatan_admin" rows="2" placeholder="Catatan untuk penyewa (opsional)"
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm mb-3 focus:ring-2 focus:ring-emerald-400 focus:outline-none"></textarea>
                <button type="submit"
                    class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-sm transition-colors">
                    <i class="fas fa-check mr-1"></i> Setujui & Aktifkan
                </button>
            </form>
        </div>

        {{-- Reject --}}
        <div class="bg-white rounded-2xl border border-rose-200 shadow-sm p-6">
            <h2 class="font-bold text-rose-800 mb-1"><i class="fas fa-times-circle text-rose-500 mr-1"></i> Tolak Pesanan</h2>
            <form action="{{ route('admin.rental.orders.reject', $order) }}" method="POST">
                @csrf
                <textarea name="catatan_admin" rows="2" placeholder="Alasan penolakan (wajib diisi)" required
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm mb-3 focus:ring-2 focus:ring-rose-400 focus:outline-none"></textarea>
                <button type="submit"
                    class="w-full py-3 bg-rose-600 hover:bg-rose-700 text-white rounded-xl font-bold text-sm transition-colors">
                    <i class="fas fa-ban mr-1"></i> Tolak Pesanan
                </button>
            </form>
        </div>

        @elseif($order->status === 'active')
        <div class="bg-white rounded-2xl border border-emerald-100 p-6 text-center mb-5">
            <i class="fas fa-check-circle text-emerald-500 text-3xl mb-2"></i>
            <p class="font-bold text-emerald-800">Sewa Sedang Aktif</p>
            <p class="text-xs text-slate-500 mt-1">Disetujui oleh {{ $order->approvedBy?->full_name ?? '-' }}</p>
            <p class="text-xs text-slate-500 mb-2">{{ $order->approved_at?->format('d M Y, H:i') }}</p>
            <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full border border-emerald-200">
                Sisa {{ $order->sisaHari() }} hari
            </span>
        </div>

        {{-- Nonaktifkan Sewa --}}
        <div class="bg-white rounded-2xl border border-rose-200 shadow-sm p-6">
            <h2 class="font-bold text-rose-800 mb-1"><i class="fas fa-power-off text-rose-500 mr-1"></i> Nonaktifkan Sewa</h2>
            <p class="text-xs text-slate-500 mb-4">Menonaktifkan akan menghentikan akses sewa penyewa ini dan mengembalikan role-nya menjadi user biasa.</p>
            <form action="{{ route('admin.rental.orders.deactivate', $order) }}" method="POST" id="deactivate-form">
                @csrf
                <textarea name="catatan_admin" rows="2" placeholder="Alasan penonaktifan (opsional)"
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm mb-3 focus:ring-2 focus:ring-rose-400 focus:outline-none"></textarea>
                <button type="submit" onclick="confirmDeactivate(event)"
                    class="w-full py-3 bg-rose-600 hover:bg-rose-700 text-white rounded-xl font-bold text-sm transition-colors">
                    <i class="fas fa-power-off mr-1"></i> Nonaktifkan Sewa Ini
                </button>
            </form>
        </div>

        @push('scripts')
        <script>
        function confirmDeactivate(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Nonaktifkan Sewa?',
                text: 'Akses sewa penyewa ini akan langsung dihentikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Nonaktifkan!',
                cancelButtonText: 'Batal'
            }).then((res) => {
                if (res.isConfirmed) {
                    document.getElementById('deactivate-form').submit();
                }
            });
        }
        </script>
        @endpush
        @else
        <div class="bg-white rounded-2xl border border-slate-100 p-6 text-center text-slate-400">
            <i class="fas fa-info-circle text-2xl mb-2"></i>
            <p class="text-sm">Pesanan sudah diproses.</p>
        </div>
        @endif
    </div>
</div>
@endsection
