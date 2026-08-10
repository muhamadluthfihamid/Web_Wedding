@extends('admin.layouts.auth')

@section('main-content')
<div class="sm:mx-auto sm:w-full sm:max-w-2xl">
    <div class="bg-white py-10 px-8 shadow-xl border border-slate-100 sm:rounded-2xl sm:px-12">

        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center p-3 bg-indigo-50 rounded-full text-indigo-600 mb-4">
                <i class="fas fa-box-open text-3xl"></i>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900">Pesan Paket: {{ $package->nama }}</h1>
            <p class="text-sm text-slate-500 mt-1">Pilih jenis acara, tema favorit Anda, dan unggah bukti transfer.</p>
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

        <form action="{{ route('rental.order') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="rental_package_id" value="{{ $package->id }}">

            {{-- 1. Pilih Jenis Acara --}}
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-2">
                    1. Pilih Jenis Acara <span class="text-rose-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-4">
                    <label id="event_opt_wedding" class="event-option cursor-pointer relative border-2 border-indigo-600 bg-indigo-50/40 ring-2 ring-indigo-500 rounded-xl p-4 flex items-center gap-3 transition-all">
                        <input type="radio" name="event_type" id="event_radio_wedding" value="wedding" class="event-radio text-indigo-600 focus:ring-indigo-500" checked onchange="onEventTypeChange('wedding')">
                        <div>
                            <p class="font-bold text-slate-900 text-sm">💍 Undangan Pernikahan</p>
                            <p class="text-xs text-slate-500">Mempelai Pria & Wanita</p>
                        </div>
                    </label>
                    <label id="event_opt_khitanan" class="event-option cursor-pointer relative border-2 border-slate-200 hover:border-indigo-500 rounded-xl p-4 flex items-center gap-3 transition-all">
                        <input type="radio" name="event_type" id="event_radio_khitanan" value="khitanan" class="event-radio text-indigo-600 focus:ring-indigo-500" onchange="onEventTypeChange('khitanan')">
                        <div>
                            <p class="font-bold text-slate-900 text-sm">👦 Undangan Khitanan</p>
                            <p class="text-xs text-slate-500">Anak & Orang Tua</p>
                        </div>
                    </label>
                </div>
            </div>

            {{-- 2. Pilih Tema Undangan --}}
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-bold text-slate-800">
                        2. Pilih Tema Desain Undangan <span class="text-rose-500">*</span>
                    </label>
                    <span class="text-xs text-indigo-600 font-semibold">
                        <i class="fas fa-mouse-pointer mr-1"></i> Klik kartu untuk memilih
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" id="theme-grid">
                    @foreach($themes as $theme)
                        <div class="theme-card relative border-2 border-slate-200 hover:border-indigo-500 rounded-xl p-4 transition-all cursor-pointer flex flex-col justify-between" 
                             data-category="{{ $theme->category }}" 
                             data-theme-id="{{ $theme->id }}"
                             data-slug="{{ $theme->slug }}"
                             data-name="{{ $theme->name }}"
                             onclick="selectTheme('{{ $theme->id }}')">
                            <input type="radio" name="theme_id" id="theme_{{ $theme->id }}" value="{{ $theme->id }}" class="hidden" {{ $loop->first ? 'checked' : '' }}>
                            
                            <div>
                                @if($theme->thumbnail_url)
                                    <div class="h-28 mb-3 rounded-lg overflow-hidden bg-slate-900 relative">
                                        <img src="{{ $theme->thumbnail_url }}" alt="{{ $theme->name }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div class="flex items-start justify-between mb-2">
                                    <div>
                                        <span class="inline-block px-2.5 py-0.5 text-[10px] font-extrabold uppercase rounded-full {{ $theme->category == 'wedding' ? 'bg-pink-100 text-pink-700' : 'bg-emerald-100 text-emerald-700' }}">
                                            {{ $theme->category == 'wedding' ? '💍 Pernikahan' : '👦 Khitanan' }}
                                        </span>
                                        <h4 class="font-bold text-slate-900 text-sm mt-1">{{ $theme->name }}</h4>
                                    </div>
                                    <div class="theme-check-icon hidden text-indigo-600">
                                        <i class="fas fa-check-circle text-xl"></i>
                                    </div>
                                </div>
                                <p class="text-xs text-slate-500 line-clamp-2 mb-3 leading-relaxed">{{ $theme->description }}</p>
                            </div>

                            <button type="button" 
                                    onclick="openThemePreviewModal(event, '{{ $theme->slug }}', '{{ $theme->name }}', '{{ $theme->id }}')" 
                                    class="w-full mt-2 py-2 px-3 bg-slate-100 hover:bg-indigo-600 hover:text-white rounded-lg text-center text-xs font-bold text-slate-700 transition-colors flex items-center justify-center gap-1.5 shadow-xs">
                                <i class="fas fa-eye text-indigo-500 hover:text-white"></i> Preview Tema Ini
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- 3. Bukti Transfer --}}
            <div>
                <label class="block text-sm font-bold text-slate-800 mb-1">
                    3. Bukti Transfer Pembayaran <span class="text-rose-500">*</span>
                </label>
                <input type="file" name="bukti_transfer" accept="image/*,.pdf" required
                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-slate-200 rounded-lg cursor-pointer">
                <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, atau PDF. Maks. 2MB.</p>
            </div>

            {{-- 4. Catatan --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Catatan (opsional)</label>
                <textarea name="catatan_user" rows="2" placeholder="Tambahkan catatan jika ada permintaan khusus..."
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

{{-- Modal Preview Tema Interactive --}}
<div id="previewModal" class="fixed inset-0 z-50 hidden bg-slate-900/80 backdrop-blur-sm flex items-center justify-center p-2 sm:p-4">
    <div class="bg-white rounded-2xl w-full max-w-5xl h-[92vh] flex flex-col shadow-2xl overflow-hidden animate-fadeIn">
        {{-- Modal Header --}}
        <div class="bg-indigo-950 text-white px-4 py-3 flex items-center justify-between border-b border-white/10">
            <div class="flex items-center gap-3">
                <span class="font-bold text-sm sm:text-base text-amber-300" id="modalThemeTitle">Preview Tema</span>
                <div class="hidden sm:flex bg-slate-800/80 p-1 rounded-lg border border-white/10 text-xs">
                    <button id="btnDeviceMobile" onclick="setDeviceView('mobile')" class="px-2.5 py-1 rounded-md text-white bg-indigo-600 font-bold transition-all">
                        <i class="fas fa-mobile-alt mr-1"></i> Mobile
                    </button>
                    <button id="btnDeviceDesktop" onclick="setDeviceView('desktop')" class="px-2.5 py-1 rounded-md text-slate-400 hover:text-white transition-all">
                        <i class="fas fa-desktop mr-1"></i> Desktop
                    </button>
                </div>
            </div>
            
            <div class="flex items-center gap-2">
                <a id="btnOpenNewTab" href="#" target="_blank" class="px-3 py-1.5 bg-white/10 hover:bg-white/20 text-white text-xs font-semibold rounded-lg transition-colors inline-flex items-center gap-1">
                    <i class="fas fa-external-link-alt text-[10px]"></i> <span class="hidden sm:inline">Buka Tab Baru</span>
                </a>
                <button type="button" onclick="selectAndCloseModal()" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-lg transition-colors inline-flex items-center gap-1">
                    <i class="fas fa-check-circle"></i> <span>Pilih Tema Ini</span>
                </button>
                <button type="button" onclick="closeThemePreviewModal()" class="w-8 h-8 flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 rounded-full transition-all">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>

        {{-- Modal Body (IFrame Wrapper) --}}
        <div class="flex-1 bg-slate-950 flex items-center justify-center relative p-2 overflow-hidden">
            <div id="iframeContainer" class="w-[390px] h-[100%] bg-white rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 relative border-4 border-slate-800">
                <iframe id="previewIframe" src="about:blank" class="w-full h-full border-0"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    let currentPreviewThemeId = null;

    function updateEventTypeUI(eventType) {
        const weddingOpt = document.getElementById('event_opt_wedding');
        const khitananOpt = document.getElementById('event_opt_khitanan');
        const weddingRadio = document.getElementById('event_radio_wedding');
        const khitananRadio = document.getElementById('event_radio_khitanan');

        if (eventType === 'khitanan') {
            if (khitananRadio) khitananRadio.checked = true;
            if (khitananOpt) {
                khitananOpt.className = "event-option cursor-pointer relative border-2 border-indigo-600 bg-indigo-50/40 ring-2 ring-indigo-500 rounded-xl p-4 flex items-center gap-3 transition-all";
            }
            if (weddingOpt) {
                weddingOpt.className = "event-option cursor-pointer relative border-2 border-slate-200 hover:border-indigo-500 rounded-xl p-4 flex items-center gap-3 transition-all";
            }
        } else {
            if (weddingRadio) weddingRadio.checked = true;
            if (weddingOpt) {
                weddingOpt.className = "event-option cursor-pointer relative border-2 border-indigo-600 bg-indigo-50/40 ring-2 ring-indigo-500 rounded-xl p-4 flex items-center gap-3 transition-all";
            }
            if (khitananOpt) {
                khitananOpt.className = "event-option cursor-pointer relative border-2 border-slate-200 hover:border-indigo-500 rounded-xl p-4 flex items-center gap-3 transition-all";
            }
        }
    }

    function onEventTypeChange(category) {
        updateEventTypeUI(category);
        filterThemes(category);
    }

    function filterThemes(category) {
        updateEventTypeUI(category);
        const cards = document.querySelectorAll('.theme-card');
        let firstVisibleSelected = false;

        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (cardCat === category || cardCat === 'all') {
                card.style.display = 'flex';
                if (!firstVisibleSelected) {
                    const themeId = card.getAttribute('data-theme-id');
                    if (themeId) {
                        selectTheme(themeId, false);
                        firstVisibleSelected = true;
                    }
                }
            } else {
                card.style.display = 'none';
            }
        });
    }

    function selectTheme(themeId, syncEventType = true) {
        currentPreviewThemeId = themeId;
        const radio = document.getElementById('theme_' + themeId);
        if (radio) {
            radio.checked = true;
        }

        const selectedCard = document.querySelector(`.theme-card[data-theme-id="${themeId}"]`);
        if (selectedCard && syncEventType) {
            const cardCategory = selectedCard.getAttribute('data-category');
            if (cardCategory && cardCategory !== 'all') {
                updateEventTypeUI(cardCategory);
            }
        }

        document.querySelectorAll('.theme-card').forEach(card => {
            const checkIcon = card.querySelector('.theme-check-icon');
            const r = card.querySelector('input[type="radio"]');
            if (r && r.checked) {
                card.classList.add('border-indigo-600', 'bg-indigo-50/40', 'ring-2', 'ring-indigo-500');
                card.classList.remove('border-slate-200');
                if (checkIcon) checkIcon.classList.remove('hidden');
            } else {
                card.classList.remove('border-indigo-600', 'bg-indigo-50/40', 'ring-2', 'ring-indigo-500');
                card.classList.add('border-slate-200');
                if (checkIcon) checkIcon.classList.add('hidden');
            }
        });
    }

    function openThemePreviewModal(event, slug, themeName, themeId) {
        if (event) event.stopPropagation(); // Mencegah pemicu ganda
        selectTheme(themeId);

        const modal = document.getElementById('previewModal');
        const iframe = document.getElementById('previewIframe');
        const title = document.getElementById('modalThemeTitle');
        const openBtn = document.getElementById('btnOpenNewTab');

        const card = document.querySelector(`.theme-card[data-theme-id="${themeId}"]`);
        const category = card ? card.getAttribute('data-category') : 'wedding';

        const demoUrl = "{{ route('dashboard.demo') }}?theme=" + slug + "&event_type=" + category;

        title.textContent = 'Preview Tema: ' + themeName;
        openBtn.href = demoUrl;
        iframe.src = demoUrl;

        modal.classList.remove('hidden');
    }

    function closeThemePreviewModal() {
        const modal = document.getElementById('previewModal');
        const iframe = document.getElementById('previewIframe');
        iframe.src = 'about:blank';
        modal.classList.add('hidden');
    }

    function selectAndCloseModal() {
        if (currentPreviewThemeId) {
            selectTheme(currentPreviewThemeId);
        }
        closeThemePreviewModal();
    }

    function setDeviceView(mode) {
        const container = document.getElementById('iframeContainer');
        const btnMobile = document.getElementById('btnDeviceMobile');
        const btnDesktop = document.getElementById('btnDeviceDesktop');

        if (mode === 'mobile') {
            container.className = "w-[390px] h-[100%] bg-white rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 relative border-4 border-slate-800";
            btnMobile.className = "px-2.5 py-1 rounded-md text-white bg-indigo-600 font-bold transition-all";
            btnDesktop.className = "px-2.5 py-1 rounded-md text-slate-400 hover:text-white transition-all";
        } else {
            container.className = "w-full h-full bg-white rounded-lg shadow-2xl overflow-hidden transition-all duration-300 relative border-0";
            btnDesktop.className = "px-2.5 py-1 rounded-md text-white bg-indigo-600 font-bold transition-all";
            btnMobile.className = "px-2.5 py-1 rounded-md text-slate-400 hover:text-white transition-all";
        }
    }

    // Filter awal saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => {
        filterThemes('wedding');
    });
</script>
@endsection
