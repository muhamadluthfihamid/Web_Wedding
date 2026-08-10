<!-- Global Custom Preloader & Navigation Overlay -->
<div id="global-preloader" class="global-preloader-overlay">
    <div class="preloader-spinner-wrapper">
        <!-- Dual Glowing Outer Spinner Rings -->
        <div class="preloader-ring-outer"></div>
        <div class="preloader-ring-inner"></div>
        
        <!-- Central Heart Icon -->
        <div class="preloader-heart-center">
            <svg class="preloader-heart-icon" viewBox="0 0 24 24" width="20" height="20" fill="#f43f5e">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>
    </div>

    <!-- Title & Subtitle -->
    <div class="preloader-text-wrapper">
        <h3 id="preloader-text" class="preloader-title">
            <span>{{ $store_name ?? "Lu'iz-Wedding" }}</span>
            <span class="preloader-dots">
                <span class="dot-1">.</span>
                <span class="dot-2">.</span>
                <span class="dot-3">.</span>
            </span>
        </h3>
        <p class="preloader-subtitle">Memuat Halaman...</p>
    </div>
</div>

<style>
.global-preloader-overlay {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    z-index: 999999 !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
    background-color: rgba(15, 23, 42, 0.94) !important;
    backdrop-filter: blur(14px) !important;
    -webkit-backdrop-filter: blur(14px) !important;
    color: #ffffff !important;
    opacity: 1;
    visibility: visible;
    transition: opacity 0.5s ease, visibility 0.5s ease;
}

.global-preloader-overlay.fade-out {
    opacity: 0 !important;
    visibility: hidden !important;
    pointer-events: none !important;
}

.preloader-spinner-wrapper {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin-bottom: 1.5rem !important;
    width: 80px !important;
    height: 80px !important;
}

.preloader-ring-outer {
    width: 80px !important;
    height: 80px !important;
    border: 4px solid transparent !important;
    border-top-color: #f43f5e !important;
    border-right-color: #6366f1 !important;
    border-radius: 50% !important;
    animation: preloaderSpin 1s linear infinite !important;
}

.preloader-ring-inner {
    position: absolute !important;
    width: 56px !important;
    height: 56px !important;
    border: 4px solid transparent !important;
    border-bottom-color: #fbbf24 !important;
    border-left-color: #fb7185 !important;
    border-radius: 50% !important;
    animation: preloaderSpinReverse 1.2s linear infinite !important;
}

.preloader-heart-center {
    position: absolute !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 40px !important;
    height: 40px !important;
    background-color: #0f172a !important;
    border-radius: 50% !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4) !important;
}

.preloader-heart-icon {
    animation: preloaderPulse 1.2s ease-in-out infinite alternate !important;
}

.preloader-text-wrapper {
    text-align: center !important;
}

.preloader-title {
    font-size: 1.25rem !important;
    font-weight: 800 !important;
    letter-spacing: -0.025em !important;
    color: #ffffff !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 4px !important;
    margin-bottom: 0.35rem !important;
    font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, sans-serif !important;
}

.preloader-dots {
    display: inline-flex !important;
    gap: 2px !important;
}

.preloader-dots span {
    animation: preloaderBounce 1.4s infinite ease-in-out both !important;
}

.dot-1 { animation-delay: 0s !important; }
.dot-2 { animation-delay: 0.16s !important; }
.dot-3 { animation-delay: 0.32s !important; }

.preloader-subtitle {
    font-size: 0.75rem !important;
    color: #94a3b8 !important;
    font-weight: 600 !important;
    letter-spacing: 0.1em !important;
    text-transform: uppercase !important;
    margin: 0 !important;
    font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, sans-serif !important;
}

@keyframes preloaderSpin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes preloaderSpinReverse {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(-360deg); }
}

@keyframes preloaderPulse {
    0% { transform: scale(0.9); opacity: 0.8; }
    100% { transform: scale(1.18); opacity: 1; }
}

@keyframes preloaderBounce {
    0%, 80%, 100% { transform: scale(0); }
    40% { transform: scale(1.0); }
}
</style>

<script>
    (function() {
        const preloader = document.getElementById('global-preloader');
        if (!preloader) return;

        function hidePreloader() {
            if (preloader.classList.contains('fade-out')) return;
            preloader.classList.add('fade-out');
            setTimeout(function() {
                preloader.style.display = 'none';
            }, 500);
        }

        function showPreloader(text) {
            preloader.style.display = 'flex';
            preloader.offsetHeight; // Force reflow
            preloader.classList.remove('fade-out');
            if (text) {
                const textElem = document.getElementById('preloader-text');
                if (textElem && textElem.querySelector('span:first-child')) {
                    textElem.querySelector('span:first-child').innerText = text;
                }
            }
        }

        if (document.readyState === 'complete') {
            hidePreloader();
        } else {
            window.addEventListener('load', hidePreloader);
            setTimeout(hidePreloader, 4000);
        }

        document.addEventListener('submit', function(e) {
            if (e.defaultPrevented) return;
            if (e.target && e.target.target !== '_blank') {
                showPreloader('Memproses...');
            }
        });

        window.showGlobalPreloader = showPreloader;
        window.hideGlobalPreloader = hidePreloader;
    })();
</script>
