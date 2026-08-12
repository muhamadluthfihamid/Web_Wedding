<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Web Undangan Pernikahan – {{ $store_name}}</title>
    <meta name="description" content="Sewa website undangan pernikahan digital elegan dan interaktif. Tersedia paket Basic dan Premium dengan harga terjangkau.">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Sacramento&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        script: ['Sacramento', 'cursive']
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-hero {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4c1d95 100%);
        }

        .card-glow:hover {
            box-shadow: 0 0 40px rgba(139, 92, 246, 0.25);
        }

        .badge-populer {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-50">
    @include('components.preloader')

    {{-- Top Navbar --}}
    <nav class="bg-indigo-950/90 backdrop-blur-md border-b border-white/10 text-white sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 h-20 flex items-center justify-between">
            <a href="{{ route('rental.index') }}" class="flex items-center gap-2 text-xl font-bold tracking-tight">
                <i class="fas fa-heart text-rose-400 text-2xl"></i>
                <span>{{ $store_name }}</span>
            </a>

            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-white/80">
                <a href="#fitur" class="hover:text-white transition-colors">Fitur</a>
                <a href="#pricing" class="hover:text-white transition-colors">Harga Paket</a>
                <a href="#cara-sewa" class="hover:text-white transition-colors">Cara Sewa</a>
                <a href="{{ route('dashboard.demo') }}" target="_blank" class="hover:text-white transition-colors">Demo Undangan</a>
            </div>

            <div class="flex items-center gap-3">
                @auth
                @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                <a href="{{ route('admin.home') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold text-sm transition-all shadow-sm">
                    <i class="fas fa-tachometer-alt mr-1"></i> Dashboard Admin
                </a>
                @else
                <a href="{{ route('rental.status') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold text-sm transition-all shadow-sm">
                    <i class="fas fa-user-check mr-1"></i> Status Sewa
                </a>
                @endif
                @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-white/90 hover:text-white hover:bg-white/10 rounded-xl transition-all">
                    <i class="fas fa-sign-in-alt mr-1"></i> Masuk
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-gradient-to-r from-violet-600 to-pink-500 hover:from-violet-500 hover:to-pink-400 text-white rounded-xl font-bold text-sm transition-all shadow-md">
                    <i class="fas fa-user-plus mr-1"></i> Daftar
                </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="gradient-hero text-white py-20 px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-64 h-64 bg-violet-400 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-80 h-80 bg-pink-400 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur rounded-full text-sm font-medium mb-6 border border-white/20">
                <i class="fas fa-heart text-rose-400"></i>
                {{ $store_name}} - Digital Inovations
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">
                Website Undangan<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-300 to-pink-300">Pernikahan Digital</span>
            </h1>
            <p class="text-lg md:text-xl text-white/80 mb-8 max-w-2xl mx-auto">
                Bagikan momen istimewa Anda dengan undangan digital elegan yang bisa dikirim ke semua tamu cukup dengan satu link.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#pricing" class="px-8 py-3.5 bg-white text-indigo-900 rounded-xl font-bold hover:bg-violet-50 transition-all shadow-lg">
                    Lihat Paket <i class="fas fa-arrow-down ml-1"></i>
                </a>
                <a href="{{ route('dashboard.demo') }}" target="_blank" class="px-8 py-3.5 bg-white/10 border border-white/30 text-white rounded-xl font-semibold hover:bg-white/20 transition-all backdrop-blur">
                    <i class="fas fa-eye mr-1"></i> Lihat Contoh Demo
                </a>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section id="fitur" class="py-16 px-4 bg-white">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-slate-900 mb-12">Kenapa Pilih Kami?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                ['fas fa-mobile-alt', 'violet', 'Tampilan Elegan', 'Desain modern responsif yang indah di semua perangkat.'],
                ['fas fa-link', 'rose', 'Link Unik', 'Setiap pasangan mendapat link undangan sendiri yang bisa langsung dibagikan.'],
                ['fas fa-clock', 'amber', 'Countdown Timer', 'Hitung mundur otomatis menuju hari bahagia Anda.'],
                ['fas fa-images', 'emerald', 'Galeri Foto', 'Tampilkan momen berharga Anda dalam galeri foto yang cantik.'],
                ['fas fa-check-circle', 'blue', 'RSVP Online', 'Konfirmasi kehadiran tamu secara digital tanpa repot.'],
                ['fas fa-headset', 'indigo', 'Support Admin', 'Tim kami siap membantu selama masa sewa aktif.'],
                ] as [$icon, $color, $title, $desc])
                <div class="flex gap-4 p-5 rounded-2xl bg-{{ $color }}-50 border border-{{ $color }}-100">
                    <div class="flex-shrink-0 w-10 h-10 bg-{{ $color }}-100 rounded-xl flex items-center justify-center">
                        <i class="{{ $icon }} text-{{ $color }}-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900 mb-1">{{ $title }}</h3>
                        <p class="text-sm text-slate-600">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Katalog Tema --}}
    <section id="tema" class="py-16 px-4 bg-slate-100/70 border-y border-slate-200/60">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-xs font-extrabold text-indigo-600 uppercase tracking-widest bg-indigo-50 px-3 py-1 rounded-full border border-indigo-200">Katalog Desain</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-3">Pilihan Tema Pernikahan & Khitanan</h2>
                <p class="text-slate-600 text-sm mt-2 max-w-xl mx-auto">Tersedia berbagai pilihan tema cantik untuk Undangan Pernikahan maupun Undangan Khitanan anak Anda.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($themes as $th)
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden hover:shadow-md transition-all group">
                    <div class="h-44 bg-slate-900 relative overflow-hidden flex items-center justify-center">
                        @if($th->thumbnail_url)
                            <img src="{{ $th->thumbnail_url }}" alt="{{ $th->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br {{ $th->category == 'wedding' ? 'from-pink-500 to-rose-600' : 'from-emerald-500 to-teal-700' }} flex items-center justify-center">
                                <i class="fas {{ $th->category == 'wedding' ? 'fa-rings-wedding' : 'fa-child' }} text-white/30 text-6xl group-hover:scale-110 transition-transform"></i>
                            </div>
                        @endif
                        <span class="absolute top-3 left-3 px-2.5 py-1 text-[11px] font-extrabold uppercase rounded-full text-white bg-black/40 backdrop-blur-sm shadow-sm">
                            {{ $th->category == 'wedding' ? '💍 Pernikahan' : '👦 Khitanan' }}
                        </span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-slate-900 text-base mb-1">{{ $th->name }}</h3>
                        <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">{{ $th->description }}</p>
                        <a href="{{ route('dashboard.demo', ['theme' => $th->slug, 'event_type' => $th->category]) }}" target="_blank" class="block text-center py-2 bg-slate-100 hover:bg-indigo-50 text-indigo-600 rounded-xl text-xs font-bold transition-colors">
                            <i class="fas fa-eye mr-1"></i> Lihat Preview Demo
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Pricing Section --}}
    <section id="pricing" class="py-20 px-4 bg-slate-50">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-14">
                <span class="text-sm font-semibold text-indigo-600 uppercase tracking-widest">Pilih Paket</span>
                <h2 class="text-4xl font-extrabold text-slate-900 mt-2">Harga Terjangkau, Kualitas Premium</h2>
                <p class="text-slate-500 mt-3 max-w-xl mx-auto">Pilih paket yang sesuai kebutuhan Anda. Semua paket sudah termasuk link undangan unik.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-{{ $packages->count() }} gap-8 items-start">
                @foreach ($packages as $pkg)
                <div class="relative bg-white rounded-3xl border-2 {{ $pkg->is_populer ? 'border-violet-500 shadow-2xl shadow-violet-100' : 'border-slate-100 shadow-md' }} p-8 card-glow transition-all duration-300">

                    @if ($pkg->is_populer)
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-gradient-to-r from-violet-600 to-pink-500 text-white text-xs font-bold rounded-full shadow-lg badge-populer">
                            <i class="fas fa-star text-yellow-300"></i> Terpopuler
                        </span>
                    </div>
                    @endif

                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-14 h-14 bg-{{ $pkg->warna_badge }}-100 rounded-2xl mb-4">
                            <i class="fas fa-{{ $pkg->is_populer ? 'crown' : 'gift' }} text-{{ $pkg->warna_badge }}-600 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-extrabold text-slate-900">{{ $pkg->nama }}</h3>
                        <p class="text-slate-500 text-sm mt-1">{{ $pkg->deskripsi }}</p>
                        <div class="mt-6">
                            <span class="text-5xl font-black text-slate-900">{{ $pkg->harga_format }}</span>
                            <span class="text-slate-400 text-sm"> / {{ $pkg->durasi_teks }}</span>
                        </div>
                    </div>

                    <ul class="space-y-3 mb-8">
                        @foreach ($pkg->fitur ?? [] as $fitur)
                        <li class="flex items-start gap-3 text-sm text-slate-700">
                            <i class="fas fa-check-circle text-{{ $pkg->warna_badge }}-500 mt-0.5 flex-shrink-0"></i>
                            {{ $fitur }}
                        </li>
                        @endforeach
                    </ul>

                    @auth
                    @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                    <a href="{{ route('admin.home') }}" class="block w-full text-center py-3.5 rounded-xl font-bold bg-slate-100 text-slate-700 border border-slate-200 hover:bg-slate-200 transition-all">
                        <i class="fas fa-user-shield mr-1"></i> Mode Admin (Dashboard)
                    </a>
                    @elseif (auth()->user()->hasActiveRental())
                    <a href="{{ route('rental.status') }}" class="block w-full text-center py-3.5 rounded-xl font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 transition-all">
                        <i class="fas fa-check mr-1"></i> Sewa Aktif
                    </a>
                    @else
                    <a href="{{ route('rental.orderForm', $pkg) }}" class="block w-full text-center py-3.5 rounded-xl font-bold {{ $pkg->is_populer ? 'bg-gradient-to-r from-violet-600 to-pink-500 text-white shadow-lg shadow-violet-200 hover:shadow-xl hover:shadow-violet-300' : 'bg-indigo-600 text-white hover:bg-indigo-700' }} transition-all">
                        Pilih Paket {{ $pkg->nama }} →
                    </a>
                    @endif
                    @else
                    <a href="{{ route('register') }}" class="block w-full text-center py-3.5 rounded-xl font-bold {{ $pkg->is_populer ? 'bg-gradient-to-r from-violet-600 to-pink-500 text-white shadow-lg' : 'bg-indigo-600 text-white hover:bg-indigo-700' }} transition-all">
                        Daftar & Pilih Paket →
                    </a>
                    @endauth
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Steps --}}
    <section id="cara-sewa" class="py-16 px-4 bg-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-slate-900 mb-12">Cara Sewa (3 Langkah Mudah)</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                ['1', 'fas fa-user-plus', 'Daftar Akun', 'Buat akun gratis dengan email dan nama Anda.'],
                ['2', 'fas fa-credit-card', 'Pilih Paket & Transfer', 'Pilih paket yang sesuai lalu upload bukti transfer.'],
                ['3', 'fas fa-rocket', 'Akses & Kelola', 'Admin verifikasi dalam 1x24 jam, lalu website Anda siap!'],
                ] as [$step, $icon, $title, $desc])
                <div class="relative">
                    @if ($step != '3')
                    <div class="hidden md:block absolute top-8 left-3/4 w-1/2 h-0.5 bg-indigo-100"></div>
                    @endif
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 text-white rounded-2xl text-xl font-black mb-4 shadow-lg shadow-indigo-200">
                        {{ $step }}
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2">{{ $title }}</h3>
                    <p class="text-sm text-slate-500">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer CTA --}}
    <section class="gradient-hero py-16 px-4 text-white text-center">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold mb-4">Siap Membuat Undangan Impian?</h2>
            <p class="text-white/70 mb-8">Daftarkan diri Anda sekarang dan wujudkan undangan pernikahan digital yang memukau.</p>
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-10 py-4 bg-white text-indigo-900 rounded-xl font-bold hover:bg-violet-50 transition-all shadow-xl text-lg">
                <i class="fas fa-heart text-rose-500"></i> Mulai Sekarang
            </a>
        </div>
    </section>

    <footer class="bg-slate-900 text-slate-400 py-6 text-center text-sm">
        © {{ date('Y') }} {{ $store_name }}. All rights reserved.
    </footer>
</body>

</html>