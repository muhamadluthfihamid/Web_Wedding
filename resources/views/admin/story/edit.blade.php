@extends('admin.layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ Auth::user()->isKhitanan() ? 'Edit Ungkapan Harapan & Doa' : 'Edit Cerita Perjalanan Cinta' }}</h1>
        <p class="text-sm text-slate-500 mt-1">{{ Auth::user()->isKhitanan() ? 'Perbarui ungkapan bahagia dan doa untuk ananda khitan dalam 3 bagian' : 'Perbarui kisah perjalanan cinta Anda dalam 3 tahap penting' }}</p>
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

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-8">
        <form action="{{ route('story.update', $story) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
            @csrf
            @method('PUT')

            <!-- Ringkasan Deskripsi -->
            <div class="bg-indigo-50/30 p-5 rounded-2xl border border-indigo-50/80">
                <label class="block text-sm font-bold text-indigo-900 mb-2" for="deskripsi">{{ Auth::user()->isKhitanan() ? 'Ungkapan Rasa Syukur & Doa Penutup:' : 'Deskripsi / Ringkasan Cerita Penutup:' }}</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" required placeholder="{{ Auth::user()->isKhitanan() ? 'Tuliskan ungkapan rasa syukur dan doa penutup dari keluarga...' : 'Tuliskan kata-kata indah penutup cerita...' }}"
                          class="block w-full px-3 py-2.5 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">{{ old('deskripsi', $story->deskripsi) }}</textarea>
            </div>

            <!-- Tiga Tahap Cerita Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-4">
                <!-- Tahap 1: Pertama Bertemu / Momen Kelahiran -->
                <div class="bg-slate-50/50 p-5 rounded-2xl border border-slate-100 space-y-4">
                    <h4 class="text-sm font-bold text-indigo-600 uppercase tracking-wider flex items-center gap-1.5">
                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-700">1</span>
                        {{ Auth::user()->isKhitanan() ? 'Momen Kelahiran / Kehadiran' : 'Pertama Bertemu' }}
                    </h4>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500">{{ Auth::user()->isKhitanan() ? 'Judul Momen / Profil:' : 'Judul Cerita:' }}</label>
                            <input type="text" name="judul_bertemu" required value="{{ old('judul_bertemu', $story->judul_bertemu) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500">Tanggal:</label>
                            <input type="date" name="tgl_bertemu" required value="{{ old('tgl_bertemu', $story->tgl_bertemu) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500">{{ Auth::user()->isKhitanan() ? 'Kisah / Catatan Kehadiran:' : 'Kisah/Detail:' }}</label>
                            <textarea name="note_bertemu" rows="4" required
                                      class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">{{ old('note_bertemu', $story->note_bertemu) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500">Ganti Foto:</label>
                            <input type="file" name="foto_bertemu"
                                   class="mt-1 block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                        </div>

                        @if($story->foto_bertemu)
                            <div class="pt-2">
                                <img src="{{ asset('storage/' . $story->foto_bertemu) }}" alt="foto_bertemu" class="w-full h-32 object-cover rounded-xl border border-slate-100 shadow-sm">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tahap 2: Hubungan Serius / Tumbuh Kembang -->
                <div class="bg-slate-50/50 p-5 rounded-2xl border border-slate-100 space-y-4">
                    <h4 class="text-sm font-bold text-indigo-600 uppercase tracking-wider flex items-center gap-1.5">
                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-700">2</span>
                        {{ Auth::user()->isKhitanan() ? 'Tumbuh Kembang Ananda' : 'Hubungan Serius' }}
                    </h4>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500">{{ Auth::user()->isKhitanan() ? 'Judul Tumbuh Kembang:' : 'Judul Cerita:' }}</label>
                            <input type="text" name="judul_serius" required value="{{ old('judul_serius', $story->judul_serius) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500">Tanggal:</label>
                            <input type="date" name="tgl_serius" required value="{{ old('tgl_serius', $story->tgl_serius) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500">{{ Auth::user()->isKhitanan() ? 'Kisah Tumbuh Kembang:' : 'Kisah/Detail:' }}</label>
                            <textarea name="note_serius" rows="4" required
                                      class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">{{ old('note_serius', $story->note_serius) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500">Ganti Foto:</label>
                            <input type="file" name="foto_serius"
                                   class="mt-1 block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                        </div>

                        @if($story->foto_serius)
                            <div class="pt-2">
                                <img src="{{ asset('storage/' . $story->foto_serius) }}" alt="foto_serius" class="w-full h-32 object-cover rounded-xl border border-slate-100 shadow-sm">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tahap 3: Tunangan / Doa Khitanan -->
                <div class="bg-slate-50/50 p-5 rounded-2xl border border-slate-100 space-y-4">
                    <h4 class="text-sm font-bold text-indigo-600 uppercase tracking-wider flex items-center gap-1.5">
                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-700">3</span>
                        {{ Auth::user()->isKhitanan() ? 'Doa & Momen Khitanan' : 'Lamaran / Tunangan' }}
                    </h4>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500">{{ Auth::user()->isKhitanan() ? 'Judul Harapan / Momen:' : 'Judul Cerita:' }}</label>
                            <input type="text" name="judul_tunangan" required value="{{ old('judul_tunangan', $story->judul_tunangan) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500">Tanggal:</label>
                            <input type="date" name="tgl_tunangan" required value="{{ old('tgl_tunangan', $story->tgl_tunangan) }}"
                                   class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500">{{ Auth::user()->isKhitanan() ? 'Harapan & Doa Orang Tua:' : 'Kisah/Detail:' }}</label>
                            <textarea name="note_tunangan" rows="4" required
                                      class="mt-1 block w-full px-3 py-2 border border-slate-200 rounded-lg text-slate-950 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">{{ old('note_tunangan', $story->note_tunangan) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500">Ganti Foto:</label>
                            <input type="file" name="foto_tunangan"
                                   class="mt-1 block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                        </div>

                        @if($story->foto_tunangan)
                            <div class="pt-2">
                                <img src="{{ asset('storage/' . $story->foto_tunangan) }}" alt="foto_tunangan" class="w-full h-32 object-cover rounded-xl border border-slate-100 shadow-sm">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="border-t border-slate-100 pt-6 flex flex-col sm:flex-row justify-between gap-4">
                <a href="{{ route('story.index') }}" 
                   class="inline-flex justify-center items-center gap-1.5 px-4 py-2 border border-slate-200 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" 
                        class="inline-flex justify-center items-center gap-1.5 px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <i class="fas fa-save"></i> {{ Auth::user()->isKhitanan() ? 'Perbarui Harapan & Doa' : 'Perbarui Cerita' }}
                </button>
            </div>
        </form>
    </div>
@endsection
