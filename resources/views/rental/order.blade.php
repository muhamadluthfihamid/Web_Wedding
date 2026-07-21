@extends('admin.layouts.auth')

@section('main-content')
<div class="sm:mx-auto sm:w-full sm:max-w-xl">
    <div class="bg-white py-10 px-8 shadow-xl border border-slate-100 sm:rounded-2xl sm:px-12">

        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center p-3 bg-indigo-50 rounded-full text-indigo-600 mb-4">
                <i class="fas fa-box-open text-3xl"></i>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900">Pesan Paket: {{ $package->nama }}</h1>
            <p class="text-sm text-slate-500 mt-1">Isi form di bawah dan upload bukti transfer untuk mengaktifkan sewa.</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg">
                <ul class="list-disc list-inside text-sm text-rose-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Info Paket --}}
        <div class="mb-6 p-4 bg-indigo-50 border border-indigo-200 rounded-xl">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold text-indigo-500 uppercase tracking-wide">Paket Dipilih</span>
                    <p class="font-bold text-slate-900 text-lg">{{ $package->nama }}</p>
                    <p class="text-sm text-slate-500">{{ $package->durasi_teks }}</p>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-black text-indigo-700">{{ $package->harga_format }}</p>
                </div>
            </div>
        </div>

        {{-- Info Rekening --}}
        <div class="mb-6 p-4 bg-amber-50 border border-amber-200 rounded-xl">
            <p class="text-sm font-bold text-amber-800 mb-2"><i class="fas fa-wallet mr-1"></i> Transfer ke:</p>
            <p class="text-sm text-slate-700">Bank BCA – <strong>1234567890</strong> a/n <strong>Luiz Wedding</strong></p>
            <p class="text-xs text-slate-500 mt-1">Nominal transfer: <strong>{{ $package->harga_format }}</strong></p>
        </div>

        <form action="{{ route('rental.order') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <input type="hidden" name="rental_package_id" value="{{ $package->id }}">

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">
                    Bukti Transfer <span class="text-rose-500">*</span>
                </label>
                <input type="file" name="bukti_transfer" accept="image/*,.pdf" required
                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-slate-200 rounded-lg cursor-pointer">
                <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, atau PDF. Maks. 2MB.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Catatan (opsional)</label>
                <textarea name="catatan_user" rows="3" placeholder="Tambahkan catatan jika diperlukan..."
                    class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm">{{ old('catatan_user') }}</textarea>
            </div>

            <div class="pt-2 flex gap-3">
                <a href="{{ route('rental.index') }}"
                    class="flex-1 text-center py-3 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    ← Kembali
                </a>
                <button type="submit"
                    class="flex-1 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold transition-colors shadow-sm">
                    <i class="fas fa-paper-plane mr-1"></i> Kirim Pesanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
