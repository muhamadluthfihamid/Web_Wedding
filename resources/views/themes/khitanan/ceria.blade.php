<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('components.og-meta')
    @php
        $anak = isset($biodataPria) && $biodataPria->isNotEmpty() ? $biodataPria->first() : null;
        $orangtua = isset($biodataWanita) && $biodataWanita->isNotEmpty() ? $biodataWanita->first() : null;
        $namaAnak = $anak ? $anak->nama : 'Ananda';
        $namaLengkap = $anak ? ($anak->nama_lengkap ?? $anak->nama) : 'Ananda';
        $firstInfo = isset($infos) && $infos->isNotEmpty() ? $infos->first() : null;
        $guestTo = request('to') ?: null;
    @endphp

    <title>Undangan Tasyakuran Khitan {{ $namaLengkap }} | {{ $store_name }}</title>

    <!-- Tailwind & Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-fredoka { font-family: 'Fredoka', cursive; }
        .bg-pattern {
            background-color: #f0f9ff;
            background-image: radial-gradient(#38bdf8 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>

<body class="bg-pattern text-slate-800 min-h-screen">

    {{-- Hero Section --}}
    <section class="min-h-screen flex flex-col justify-between p-6 text-center relative overflow-hidden bg-gradient-to-b from-sky-400 to-indigo-600 text-white">
        <div class="pt-8">
            <span class="inline-block px-5 py-2 bg-white/20 backdrop-blur-md border border-white/40 rounded-full text-xs font-bold tracking-widest uppercase">
                🎈 Undangan Tasyakuran Khitan 🎈
            </span>
        </div>

        <div class="py-12" data-aos="bounce-in">
            <div class="w-36 h-36 md:w-44 md:h-44 mx-auto rounded-full p-2 bg-white shadow-2xl mb-6 overflow-hidden">
                <img src="{{ $anak && $anak->foto ? asset('storage/'.$anak->foto) : 'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=400&q=80' }}" 
                     alt="{{ $namaLengkap }}" 
                     class="w-full h-full object-cover rounded-full">
            </div>
            <p class="text-sky-100 text-base font-semibold">Walimatul Khitan</p>
            <h1 class="text-4xl md:text-6xl font-extrabold font-fredoka text-yellow-300 drop-shadow-md my-3">{{ $namaLengkap }}</h1>
            @if($orangtua)
                <p class="text-white/90 text-sm md:text-base font-medium">Putra tercinta dari Bpk. {{ $orangtua->nama_ayah ?? '...' }} & Ibu {{ $orangtua->nama_ibu ?? $orangtua->nama }}</p>
            @endif
        </div>

        @if($guestTo)
        <div class="bg-white/10 backdrop-blur-md border border-white/30 rounded-2xl p-4 max-w-md mx-auto mb-8 shadow-lg">
            <p class="text-xs text-sky-100">Spesial Kepada Yth.</p>
            <p class="text-xl font-bold text-yellow-300 mt-1">{{ $guestTo }}</p>
        </div>
        @endif

        <div class="pb-8">
            <a href="#info-acara" class="inline-flex items-center gap-2 px-8 py-3.5 bg-yellow-400 text-indigo-950 rounded-full font-extrabold text-sm shadow-xl hover:bg-yellow-300 transition-all transform hover:-translate-y-0.5">
                <i class="fas fa-calendar-check"></i> Lihat Acara
            </a>
        </div>
    </section>

    {{-- Tanggal & Lokasi Acara --}}
    @if($firstInfo)
    <section id="info-acara" class="py-16 px-6 max-w-4xl mx-auto">
        <div class="text-center mb-10" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-extrabold font-fredoka text-indigo-900">Waktu & Tempat Syukuran</h2>
            <p class="text-slate-500 text-sm mt-1">Kehadiran dan doa Anda merupakan kebahagiaan bagi kami.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8" data-aos="fade-up">
            <div class="bg-white border border-sky-100 shadow-xl rounded-3xl p-6 hover:shadow-2xl transition-all">
                <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-600 flex items-center justify-center text-xl font-bold mb-4">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="font-bold text-slate-900 text-lg mb-1">Acara Syukuran</h3>
                <p class="text-xs font-semibold text-sky-600 mb-3">{{ $firstInfo->tanggal_akad ? \Carbon\Carbon::parse($firstInfo->tanggal_akad)->translatedFormat('l, d F Y') : '-' }}</p>
                <p class="text-sm text-slate-600 mb-2"><i class="far fa-clock text-sky-500 mr-2"></i> {{ $firstInfo->waktu_akad ?? '08:00 WIB' }}</p>
                <p class="text-sm text-slate-600"><i class="fas fa-map-marker-alt text-sky-500 mr-2"></i> {{ $firstInfo->lokasi_akad ?? 'Kediaman Mempelai' }}</p>
            </div>

            <div class="bg-white border border-indigo-100 shadow-xl rounded-3xl p-6 hover:shadow-2xl transition-all">
                <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl font-bold mb-4">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3 class="font-bold text-slate-900 text-lg mb-1">Ramah Tamah & Jamuan</h3>
                <p class="text-xs font-semibold text-indigo-600 mb-3">{{ $firstInfo->tanggal_resepsi ? \Carbon\Carbon::parse($firstInfo->tanggal_resepsi)->translatedFormat('l, d F Y') : '-' }}</p>
                <p class="text-sm text-slate-600 mb-2"><i class="far fa-clock text-indigo-500 mr-2"></i> {{ $firstInfo->waktu_resepsi ?? '11:00 WIB - Selesai' }}</p>
                <p class="text-sm text-slate-600"><i class="fas fa-map-marker-alt text-indigo-500 mr-2"></i> {{ $firstInfo->lokasi_resepsi ?? 'Kediaman Mempelai' }}</p>
            </div>
        </div>

        @if($firstInfo->link_maps)
        <div class="mt-8 text-center">
            <a href="{{ $firstInfo->link_maps }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-bold rounded-2xl text-sm shadow-md hover:bg-indigo-700 transition-all">
                <i class="fas fa-map-marked-alt"></i> Petunjuk Google Maps
            </a>
        </div>
        @endif
    </section>
    @endif

    {{-- Gift / Angpao --}}
    @if(isset($gifts) && $gifts->isNotEmpty())
    <section class="py-16 px-6 bg-white border-y border-slate-100">
        <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
            <h2 class="text-3xl font-extrabold font-fredoka text-indigo-900 mb-2">Kado Digital Khitanan</h2>
            <p class="text-slate-500 text-sm mb-8">Tanpa mengurangi rasa hormat, bagi Anda yang ingin memberi kado untuk Ananda:</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($gifts as $gift)
                <div class="bg-sky-50 border border-sky-200 p-6 rounded-2xl">
                    <p class="text-xs text-sky-700 font-bold uppercase tracking-wider mb-1">{{ $gift->nama_bank }}</p>
                    <p class="text-2xl font-black text-indigo-900 tracking-wider my-2">{{ $gift->no_rekening }}</p>
                    <p class="text-sm text-slate-600">a/n {{ $gift->atas_nama }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Form Ucapan --}}
    <section class="py-16 px-6 max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold font-fredoka text-indigo-900 mb-2">Kirim Doa & Ucapan</h2>
            <p class="text-slate-500 text-sm">Berikan ucapan terbaik untuk keberkahan Ananda {{ $namaLengkap }}.</p>
        </div>

        <form action="{{ route('wish.storePublic') }}" method="POST" class="bg-white border border-slate-200 p-6 rounded-3xl shadow-xl space-y-4 mb-8">
            @csrf
            <div>
                <input type="text" name="nama" placeholder="Nama Anda" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-400 text-sm">
            </div>
            <div>
                <textarea name="ucapan" rows="3" placeholder="Tuliskan ucapan dan doa..." required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-400 text-sm"></textarea>
            </div>
            <button type="submit" class="w-full py-3.5 bg-indigo-600 text-white font-bold rounded-2xl text-sm hover:bg-indigo-700 transition-colors shadow-md">
                <i class="fas fa-paper-plane mr-1"></i> Kirim Ucapan
            </button>
        </form>

        {{-- List Ucapan --}}
        <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
            @if(isset($wishes) && $wishes->isNotEmpty())
                @foreach($wishes as $wish)
                <div class="bg-white border border-slate-100 p-4 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between mb-1">
                        <p class="font-bold text-indigo-900 text-sm">{{ $wish->nama }}</p>
                        <span class="text-[10px] text-slate-400">{{ $wish->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-slate-600 text-xs leading-relaxed">{{ $wish->ucapan }}</p>
                </div>
                @endforeach
            @else
                <p class="text-center text-slate-400 text-xs py-4">Belum ada ucapan. Tuliskan pesan pertama Anda!</p>
            @endif
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-8 text-center bg-indigo-950 text-sky-200 text-xs">
        <p>Tasyakuran Khitan {{ $namaLengkap }}</p>
        <p class="mt-1 text-slate-400">Powered by <strong>{{ $store_name }}</strong></p>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 800, once: true });</script>
</body>

</html>
