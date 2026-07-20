<nav class="navbar navbar-expand-md bg-transparent sticky-top mynavbar" style="padding: 12px">
    <div class="container">
        <!-- <a class="navbar-brand" href="{{ route('dashboard') }}">
            @if(isset($infos[0]))
                {{ $infos[0]->nama_pengantin_pria }} & {{ $infos[0]->nama_pengantin_istri }}
            @else
                Lusa
            @endif
        </a> -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Navigasi">
            <span class="bi bi-list fs-2" style="color: var(--sage-dark);"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="background-color: rgba(250, 249, 246, 0.96); backdrop-filter: blur(12px);">
            <div class="offcanvas-header border-bottom border-light">
                <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel" style="color: var(--sage-dark);">Menu Undangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Tutup"></button>
            </div>
            <div class="offcanvas-body">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="#home" onclick="closeOffcanvas()"><i class="bi bi-house-heart me-1"></i> Home</a>
                    <a class="nav-link" href="#info" onclick="closeOffcanvas()"><i class="bi bi-geo-alt me-1"></i> Info</a>
                    @if($story)
                        <a class="nav-link" href="#story" onclick="closeOffcanvas()"><i class="bi bi-journal-bookmark-fill me-1"></i> Story</a>
                    @endif
                    <a class="nav-link" href="#rsvp" onclick="closeOffcanvas()"><i class="bi bi-chat-left-heart me-1"></i> RSVP</a>
                    <a class="nav-link" href="#gifts" onclick="closeOffcanvas()"><i class="bi bi-gift me-1"></i> Gifts</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    function closeOffcanvas() {
        const offcanvasEl = document.getElementById('offcanvasNavbar');
        if (offcanvasEl) {
            const instance = bootstrap.Offcanvas.getInstance(offcanvasEl);
            if (instance) {
                instance.hide();
            }
        }
    }
</script>
