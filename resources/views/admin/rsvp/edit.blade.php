@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ __('Edit RSVP') }}</h1>
        <p class="text-sm text-slate-500 mt-1">Perbarui data konfirmasi kehadiran tamu</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg shadow-sm" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-rose-500"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-semibold text-rose-800">Terdapat beberapa kesalahan:</h3>
                    <ul class="mt-2 list-disc list-inside text-sm text-rose-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-xl bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h3 class="text-lg font-bold text-slate-900">Edit Konfirmasi: {{ $rsvp->nama_tamu }}</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('rsvp.update', $rsvp) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1" for="nama_tamu">Nama Tamu:</label>
                    <input type="text" id="nama_tamu" name="nama_tamu" value="{{ old('nama_tamu', $rsvp->nama_tamu) }}" required
                           class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all"
                           placeholder="Nama Tamu">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1" for="kehadiran">Kehadiran:</label>
                    <select name="kehadiran" id="kehadiran" required
                            class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        <option value="1" {{ old('kehadiran', $rsvp->kehadiran) ? 'selected' : '' }}>Hadir</option>
                        <option value="0" {{ !old('kehadiran', $rsvp->kehadiran) ? 'selected' : '' }}>Tidak Hadir</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1" for="jumlah">Jumlah Tamu (Pax):</label>
                    <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $rsvp->jumlah) }}" min="1" required
                           class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                </div>

                <div class="border-t border-slate-100 pt-6 flex justify-between gap-4">
                    <a href="{{ route('rsvp.index') }}" 
                       class="inline-flex justify-center items-center gap-1.5 px-4 py-2 border border-slate-200 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex justify-center items-center gap-1.5 px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="fas fa-save"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
