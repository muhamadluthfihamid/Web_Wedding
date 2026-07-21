@extends('admin.layouts.admin')

@section('main-content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Kelola Pesanan Sewa</h1>
        <p class="text-sm text-slate-500 mt-1">Verifikasi pembayaran dan aktifkan akses penyewa</p>
    </div>
    <a href="{{ route('admin.rental.packages.index') }}"
        class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold transition-colors">
        <i class="fas fa-box"></i> Kelola Paket
    </a>
</div>

{{-- Stats --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['pending',  'Menunggu',   'amber',   'fas fa-clock',       $stats['pending']],
        ['active',   'Aktif',      'emerald', 'fas fa-check-circle', $stats['active']],
        ['expired',  'Kadaluarsa', 'slate',   'fas fa-times-circle', $stats['expired']],
        ['rejected', 'Ditolak',    'rose',    'fas fa-ban',          $stats['rejected']],
    ] as [$status, $label, $color, $icon, $count])
    <a href="?status={{ $status }}"
        class="bg-white rounded-2xl border border-slate-100 p-4 flex items-center gap-3 shadow-sm hover:shadow-md transition-all {{ request('status') === $status ? 'ring-2 ring-' . $color . '-400' : '' }}">
        <div class="w-10 h-10 bg-{{ $color }}-100 rounded-xl flex items-center justify-center">
            <i class="{{ $icon }} text-{{ $color }}-600"></i>
        </div>
        <div>
            <p class="text-2xl font-black text-slate-900">{{ $count }}</p>
            <p class="text-xs text-slate-500">{{ $label }}</p>
        </div>
    </a>
    @endforeach
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase">Penyewa</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase">Paket</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase">Status</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase">Tanggal Pesan</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase">Berakhir</th>
                    <th class="px-5 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($orders as $order)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-5 py-4">
                        <p class="font-semibold text-slate-900 text-sm">{{ $order->user->full_name }}</p>
                        <p class="text-xs text-slate-400">{{ $order->user->email }}</p>
                    </td>
                    <td class="px-5 py-4 text-sm text-slate-700">{{ $order->package->nama }}</td>
                    <td class="px-5 py-4">
                        @php $c = $order->status_color; @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-{{ $c }}-100 text-{{ $c }}-700">
                            {{ $order->status_label }}
                        </span>
                    </td>
                    <td class="px-5 py-4 text-sm text-slate-500">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="px-5 py-4 text-sm text-slate-500">
                        {{ $order->tanggal_selesai ? $order->tanggal_selesai->format('d M Y') : '-' }}
                    </td>
                    <td class="px-5 py-4 text-right">
                        <a href="{{ route('admin.rental.orders.show', $order) }}"
                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-lg text-xs font-semibold transition-colors">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-10 text-center text-slate-400 text-sm">Belum ada pesanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="px-5 py-4 border-t border-slate-100">{{ $orders->appends(request()->query())->links() }}</div>
    @endif
</div>
@endsection
