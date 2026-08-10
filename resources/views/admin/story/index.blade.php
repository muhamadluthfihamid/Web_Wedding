@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ Auth::user()->isKhitanan() ? 'Ungkapan Harapan & Doa' : 'Cerita Kita (Story)' }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ Auth::user()->isKhitanan() ? 'Kelola ungkapan bahagia dan harapan untuk ananda khitan' : 'Kelola lini masa cerita perjalanan cinta Anda' }}</p>
        </div>
        @if(!$story)
            <div class="flex-shrink-0">
                <a class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors" 
                   href="{{ route('story.create') }}" title="Tambah Cerita" role="button">
                    <i class="fas fa-plus"></i> Tambah Cerita
                </a>
            </div>
        @endif
    </div>

    @if($story)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h3 class="text-lg font-bold text-slate-900">{{ Auth::user()->isKhitanan() ? 'Ungkapan Harapan & Doa Orang Tua' : 'Perjalanan Cinta Pengantin' }}</h3>
                <div class="flex items-center gap-2">
                    <a href="{{ route('story.edit', $story) }}" 
                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-amber-50 hover:bg-amber-100 text-amber-700 rounded-lg text-sm font-semibold transition-colors">
                        <i class="fas fa-edit"></i> Edit Cerita
                    </a>
                    <button class="inline-flex items-center gap-1.5 px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg text-sm font-semibold transition-colors" 
                            onclick="confirmDelete({{ $story->id }})">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                    <form id="delete-form-{{ $story->id }}" action="{{ route('story.destroy', $story) }}"
                        method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
            
            <div class="p-6 space-y-8">
                <!-- Grid Cerita -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Pertama Bertemu / Momen Kelahiran -->
                    <div class="bg-slate-50/50 p-5 rounded-2xl border border-slate-100 space-y-4">
                        <div class="flex items-center gap-2 text-indigo-600 font-bold text-sm">
                            <span class="px-2 py-1 bg-indigo-50 rounded-lg">1</span> {{ Auth::user()->isKhitanan() ? 'Momen Kelahiran / Kehadiran' : 'Pertama Bertemu' }}
                        </div>
                        <h4 class="text-lg font-bold text-slate-900">{{ $story->judul_bertemu }}</h4>
                        <div class="text-xs text-slate-400 font-semibold flex items-center gap-1">
                            <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($story->tgl_bertemu)->translatedFormat('d F Y') }}
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ $story->note_bertemu }}</p>
                        @if($story->foto_bertemu)
                            <div class="pt-2">
                                <img src="{{ asset('storage/' . $story->foto_bertemu) }}" alt="foto_bertemu" class="w-full h-40 object-cover rounded-xl border border-slate-100 shadow-sm">
                            </div>
                        @endif
                    </div>

                    <!-- Hubungan Serius / Tumbuh Kembang -->
                    <div class="bg-slate-50/50 p-5 rounded-2xl border border-slate-100 space-y-4">
                        <div class="flex items-center gap-2 text-indigo-600 font-bold text-sm">
                            <span class="px-2 py-1 bg-indigo-50 rounded-lg">2</span> {{ Auth::user()->isKhitanan() ? 'Tumbuh Kembang Ananda' : 'Hubungan Serius' }}
                        </div>
                        <h4 class="text-lg font-bold text-slate-900">{{ $story->judul_serius }}</h4>
                        <div class="text-xs text-slate-400 font-semibold flex items-center gap-1">
                            <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($story->tgl_serius)->translatedFormat('d F Y') }}
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ $story->note_serius }}</p>
                        @if($story->foto_serius)
                            <div class="pt-2">
                                <img src="{{ asset('storage/' . $story->foto_serius) }}" alt="foto_serius" class="w-full h-40 object-cover rounded-xl border border-slate-100 shadow-sm">
                            </div>
                        @endif
                    </div>

                    <!-- Tunangan / Doa Khitanan -->
                    <div class="bg-slate-50/50 p-5 rounded-2xl border border-slate-100 space-y-4">
                        <div class="flex items-center gap-2 text-indigo-600 font-bold text-sm">
                            <span class="px-2 py-1 bg-indigo-50 rounded-lg">3</span> {{ Auth::user()->isKhitanan() ? 'Doa & Momen Khitanan' : 'Lamaran / Tunangan' }}
                        </div>
                        <h4 class="text-lg font-bold text-slate-900">{{ $story->judul_tunangan }}</h4>
                        <div class="text-xs text-slate-400 font-semibold flex items-center gap-1">
                            <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($story->tgl_tunangan)->translatedFormat('d F Y') }}
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ $story->note_tunangan }}</p>
                        @if($story->foto_tunangan)
                            <div class="pt-2">
                                <img src="{{ asset('storage/' . $story->foto_tunangan) }}" alt="foto_tunangan" class="w-full h-40 object-cover rounded-xl border border-slate-100 shadow-sm">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Deskripsi Latar / Penutup -->
                @if($story->deskripsi)
                    <div class="bg-indigo-50/30 p-5 rounded-2xl border border-indigo-50/80 space-y-2">
                        <h4 class="text-sm font-bold text-indigo-900 flex items-center gap-1.5">
                            <i class="fas fa-heart text-rose-500"></i> {{ Auth::user()->isKhitanan() ? 'Ungkapan Rasa Syukur & Doa Penutup' : 'Ringkasan / Catatan Akhir Cerita' }}
                        </h4>
                        <p class="text-sm text-slate-700 leading-relaxed">{{ $story->deskripsi }}</p>
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-12 text-center space-y-4">
            <div class="inline-flex items-center justify-center p-4 bg-indigo-50 text-indigo-600 rounded-full shadow-inner">
                <i class="fas fa-book-open text-4xl"></i>
            </div>
            <div class="space-y-1">
                <h3 class="text-lg font-bold text-slate-950">{{ Auth::user()->isKhitanan() ? 'Belum Ada Ungkapan Harapan & Doa' : 'Belum Ada Cerita Lini Masa' }}</h3>
                <p class="text-sm text-slate-500 max-w-sm mx-auto">{{ Auth::user()->isKhitanan() ? 'Tuliskan ungkapan rasa syukur, doa, dan cerita perjalanan ananda agar para tamu dapat membaca ucapan hangat Anda.' : 'Tulis perjalanan cinta Anda agar para tamu dapat melihat kisah indah Anda di undangan pernikahan.' }}</p>
            </div>
            <a class="inline-flex items-center justify-center gap-1.5 px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors" 
               href="{{ route('story.create') }}">
                <i class="fas fa-plus"></i> {{ Auth::user()->isKhitanan() ? 'Mulai Tulis Harapan & Doa' : 'Mulai Tulis Cerita' }}
            </a>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Semua data cerita perjalanan cinta ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
