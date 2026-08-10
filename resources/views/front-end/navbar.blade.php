<!-- Floating Bottom Navigation Dock (Hidden on Hero Cover, shown on click Buka Undangan) -->
<nav class="mobile-bottom-nav d-none fixed-bottom" id="mobile-bottom-nav">
    <div class="mobile-nav-container">
        <a href="#home" class="mobile-nav-item active">
            <i class="bi bi-house-heart"></i>
            <span>Home</span>
        </a>
        <a href="#info" class="mobile-nav-item">
            <i class="bi bi-geo-alt"></i>
            <span>Info</span>
        </a>
        @if($story)
        <a href="#story" class="mobile-nav-item">
            <i class="bi bi-journal-bookmark-fill"></i>
            <span>Story</span>
        </a>
        @endif
        <a href="#rsvp" class="mobile-nav-item">
            <i class="bi bi-chat-left-heart"></i>
            <span>RSVP</span>
        </a>
        <a href="#gifts" class="mobile-nav-item">
            <i class="bi bi-gift"></i>
            <span>Gifts</span>
        </a>
        @if(isset($turutMengundangs) && $turutMengundangs->count() > 0)
        <a href="#turut-mengundang" class="mobile-nav-item">
            <i class="bi bi-people"></i>
            <span>Invite</span>
        </a>
        @endif
    </div>
</nav>

<!-- Desktop / General Sticky Top Navbar (Hidden on Hero Cover, shown on click Buka Undangan) -->
<nav class="navbar navbar-expand-md sticky-top mynavbar py-2 px-3 d-none" id="desktop-top-nav">

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="background-color: rgba(250, 249, 246, 0.98); backdrop-filter: blur(16px); z-index: 1055;">
        <div class="offcanvas-body p-4">
            <div class="navbar-nav ms-auto text-start">
                <a class="nav-link py-2.5 border-bottom border-light" href="#home" onclick="closeOffcanvas()"><i class="bi bi-house-heart me-2"></i> Home</a>
                <a class="nav-link py-2.5 border-bottom border-light" href="#info" onclick="closeOffcanvas()"><i class="bi bi-geo-alt me-2"></i> Info</a>
                @if($story)
                <a class="nav-link py-2.5 border-bottom border-light" href="#story" onclick="closeOffcanvas()"><i class="bi bi-journal-bookmark-fill me-2"></i> Story</a>
                @endif
                <a class="nav-link py-2.5 border-bottom border-light" href="#rsvp" onclick="closeOffcanvas()"><i class="bi bi-chat-left-heart me-2"></i> RSVP & Ucapan</a>
                <a class="nav-link py-2.5 border-bottom border-light" href="#gifts" onclick="closeOffcanvas()"><i class="bi bi-gift me-2"></i> Hadiah & Gifts</a>
                @if(isset($turutMengundangs) && $turutMengundangs->count() > 0)
                <a class="nav-link py-2.5" href="#turut-mengundang" onclick="closeOffcanvas()"><i class="bi bi-people me-2"></i> Turut Mengundang</a>
                @endif
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

    // Highlight active item on scroll for mobile bottom nav
    document.addEventListener("DOMContentLoaded", function() {
        const sections = document.querySelectorAll("section[id]");
        const navItems = document.querySelectorAll(".mobile-nav-item");

        window.addEventListener("scroll", function() {
            let current = "";
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 120;
                const sectionHeight = section.offsetHeight;
                if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                    current = section.getAttribute("id");
                }
            });

            navItems.forEach(item => {
                item.classList.remove("active");
                if (item.getAttribute("href") === "#" + current) {
                    item.classList.add("active");
                }
            });
        });
    });
</script>