@extends('admin.layouts.auth')

@section('main-content')
<div class="sm:mx-auto sm:w-full sm:max-w-2xl">

    {{-- Flash --}}
    @if (session('success'))
    <div class="mb-4 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl text-emerald-800 text-sm font-medium flex items-center gap-2">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif
    @if (session('info'))
    <div class="mb-4 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-xl text-blue-800 text-sm font-medium flex items-center gap-2">
        <i class="fas fa-info-circle"></i> {{ session('info') }}
    </div>
    @endif

    <div class="bg-white py-10 px-8 shadow-xl border border-slate-100 sm:rounded-2xl sm:px-12">

        <div class="text-center mb-8">
            <h1 class="text-2xl font-extrabold text-slate-900">Status Sewa Anda</h1>
            <p class="text-sm text-slate-500 mt-1">Halo, <strong>{{ $user->full_name }}</strong></p>
        </div>

        @if ($order)
            {{-- Status Badge --}}
            <div class="flex justify-center mb-6">
                @php $color = $order->status_color; @endphp
                <span class="inline-flex items-center gap-2 px-5 py-2 bg-{{ $color }}-100 text-{{ $color }}-700 rounded-full text-sm font-bold border border-{{ $color }}-200">
                    @if($order->status === 'active') <i class="fas fa-check-circle"></i>
                    @elseif($order->status === 'pending') <i class="fas fa-clock"></i>
                    @elseif($order->status === 'expired') <i class="fas fa-times-circle"></i>
                    @else <i class="fas fa-ban"></i>
                    @endif
                    {{ $order->status_label }}
                </span>
            </div>

            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 space-y-4">
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500 font-medium">Paket</span>
                    <span class="font-bold text-slate-900">{{ $order->package->nama }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500 font-medium">Harga</span>
                    <span class="font-semibold text-slate-900">{{ $order->package->harga_format }}</span>
                </div>
                @if($order->tanggal_mulai)
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500 font-medium">Mulai</span>
                    <span class="font-semibold text-slate-900">{{ $order->tanggal_mulai->translatedFormat('d F Y') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500 font-medium">Berakhir</span>
                    <span class="font-semibold text-slate-900">{{ $order->tanggal_selesai->translatedFormat('d F Y') }}</span>
                </div>
                @endif
                @if($order->status === 'active')
                <div class="flex justify-between text-sm border-t border-slate-200 pt-4">
                    <span class="text-slate-500 font-medium">Sisa Waktu</span>
                    <span class="font-bold text-emerald-600">{{ $order->sisaHari() }} hari</span>
                </div>
                @endif
                @if($order->catatan_admin)
                <div class="border-t border-slate-200 pt-4">
                    <p class="text-xs text-slate-500 font-medium mb-1">Catatan Admin:</p>
                    <p class="text-sm text-slate-700">{{ $order->catatan_admin }}</p>
                </div>
                @endif
            </div>

            {{-- Active: tampilkan link undangan --}}
            @if($order->status === 'active' && $user->slug)
            <div class="mt-6 p-5 bg-indigo-50 border border-indigo-200 rounded-2xl">
                <p class="text-sm font-bold text-indigo-800 mb-2"><i class="fas fa-link mr-1"></i> Link Undangan Anda:</p>
                <div class="flex items-center gap-2">
                    <input type="text" id="wedding-link" readonly
                        value="{{ url('/undangan/' . $user->slug) }}"
                        class="flex-1 text-sm px-3 py-2 bg-white border border-indigo-200 rounded-lg text-indigo-700 font-mono">
                    <button onclick="copyLink()" class="px-3 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700 transition-colors">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                <div class="mt-3 flex gap-2">
                    <a href="{{ url('/undangan/' . $user->slug) }}" target="_blank"
                        class="flex-1 text-center py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors">
                        <i class="fas fa-external-link-alt mr-1"></i> Buka Undangan
                    </a>
                    <a href="{{ route('admin.home') }}"
                        class="flex-1 text-center py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors">
                        <i class="fas fa-cog mr-1"></i> Kelola Konten
                    </a>
                </div>
            </div>
            @endif

            {{-- Pending --}}
            @if($order->status === 'pending')
            <div class="mt-6 p-4 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-800">
                <i class="fas fa-info-circle mr-1"></i>
                Pesanan Anda sedang menunggu verifikasi pembayaran oleh admin. Proses biasanya <strong>1x24 jam</strong>.
            </div>
            @endif

        @else
            {{-- Belum ada order --}}
            <div class="text-center py-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-2xl mb-4">
                    <i class="fas fa-shopping-cart text-slate-400 text-2xl"></i>
                </div>
                <p class="text-slate-600 font-medium mb-2">Anda belum memiliki pesanan sewa.</p>
                <p class="text-slate-400 text-sm mb-6">Pilih paket yang sesuai untuk mulai menggunakan layanan ini.</p>

                <div class="grid grid-cols-1 sm:grid-cols-{{ $packages->count() }} gap-4 text-left">
                    @foreach ($packages as $pkg)
                    <a href="{{ route('rental.orderForm', $pkg) }}"
                        class="block p-5 border-2 {{ $pkg->is_populer ? 'border-violet-400 bg-violet-50' : 'border-slate-200 bg-white' }} rounded-2xl hover:shadow-md transition-all">
                        <span class="text-xs font-semibold text-slate-400 uppercase">{{ $pkg->nama }}</span>
                        <p class="text-2xl font-black text-slate-900 my-1">{{ $pkg->harga_format }}</p>
                        <p class="text-xs text-slate-500">{{ $pkg->durasi_teks }}</p>
                        <p class="mt-3 text-sm font-semibold text-indigo-600">Pilih Paket →</p>
                    </a>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-8 border-t border-slate-100 pt-6 text-center">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            <a href="#" onclick="document.getElementById('logout-form').submit()"
                class="text-sm text-rose-500 hover:text-rose-600 font-semibold">
                <i class="fas fa-sign-out-alt mr-1"></i> Logout
            </a>
        </div>
    </div>
</div>

<script>
    function copyLink() {
        var input = document.getElementById('wedding-link');
        navigator.clipboard.writeText(input.value).then(function () {
            alert('Link berhasil disalin!');
        });
    }
</script>
@endsection
