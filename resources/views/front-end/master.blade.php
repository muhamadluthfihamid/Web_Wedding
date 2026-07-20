<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Undangan Pernikahan | Lu'iz-Wedding</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- simplyCountdown -->
    <link rel="stylesheet" href="{{ asset('assets/css/simplyCountdown.theme.default.css') }}" />
    <script src="{{ asset('assets/js/simplyCountdown.min.js') }}"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- SweetAlert2 for Toast Notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Main Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <!-- Floating Leaf Particles for natural, non-empty background decoration -->
    <div class="leaf-decorations">
        <svg class="leaf-particle" style="top: 12%; left: 6%; width: 25px; height: 25px; animation-delay: 0s; animation-duration: 14s;" viewBox="0 0 24 24"><path fill="#586b8c" d="M17,8C8,10 5.9,16.17 3.82,21.34L2.18,20.66C4.26,15.49 6.36,9.33 15.36,7.33L12,4H18V10L17,8Z" /></svg>
        <svg class="leaf-particle" style="top: 28%; right: 8%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 18s;" viewBox="0 0 24 24"><path fill="#8ca4d0" d="M17,8C8,10 5.9,16.17 3.82,21.34L2.18,20.66C4.26,15.49 6.36,9.33 15.36,7.33L12,4H18V10L17,8Z" /></svg>
        <svg class="leaf-particle" style="top: 42%; left: 9%; width: 28px; height: 28px; animation-delay: 4s; animation-duration: 16s;" viewBox="0 0 24 24"><path fill="#586b8c" d="M17,8C8,10 5.9,16.17 3.82,21.34L2.18,20.66C4.26,15.49 6.36,9.33 15.36,7.33L12,4H18V10L17,8Z" /></svg>
        <svg class="leaf-particle" style="top: 58%; right: 12%; width: 22px; height: 22px; animation-delay: 1s; animation-duration: 15s;" viewBox="0 0 24 24"><path fill="#8ca4d0" d="M17,8C8,10 5.9,16.17 3.82,21.34L2.18,20.66C4.26,15.49 6.36,9.33 15.36,7.33L12,4H18V10L17,8Z" /></svg>
        <svg class="leaf-particle" style="top: 72%; left: 5%; width: 24px; height: 24px; animation-delay: 5s; animation-duration: 20s;" viewBox="0 0 24 24"><path fill="#586b8c" d="M17,8C8,10 5.9,16.17 3.82,21.34L2.18,20.66C4.26,15.49 6.36,9.33 15.36,7.33L12,4H18V10L17,8Z" /></svg>
        <svg class="leaf-particle" style="top: 88%; right: 6%; width: 26px; height: 26px; animation-delay: 3s; animation-duration: 17s;" viewBox="0 0 24 24"><path fill="#8ca4d0" d="M17,8C8,10 5.9,16.17 3.82,21.34L2.18,20.66C4.26,15.49 6.36,9.33 15.36,7.33L12,4H18V10L17,8Z" /></svg>
    </div>

    <!-- ==========================================================================
       HERO COVER SECTION
       ========================================================================== -->
    <section id="hero" class="hero w-100 min-vh-100 p-3 mx-auto text-center d-flex justify-content-center align-items-center text-white">
        <div class="bg-decor-left"></div>
        <div class="bg-decor-right"></div>
        <main class="hero-card" data-aos="zoom-in" data-aos-duration="1500" style="max-width: 480px;">
            <h3 style="font-family: 'Sacramento', cursive; font-size: 2.2rem; color: var(--gold-light); font-weight: normal; margin-bottom: 0.25rem;">Undangan</h3>
            @foreach ($infos as $info)
                <h1 class="my-2" style="font-family: 'Sacramento', cursive; font-size: 3.2rem; color: #ffffff; text-shadow: 2px 4px 10px rgba(0,0,0,0.4); margin-bottom: 1.5rem; line-height: 1.2;">
                    {{ $info->nama_pengantin_pria }} <br> & <br> {{ $info->nama_pengantin_istri }}
                </h1>
            @endforeach
            
            <a href="#home" class="btn btn-lg mt-1 mb-4" onClick="enableScroll()" style="text-transform: none !important; padding: 0.75rem 2.2rem; border-radius: 50px; font-weight: 500; font-size: 1rem; box-shadow: 0 8px 25px rgba(62, 75, 109, 0.25);">
                <i class="bi bi-envelope-open-fill me-2"></i> Buka Undangan
            </a>

            <div class="recipient-box mt-2">
                <p class="mb-1 text-white-50" style="font-size: 0.85rem; letter-spacing: 2px; text-transform: uppercase;">Kepada</p>
                <p class="mb-1 text-white-50" id="pronoun-container" style="font-size: 0.95rem; font-weight: 500; letter-spacing: 0.5px;">Yth. Bapak/Ibu/Saudara/i</p>
                <h2 class="my-2 text-white" id="guest-name-container" style="font-size: 1.85rem; font-family: 'Playfair Display', serif; font-weight: 700; text-shadow: 1px 2px 5px rgba(0,0,0,0.2);">
                    <span></span> <span class="heart-emoji" style="display: none;">🤍</span>
                </h2>
                <p class="mt-3 text-white-50" style="font-size: 0.85rem; line-height: 1.6; max-width: 320px; margin: 0 auto; letter-spacing: 0.2px;">
                    Tanpa mengurangi rasa hormat, kami mengundang Anda untuk hadir di acara pernikahan kami
                </p>
            </div>
        </main>
    </section>

    <!-- Navigation Bar -->
    @include('front-end.navbar')

    <!-- ==========================================================================
       HOME SECTION (THE COUPLE)
       ========================================================================== -->
    <section id="home" class="home" style="padding: 6rem 0 4rem;">
        <div class="bg-decor-left"></div>
        <div class="bg-decor-right"></div>
        <div class="container">
            <!-- Title "The Wedding" -->
            <div class="row justify-content-center" data-aos="fade-up">
                <div class="col-md-10 text-center">
                    <h2 class="mb-4" style="font-family: 'Sacramento', cursive; font-size: 4rem; color: var(--sage-dark);">The Wedding</h2>
                </div>
            </div>

              <!-- Names, Date, Save The Date Badge, and Countdown -->
            <div class="row justify-content-center mt-5" data-aos="fade-up">
                <div class="col-md-10 text-center">
                    <div style="margin-bottom: 1.5rem; text-align: center;">
                        <img src="{{ asset('assets/img/thewedding.webp') }}" alt="The Wedding Wreath" style="max-width: 180px; height: auto; display: inline-block;">
                    </div>
                    @foreach ($infos as $info)
                        <h2 class="mb-1" style="font-family: 'Sacramento', cursive; font-size: 3.2rem; color: var(--sage-dark);">
                            {{ $info->nama_pengantin_pria }} & {{ $info->nama_pengantin_istri }}
                        </h2>
                        <h3 class="mb-3" style="font-family: 'Playfair Display', serif; font-size: 1.35rem; color: var(--sage-medium); font-weight: 600;">
                            {{ \Carbon\Carbon::parse($info->tanggal_pernikahan)->translatedFormat('d F Y') }}
                        </h3>
                        
                        <div class="mb-4 mt-2">
                            <span class="badge px-4 py-2.5 text-white" style="background-color: var(--sage-dark); font-size: 0.95rem; font-weight: 500; border-radius: 20px; letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(62,75,109,0.15); display: inline-block;">Save The Date</span>
                        </div>

                        <!-- Circular Hitung Mundur Acara -->
                        <div class="mt-4 mb-3 d-flex justify-content-center">
                            <div class="simply-countdown"></div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Couple Profiles -->
            <div class="row justify-content-center align-items-center mt-3 g-4">

                <!-- GROOM (PRIA) -->
                <div class="col-12 col-lg-5 order-1 mb-4 mb-lg-0" data-aos="fade-right">
                    <div class="couple-card text-center">
                        <div class="photo-container">
                            @foreach ($biodataPria as $pria)
                                <img src="{{ $pria->foto ? asset('storage/' . $pria->foto) : asset('assets/img/me.png') }}"
                                    class="wedding-img-circle" loading="lazy" width="220" height="310" alt="Foto Pengantin Pria">
                            @endforeach
                        </div>
                        @foreach ($biodataPria as $pria)
                            <h3 class="mt-3">{{ $pria->nama }}</h3>
                            <p class="text-muted small px-3">{{ $pria->deskripsi }}</p>
                            <div class="parents-info mt-3 pt-3 border-top border-light">
                                <p class="small text-muted mb-1">Putra dari Pasangan</p>
                                <p class="fw-bold mb-0 text-dark">{{ $pria->bapak }}</p>
                                <p class="small text-muted my-1">&</p>
                                <p class="fw-bold text-dark mb-0">{{ $pria->ibu }}</p>
                                @if(!empty($pria->asal))
                                    <p class="small mt-2 mb-0" style="color: var(--gold); font-weight: 500;">
                                        <i class="bi bi-geo-alt-fill me-1"></i>{{ $pria->asal }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- HEART / WEDDING RINGS SPLITTER -->
                <div class="col-12 col-lg-2 order-2 my-4 my-lg-0" data-aos="zoom-in">
                    <div class="rings-divider">
                        <div class="heart-icon">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                    </div>
                </div>

                <!-- BRIDE (WANITA) -->
                <div class="col-12 col-lg-5 order-3" data-aos="fade-left">
                    <div class="couple-card text-center">
                        <div class="photo-container">
                            @foreach ($biodataWanita as $wanita)
                                <img src="{{ $wanita->foto ? asset('storage/' . $wanita->foto) : asset('assets/img/ukhti.png') }}"
                                    class="wedding-img-circle" loading="lazy" width="220" height="310" alt="Foto Pengantin Wanita">
                            @endforeach
                        </div>
                        @foreach ($biodataWanita as $wanita)
                            <h3 class="mt-3">{{ $wanita->nama }}</h3>
                            <p class="text-muted small px-3">{{ $wanita->deskripsi }}</p>
                            <div class="parents-info mt-3 pt-3 border-top border-light">
                                <p class="small text-muted mb-1">Putri dari Pasangan</p>
                                <p class="fw-bold mb-0 text-dark">{{ $wanita->bapak }}</p>
                                <p class="small text-muted my-1">&</p>
                                <p class="fw-bold text-dark mb-0">{{ $wanita->ibu }}</p>
                                @if(!empty($wanita->asal))
                                    <p class="small mt-2 mb-0" style="color: var(--gold); font-weight: 500;">
                                        <i class="bi bi-geo-alt-fill me-1"></i>{{ $wanita->asal }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

          
        </div>
    </section>

    <!-- ==========================================================================
       DOA / DALIL SECTION
       ========================================================================== -->
    <section id="doa" class="doa py-5" style="background-color: transparent;">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up">
                <div class="col-12 col-md-10 col-lg-8 text-center">
                    <div class="couple-card p-5 shadow-sm" style="background: var(--cream-accent); border: 1px solid rgba(124, 142, 122, 0.15); border-radius: 30px;">
                        
                        <!-- Calligraphy Bismillah -->
                        <p class="mb-4 text-center" style="font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: bold; color: var(--sage-dark); letter-spacing: 1px;">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                        
                        <p class="fw-bold mb-4" style="font-size: 1.05rem; color: var(--sage-dark); letter-spacing: 0.5px;">
                            Assalamu'alaikum Warahmatullahi Wabarakatuh
                        </p>
                        
                        <p class="mb-4 text-muted" style="font-size: 1rem; line-height: 1.8; letter-spacing: 0.2px;">
                            Dengan memohon rahmat dan ridho Allah SWT yang telah menciptakan Makhluk-Nya secara berpasang-pasangan, kami bermaksud menyelenggarakan acara Walimatul Ursy.
                        </p>
                        
                        <p class="mb-4 text-muted" style="font-size: 1rem; line-height: 1.8; letter-spacing: 0.2px;">
                            Kami memohon do'a restu agar menjadi keluarga yang Sakinah Mawaddah Warahmah. Atas perhatiannya, kami ucapkan terimakasih.
                        </p>
                        
                        <p class="fw-bold mt-4 mb-0" style="font-size: 1.05rem; color: var(--sage-dark); letter-spacing: 0.5px;">
                            Wassalamu'alaikum Warahmatullahi Wabarakatuh
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
       INFO SECTION (EVENTS & MAPS)
       ========================================================================== -->
    <section id="info" class="info py-5">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up">
                <div class="col-12 col-md-10 col-lg-8 text-center">
                    @foreach ($infos as $info)
                        <h2 class="fw-bold mb-3">Informasi Acara</h2>
                        <p class="alamat mb-4">
                            <i class="bi bi-geo-alt-fill me-2 text-warning"></i>
                            {{ $info->alamat }}
                        </p>

                        {{-- Google Maps Embed - Dinamis dari Koordinat Database --}}
                        <div class="info-map-container mb-4">
                            <div class="ratio ratio-21x9">
                                @if($info->latitude && $info->longitude)
                                    {{-- Embed berdasarkan koordinat yang sudah tersimpan --}}
                                    <iframe
                                        src="https://maps.google.com/maps?q={{ $info->latitude }},{{ $info->longitude }}&z=16&output=embed"
                                        style="border:0;" allowfullscreen loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                @else
                                    {{-- Fallback: embed berdasarkan teks alamat --}}
                                    <iframe
                                        src="https://maps.google.com/maps?q={{ urlencode($info->alamat) }}&output=embed"
                                        style="border:0;" allowfullscreen loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                @endif
                            </div>
                        </div>

                        {{-- Tombol Petunjuk Arah - Dinamis --}}
                        @if($info->latitude && $info->longitude)
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $info->latitude }},{{ $info->longitude }}"
                                target="_blank" class="btn btn-outline-info mb-4">
                                <i class="bi bi-map-fill me-2"></i> Petunjuk Arah Google Maps
                            </a>
                        @else
                            <a href="https://www.google.com/maps/search/{{ urlencode($info->alamat) }}"
                                target="_blank" class="btn btn-outline-info mb-4">
                                <i class="bi bi-map-fill me-2"></i> Cari Lokasi di Google Maps
                            </a>
                        @endif

                        <p class="description small text-white-50 px-lg-5">
                            Diharapkan untuk memperhatikan alamat dan tanggal pelaksanaan. Apabila ada perubahan lokasi,
                            akan kami informasikan kembali secara berkala.
                        </p>
                    @endforeach
                </div>
            </div>

            <!-- Event Cards for Akad & Resepsi -->
            <div class="row justify-content-center mt-5 g-4">
                @foreach ($infos as $info)
                    @php
                        // Calendar link generator parameters
                        $eventTitle = 'Pernikahan ' . $info->nama_pengantin_pria . ' & ' . $info->nama_pengantin_istri;
                        $dateStr = \Carbon\Carbon::parse($info->tanggal_pernikahan)->format('Ymd');
                        
                        $startAkad = \Carbon\Carbon::parse($info->mulai_akad)->format('Hi') . '00';
                        $endAkad = \Carbon\Carbon::parse($info->selesai_akad)->format('Hi') . '00';
                        $gCalUrlAkad = "https://calendar.google.com/calendar/render?action=TEMPLATE&text=" . urlencode($eventTitle . ' - Akad Nikah') . "&dates=" . $dateStr . "T" . $startAkad . "/" . $dateStr . "T" . $endAkad . "&details=Mohon+doa+dan+restu&location=" . urlencode($info->alamat);
                        
                        $startResepsi = \Carbon\Carbon::parse($info->mulai_resepsi)->format('Hi') . '00';
                        $gCalUrlResepsi = "https://calendar.google.com/calendar/render?action=TEMPLATE&text=" . urlencode($eventTitle . ' - Resepsi Pernikahan') . "&dates=" . $dateStr . "T" . $startResepsi . "/" . $dateStr . "T220000&details=Mohon+doa+dan+restu&location=" . urlencode($info->alamat);
                    @endphp

                    <!-- AKAD CARD -->
                    <div class="col-12 col-md-6 col-lg-5" data-aos="flip-left">
                        <div class="card event-card text-center h-100">
                            <div class="card-header">
                                Akad Nikah
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="row g-2 align-items-center justify-content-center">
                                    <div class="col-6 border-end border-light-subtle">
                                        <i class="bi bi-clock d-block mb-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($info->mulai_akad)->format('H.i') }} -
                                            {{ \Carbon\Carbon::parse($info->selesai_akad)->format('H.i') }}</span>
                                    </div>
                                    <div class="col-6">
                                        <i class="bi bi-calendar3 d-block mb-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($info->tanggal_pernikahan)->translatedFormat('l') }}<br>
                                            <strong>{{ \Carbon\Carbon::parse($info->tanggal_pernikahan)->translatedFormat('d F Y') }}</strong></span>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ $gCalUrlAkad }}" target="_blank" class="btn btn-outline-info btn-sm">
                                        <i class="bi bi-calendar-check-fill me-1"></i> Simpan ke Kalender
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer">
                                Diharapkan menjaga kekhidmatan selama prosesi Akad.
                            </div>
                        </div>
                    </div>

                    <!-- RESEPSI CARD -->
                    <div class="col-12 col-md-6 col-lg-5" data-aos="flip-right">
                        <div class="card event-card text-center h-100">
                            <div class="card-header">
                                Resepsi Pernikahan
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="row g-2 align-items-center justify-content-center">
                                    <div class="col-6 border-end border-light-subtle">
                                        <i class="bi bi-clock d-block mb-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($info->mulai_resepsi)->format('H.i') }} - Selesai</span>
                                    </div>
                                    <div class="col-6">
                                        <i class="bi bi-calendar3 d-block mb-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($info->tanggal_pernikahan)->translatedFormat('l') }}<br>
                                            <strong>{{ \Carbon\Carbon::parse($info->tanggal_pernikahan)->translatedFormat('d F Y') }}</strong></span>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ $gCalUrlResepsi }}" target="_blank" class="btn btn-outline-info btn-sm">
                                        <i class="bi bi-calendar-check-fill me-1"></i> Simpan ke Kalender
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer">
                                Kehadiran Anda merupakan kehormatan terbesar bagi kami.
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ==========================================================================
       STORY SECTION (LOVE JOURNEY)
       ========================================================================== -->
    <section id="story" class="story">
        <div class="bg-decor-left"></div>
        <div class="bg-decor-right"></div>
        <div class="container">
            @if($story)
                <div class="row justify-content-center mb-5" data-aos="fade-up">
                    <div class="col-md-8 col-10 text-center">
                        <span class="subtitle">Bagaimana Cinta Kami Bersemi</span>
                        <h2>Cerita Kami</h2>
                        <p class="text-muted mt-3">{{ $story->deskripsi }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <ul class="timeline">
                            
                            <!-- BERTEMU -->
                            <li data-aos="fade-up">
                                <div class="timeline-badge">
                                    <i class="bi bi-heart-fill"></i>
                                </div>
                                <div class="timeline-panel">
                                    @if($story->foto_bertemu)
                                        <div class="timeline-img-wrapper mb-3 text-center">
                                            <img src="{{ asset('storage/' . $story->foto_bertemu) }}" class="img-fluid rounded" alt="Foto Bertemu" style="max-height: 200px; object-fit: cover; border-radius: 12px; width: 100%;">
                                        </div>
                                    @endif
                                    <div class="timeline-heading">
                                        <h3>{{ $story->judul_bertemu }}</h3>
                                        <span>{{ \Carbon\Carbon::parse($story->tgl_bertemu)->translatedFormat('d F Y') }}</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>{{ $story->note_bertemu }}</p>
                                    </div>
                                </div>
                            </li>
                            
                            <!-- SERIUS -->
                            <li class="timeline-inverted" data-aos="fade-up">
                                <div class="timeline-badge">
                                    <i class="bi bi-heart-fill"></i>
                                </div>
                                <div class="timeline-panel">
                                    @if($story->foto_serius)
                                        <div class="timeline-img-wrapper mb-3 text-center">
                                            <img src="{{ asset('storage/' . $story->foto_serius) }}" class="img-fluid rounded" alt="Foto Serius" style="max-height: 200px; object-fit: cover; border-radius: 12px; width: 100%;">
                                        </div>
                                    @endif
                                    <div class="timeline-heading">
                                        <h3>{{ $story->judul_serius }}</h3>
                                        <span>{{ \Carbon\Carbon::parse($story->tgl_serius)->translatedFormat('d F Y') }}</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>{{ $story->note_serius }}</p>
                                    </div>
                                </div>
                            </li>
                            
                            <!-- TUNANGAN -->
                            <li data-aos="fade-up">
                                <div class="timeline-badge">
                                    <i class="bi bi-heart-fill"></i>
                                </div>
                                <div class="timeline-panel">
                                    @if($story->foto_tunangan)
                                        <div class="timeline-img-wrapper mb-3 text-center">
                                            <img src="{{ asset('storage/' . $story->foto_tunangan) }}" class="img-fluid rounded" alt="Foto Tunangan" style="max-height: 200px; object-fit: cover; border-radius: 12px; width: 100%;">
                                        </div>
                                    @endif
                                    <div class="timeline-heading">
                                        <h3>{{ $story->judul_tunangan }}</h3>
                                        <span>{{ \Carbon\Carbon::parse($story->tgl_tunangan)->translatedFormat('d F Y') }}</span>
                                    </div>
                                    <div class="timeline-body">
                                        <p>{{ $story->note_tunangan }}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </section>


    <!-- ==========================================================================
       RSVP SECTION
       ========================================================================== -->
    <section id="rsvp" class="rsvp">
        <div class="bg-decor-left"></div>
        <div class="bg-decor-right"></div>
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-up">
                <div class="col-md-8 col-10 text-center">
                    <h2>Konfirmasi Kehadiran</h2>
                    <p class="lead">Isi formulir di bawah ini untuk melakukan konfirmasi kehadiran Anda.</p>
                </div>
            </div>

            <!-- Sleek RSVP Form Container -->
            <div class="rsvp-form-container mt-4">
                <form class="row g-3 justify-content-center" data-aos="fade-up"
                    action="{{ route('rsvp.store') }}" id="my-form">
                    @csrf
                    <div class="col-md-6 text-start">
                        <label for="nama" class="form-label">Nama Anda</label>
                        <input type="text" class="form-control" id="nama" name="nama_tamu" required placeholder="Nama Lengkap">
                    </div>
                    <div class="col-md-3 text-start">
                        <label for="jumlah" class="form-label">Jumlah Tamu</label>
                        <select class="form-select" id="jumlah" name="jumlah">
                            <option value="1" selected>1 Orang</option>
                            <option value="2">2 Orang</option>
                            <option value="3">3 Orang</option>
                            <option value="4">4 Orang</option>
                            <option value="5">5 Orang</option>
                        </select>
                    </div>
                    <div class="col-md-3 text-start">
                        <label for="status" class="form-label">Konfirmasi</label>
                        <select name="kehadiran" id="status" class="form-select" required>
                            <option value="" disabled selected>Pilih salah satu</option>
                            <option value="1">Hadir</option>
                            <option value="0">Tidak Hadir</option>
                        </select>
                    </div>
                    <div class="col-12 mt-4 text-center">
                        <button type="submit" class="btn btn-lg px-5">
                            <i class="bi bi-send-fill me-2"></i> Kirim Konfirmasi
                        </button>
                    </div>
                </form>
            </div>

            <!-- Wishes (Guestbook) Section -->
            <div class="row justify-content-center mt-5">
                <div class="col-md-8 text-center" data-aos="fade-up">
                    <h3 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: var(--gold-light);">Ucapan & Doa Restu</h3>
                    <p class="text-white-50 mb-4">Berikan ucapan selamat, harapan, dan doa restu Anda untuk kedua mempelai.</p>
                    
                    <!-- Wishes Form -->
                    <div class="rsvp-form-container text-start mb-5" style="background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.1);">
                        <form id="wish-form" action="{{ route('wish.storePublic') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-7">
                                    <label for="wish_nama" class="form-label">Nama Anda</label>
                                    <input type="text" class="form-control" id="wish_nama" name="nama" required placeholder="Nama Lengkap">
                                </div>
                                <div class="col-md-5">
                                    <label for="wish_kehadiran" class="form-label">Kehadiran</label>
                                    <select name="kehadiran" id="wish_kehadiran" class="form-select" required>
                                        <option value="" disabled selected>Pilih salah satu</option>
                                        <option value="1">Hadir</option>
                                        <option value="0">Tidak Hadir</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="wish_ucapan" class="form-label">Ucapan & Doa</label>
                                    <textarea class="form-control" id="wish_ucapan" name="ucapan" rows="3" required placeholder="Tulis ucapan & doa restu Anda..."></textarea>
                                </div>
                                <div class="col-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-chat-heart-fill me-2"></i> Kirim Ucapan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Wishes Feed -->
                    <div class="wishes-container text-start" id="wishes-feed">
                        @if($wishes->isEmpty())
                            <div class="text-center text-white-50 py-4" id="empty-wishes-alert">
                                <i class="bi bi-chat-quote fs-1 d-block mb-2"></i>
                                <span>Belum ada ucapan. Jadilah yang pertama memberikan doa restu!</span>
                            </div>
                        @else
                            @foreach($wishes as $wish)
                                <div class="wish-card">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="fw-bold mb-0 text-dark" style="font-size: 1.05rem;">{{ $wish->nama }}</h5>
                                        <span class="badge {{ $wish->kehadiran ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-secondary-subtle text-secondary border border-secondary-subtle' }}" style="font-size: 0.75rem; padding: 0.25em 0.6em;">
                                            {{ $wish->kehadiran ? 'Hadir' : 'Tidak Hadir' }}
                                        </span>
                                    </div>
                                    <p class="mb-1" style="font-size: 0.95rem; line-height: 1.5; color: #444;">{{ $wish->ucapan }}</p>
                                    <div class="text-end">
                                        <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-clock me-1"></i>{{ $wish->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ==========================================================================
       GIFTS SECTION (DIGITAL WALLET CARDS)
       ========================================================================== -->
    <section id="gifts" class="gifts">
        <div class="container">
            @isset($gifts)
                @foreach ($gifts as $gift)
                    <div class="row justify-content-center" data-aos="fade-up">
                        <div class="col-md-8 col-10 text-center">
                            <span class="subtitle">Ungkapan Tanda Kasih</span>
                            <h2>Kirim Hadiah</h2>
                            <p class="text-muted mt-3 mb-4">{{ $gift->deskripsi }}</p>
                        </div>
                    </div>

                    <div class="row justify-content-center text-center g-4" data-aos="zoom-in">
                        <div class="col-md-6 col-lg-5">
                            
                            <!-- Digital Debit Card layout for premium digital experience -->
                            <div class="digital-card">
                                <div class="card-bank-name">{{ $gift->nama_bank }}</div>
                                <div class="card-chip"></div>
                                <div class="card-number-container">
                                    <span class="card-number">{{ $gift->no_rek }}</span>
                                </div>
                                <div class="card-holder">Atas Nama</div>
                                <div class="card-holder-name">{{ $gift->nama }}</div>
                                
                                <button class="btn-copy-card btn-sm" onclick="copyCardNumber('{{ $gift->no_rek }}', this)">
                                    <i class="bi bi-clipboard me-1"></i> Salin Rekening
                                </button>
                            </div>

                            @if($gift->gambar)
                                <!-- Saweria QR Code / E-Wallet Card -->
                                <div class="digital-card qr-card mt-4" style="background: linear-gradient(135deg, #3e4b6d 0%, #252e45 100%);">
                                    <div class="qr-card-title">Saweria / QR E-Wallet</div>
                                    <div class="qr-code-container">
                                        <img src="{{ asset('storage/' . $gift->gambar) }}"
                                            class="img-fluid" width="160" alt="QR Code Hadiah" style="border-radius: 8px;">
                                    </div>
                                    <div class="card-holder">Atas Nama</div>
                                    <div class="card-holder-name">{{ $gift->nama }}</div>
                                </div>
                            @endif
                            
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </section>

    <!-- Footer -->
    @include('front-end.footer')

    <!-- ==========================================================================
       FLOATING VINYL AUDIO CONTROLLER
       ========================================================================== -->
    <div id="audio-container">
        <audio id="song" autoplay loop>
            <source src="{{ asset('assets/audio/Bi Saraha.mp3') }}" type="audio/mp3">
        </audio>

        <div class="audio-icon-wrapper" style="display: none;">
            <i class="bi bi-disc"></i>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 1000
        });
    </script>

    <!-- SimplyCountdown script -->
    <script>
        @if (isset($infos[0]))
            const eventDate = new Date("{{ $infos[0]->tanggal_pernikahan }}");
            simplyCountdown('.simply-countdown', {
                year: eventDate.getFullYear(),
                month: eventDate.getMonth() + 1,
                day: eventDate.getDate(),
                hours: 0,
                words: {
                    days: { singular: 'hari', plural: 'hari' },
                    hours: { singular: 'jam', plural: 'jam' },
                    minutes: { singular: 'menit', plural: 'menit' },
                    seconds: { singular: 'detik', plural: 'detik' }
                },
            });
        @endif
    </script>

    <!-- Copy to Clipboard helper with SweetAlert integration -->
    <script>
        function copyCardNumber(cardNumber, button) {
            navigator.clipboard.writeText(cardNumber).then(function() {
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="bi bi-check-lg me-1"></i> Tersalin';
                button.classList.add('bg-success');
                button.style.borderColor = 'transparent';
                
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Nomor rekening berhasil disalin!',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
                
                setTimeout(function() {
                    button.innerHTML = originalText;
                    button.classList.remove('bg-success');
                    button.style.borderColor = '';
                }, 2000);
            }, function(err) {
                console.error('Gagal menyalin rekening: ', err);
            });
        }
    </script>

    <!-- Scrolling, Audio and offcanvas control scripts -->
    <script>
        const stickyTop = document.querySelector('.sticky-top');
        const offcanvas = document.querySelector('.offcanvas');

        if (offcanvas && stickyTop) {
            offcanvas.addEventListener('show.bs.offcanvas', function() {
                stickyTop.style.overflow = 'visible';
            });

            offcanvas.addEventListener('hidden.bs.offcanvas', function() {
                stickyTop.style.overflow = 'hidden';
            });
        }
    </script>

    <script>
        const rootElement = document.querySelector(":root");
        const audioIconWrapper = document.querySelector('.audio-icon-wrapper');
        const audioIcon = document.querySelector('.audio-icon-wrapper i');
        const song = document.querySelector('#song');
        let isPlaying = false;

        function disableScroll() {
            scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

            window.onscroll = function() {
                window.scrollTo(scrollTop, scrollLeft);
            }

            rootElement.style.scrollBehavior = 'auto';
        }

        function enableScroll() {
            window.onscroll = function() {}
            rootElement.style.scrollBehavior = 'smooth';
            playAudio();
        }

        function playAudio() {
            song.volume = 0.15;
            audioIconWrapper.style.display = 'flex';
            audioIconWrapper.classList.add('playing');
            song.play();
            isPlaying = true;
        }

        audioIconWrapper.onclick = function() {
            if (isPlaying) {
                song.pause();
                audioIconWrapper.classList.remove('playing');
                audioIcon.classList.remove('bi-disc');
                audioIcon.classList.add('bi-pause-circle');
            } else {
                song.play();
                audioIconWrapper.classList.add('playing');
                audioIcon.classList.add('bi-disc');
                audioIcon.classList.remove('bi-pause-circle');
            }

            isPlaying = !isPlaying;
        }

        disableScroll();
    </script>

    <!-- Form Submit Handlers via Ajax -->
    <script>
        window.addEventListener("load", function() {
            // RSVP Form Submit Handler
            const form = document.getElementById('my-form');
            if (form) {
                form.addEventListener("submit", function(e) {
                    e.preventDefault();
                    const data = new FormData(form);
                    const action = e.target.action;

                    fetch(action, {
                            method: 'POST',
                            body: data,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terima Kasih!',
                                    text: result.message,
                                    confirmButtonColor: '#3e4b6d'
                                });
                                form.reset();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat mengirim konfirmasi kehadiran.',
                                confirmButtonColor: '#3e4b6d'
                            });
                        });
                });
            }

            // Wishes Form Submit Handler
            const wishForm = document.getElementById('wish-form');
            if (wishForm) {
                wishForm.addEventListener("submit", function(e) {
                    e.preventDefault();
                    const data = new FormData(wishForm);
                    const action = e.target.action;

                    fetch(action, {
                            method: 'POST',
                            body: data,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terkirim!',
                                    text: result.message,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true
                                });
                                wishForm.reset();

                                // Prepend new wish to the feed dynamically
                                const feed = document.getElementById('wishes-feed');
                                const emptyAlert = document.getElementById('empty-wishes-alert');
                                if (emptyAlert) {
                                    emptyAlert.remove();
                                }

                                const badgeClass = result.data.kehadiran === 'Hadir' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-secondary-subtle text-secondary border border-secondary-subtle';
                                const cardHtml = `
                                    <div class="wish-card" style="opacity: 0; transform: translateY(-10px); transition: all 0.5s ease;">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="fw-bold mb-0 text-dark" style="font-size: 1.05rem;">${result.data.nama}</h5>
                                            <span class="badge ${badgeClass}" style="font-size: 0.75rem; padding: 0.25em 0.6em;">
                                                ${result.data.kehadiran}
                                            </span>
                                        </div>
                                        <p class="mb-1" style="font-size: 0.95rem; line-height: 1.5; color: #444;">${result.data.ucapan}</p>
                                        <div class="text-end">
                                            <small class="text-muted" style="font-size: 0.75rem;"><i class="bi bi-clock me-1"></i>${result.data.created_at}</small>
                                        </div>
                                    </div>
                                `;
                                feed.insertAdjacentHTML('afterbegin', cardHtml);

                                // Trigger transition animation
                                const card = feed.firstElementChild;
                                setTimeout(() => {
                                    card.style.opacity = '1';
                                    card.style.transform = 'translateY(0)';
                                }, 50);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat mengirim ucapan.',
                                confirmButtonColor: '#3e4b6d'
                            });
                        });
                });
            }
        });
    </script>

    <!-- URL query parameters mapping to recipient info -->
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const nama = urlParams.get('to') || urlParams.get('n') || '';
        const pronoun = urlParams.get('to') ? 'Yth. Bapak/Ibu' : (urlParams.get('p') ? `Yth. ${urlParams.get('p')}` : 'Yth. Bapak/Ibu/Saudara/i');
        
        const guestNameContainer = document.querySelector('#guest-name-container span');
        const pronounContainer = document.querySelector('#pronoun-container');
        const heartEmoji = document.querySelector('.heart-emoji');

        if (nama) {
            if (guestNameContainer) guestNameContainer.innerText = nama.trim();
            if (pronounContainer) pronounContainer.innerText = pronoun.trim();
            if (heartEmoji) heartEmoji.style.display = 'inline-block';
        } else {
            if (guestNameContainer) guestNameContainer.innerText = '';
            if (pronounContainer) pronounContainer.innerText = 'Bapak/Ibu/Saudara/i';
            if (heartEmoji) heartEmoji.style.display = 'none';
        }

        const inputNama = document.querySelector('#nama');
        if (inputNama && nama) {
            inputNama.value = nama;
        }

        const inputWishNama = document.querySelector('#wish_nama');
        if (inputWishNama && nama) {
            inputWishNama.value = nama;
        }
    </script>
</body>

</html>
