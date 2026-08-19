<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/wa-preview.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/wa-preview.png') }}">
    <!-- Fonts & Icons -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Page-level styles (e.g., Leaflet CSS pushed from child views) -->
    @stack('styles')
</head>

<body class="h-full font-sans antialiased text-slate-800">
    @include('components.preloader')

    <div class="min-h-full flex overflow-hidden">
        <!-- Sidebar for Desktop -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 text-slate-400 transition-transform duration-300 -translate-x-full lg:translate-x-0 lg:static lg:inset-0 flex flex-col justify-between shadow-xl flex-shrink-0">
            <!-- Sidebar Content -->
            <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                <!-- Brand Logo & Event Badge -->
                <div class="px-6 mb-8">
                    <div class="flex items-center text-white gap-2">
                        <i class="fas {{ Auth::user()->isKhitanan() ? 'fa-child text-emerald-400' : 'fa-heart text-rose-500' }} text-2xl animate-pulse"></i>
                        <span class="text-xl font-bold tracking-tight">{{ $store_name }}</span>
                    </div>
                    <div class="mt-2 flex items-center justify-between">
                        <span class="inline-block px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider rounded-md {{ Auth::user()->isKhitanan() ? 'bg-emerald-600 text-white' : 'bg-pink-600 text-white' }}">
                            {{ Auth::user()->isKhitanan() ? '👦 Mode: Khitanan' : '💍 Mode: Pernikahan' }}
                        </span>
                    </div>

                    @if(Auth::user()->isSuperAdmin())
                        <div class="mt-3">
                            <span class="text-[10px] uppercase font-bold text-slate-400 block mb-1">Switch Mode Demo:</span>
                            <form action="{{ route('admin.switchEventType') }}" method="POST" class="flex gap-1 bg-slate-800 p-1 rounded-lg">
                                @csrf
                                <button type="submit" name="event_type" value="wedding" 
                                        class="flex-1 py-1 text-[10px] font-bold rounded-md transition-all {{ Auth::user()->isWedding() ? 'bg-pink-600 text-white shadow-xs' : 'text-slate-400 hover:text-white' }}"
                                        title="Kelola Data Demo Pernikahan">
                                    💍 Pernikahan
                                </button>
                                <button type="submit" name="event_type" value="khitanan" 
                                        class="flex-1 py-1 text-[10px] font-bold rounded-md transition-all {{ Auth::user()->isKhitanan() ? 'bg-emerald-600 text-white shadow-xs' : 'text-slate-400 hover:text-white' }}"
                                        title="Kelola Data Demo Khitanan">
                                    👦 Khitanan
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Nav Items -->
                <nav class="flex-1 px-4 space-y-1">
                    <a href="{{ route('admin.home') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.home') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-tachometer-alt mr-3 text-lg transition-colors {{ request()->routeIs('admin.home') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        Dashboard
                    </a>

                    <div class="pt-4 pb-2">
                        <span class="px-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Pengaturan Acara</span>
                    </div>

                    <a href="{{ route('info.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('info.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-circle-info mr-3 text-lg transition-colors {{ request()->routeIs('info.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        {{ Auth::user()->isKhitanan() ? 'Info Acara Khitan' : 'Info Pernikahan' }}
                    </a>

                    <a href="{{ route('audio.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('audio.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-music mr-3 text-lg transition-colors {{ request()->routeIs('audio.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        Musik / Audio Undangan
                    </a>

                    <a href="{{ route('story.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('story.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-brands fa-stripe-s mr-3 text-lg transition-colors {{ request()->routeIs('story.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        {{ Auth::user()->isKhitanan() ? 'Profil / Harapan' : 'Cerita Kita' }}
                    </a>

                    <a href="{{ route('rsvp.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('rsvp.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-hands-helping mr-3 text-lg transition-colors {{ request()->routeIs('rsvp.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        Konfirmasi RSVP
                    </a>

                    <a href="{{ route('wish.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('wish.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-comments mr-3 text-lg transition-colors {{ request()->routeIs('wish.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        Ucapan Tamu
                    </a>

                    <a href="{{ route('gifts.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('gifts.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-gifts mr-3 text-lg transition-colors {{ request()->routeIs('gifts.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        Hadiah / Gift
                    </a>

                    <a href="{{ route('guests.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('guests.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-users mr-3 text-lg transition-colors {{ request()->routeIs('guests.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        List Undangan
                    </a>

                    <a href="{{ route('biodataPria.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('biodataPria.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid {{ Auth::user()->isKhitanan() ? 'fa-child' : 'fa-user-circle' }} mr-3 text-lg transition-colors {{ request()->routeIs('biodataPria.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        {{ Auth::user()->isKhitanan() ? 'Data Anak Khitan' : 'Biodata Pria' }}
                    </a>

                    <a href="{{ route('biodataWanita.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('biodataWanita.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid {{ Auth::user()->isKhitanan() ? 'fa-users' : 'fa-user-circle' }} mr-3 text-lg transition-colors {{ request()->routeIs('biodataWanita.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        {{ Auth::user()->isKhitanan() ? 'Data Orang Tua' : 'Biodata Wanita' }}
                    </a>

                    <a href="{{ route('turutMengundang.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('turutMengundang.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-users-rectangle mr-3 text-lg transition-colors {{ request()->routeIs('turutMengundang.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        Turut Mengundang
                    </a>

                    @if(Auth::user()->isSuperAdmin())
                    <div class="pt-4 pb-2">
                        <span class="px-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Administrator</span>
                    </div>

                    <a href="{{ route('admin.rental.orders.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.rental.orders.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-shopping-cart mr-3 text-lg transition-colors {{ request()->routeIs('admin.rental.orders.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        Pesanan Sewa
                    </a>

                    <a href="{{ route('admin.rental.packages.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.rental.packages.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-boxes-packing mr-3 text-lg transition-colors {{ request()->routeIs('admin.rental.packages.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        Kelola Paket
                    </a>

                    <a href="{{ route('admin.themes.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.themes.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-palette mr-3 text-lg transition-colors {{ request()->routeIs('admin.themes.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        Kelola Tema
                    </a>

                    <a href="{{ route('users.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('users.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-users-cog mr-3 text-lg transition-colors {{ request()->routeIs('users.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        Kelola User
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-cog mr-3 text-lg transition-colors {{ request()->routeIs('admin.settings.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"></i>
                        Pengaturan Toko
                    </a>
                    @endif

                    <div class="pt-4 pb-2">
                        <span class="px-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Web Undangan</span>
                    </div>
                    <a href="{{ route('rental.status') }}" class="group flex items-center px-4 py-2.5 text-sm font-medium rounded-lg text-indigo-400 hover:bg-slate-800 hover:text-indigo-300 transition-colors">
                        <i class="fas fa-clock mr-3 text-lg text-indigo-400"></i>
                        Status Sewa Saya
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Overlay for Mobile Sidebar -->
        <div id="sidebar-overlay" class="fixed inset-0 z-30 bg-slate-900/40 backdrop-blur-sm hidden lg:hidden"></div>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden h-screen">
            <!-- Topbar -->
            <header class="bg-white border-b border-slate-100 h-16 flex items-center justify-between px-6 z-20 shadow-sm flex-shrink-0">
                <div class="flex items-center gap-4">
                    <!-- Mobile menu toggle button -->
                    <button id="mobile-menu-button" class="lg:hidden p-2 text-slate-600 hover:bg-slate-50 rounded-lg">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="hidden sm:block text-sm text-slate-500 font-medium">Selamat datang, <span class="text-slate-800 font-semibold">{{ Auth::user()->name }}</span></div>
                </div>

                <!-- Topbar right actions -->
                <div class="flex items-center gap-4">
                    @if(Auth::user()->isSuperAdmin())
                    <!-- Orders Notification Dropdown -->
                    <div class="relative">
                        <button id="orders-btn"
                            data-mark-url="{{ route('notifications.markOrdersRead') }}"
                            class="p-2 text-slate-600 hover:bg-slate-50 rounded-lg relative focus:outline-none" title="Pesanan Sewa Baru">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            @if($pendingOrdersCount > 0)
                            <span id="orders-badge" class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-amber-500 text-[10px] font-bold text-white ring-2 ring-white animate-bounce">{{ $pendingOrdersCount }}</span>
                            @endif
                        </button>
                        <!-- Dropdown Panel -->
                        <div id="orders-dropdown" class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-slate-100 hidden overflow-hidden py-1 z-50">
                            <div class="px-4 py-2 border-b border-slate-100 bg-amber-50/60 text-xs font-bold text-amber-800 flex items-center justify-between">
                                <span>Pesanan Sewa Masuk</span>
                                <span class="text-[10px] bg-amber-200 text-amber-900 px-2 py-0.5 rounded-full font-semibold">{{ $pendingOrdersCount }} Menunggu</span>
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                @forelse($recentOrders as $order)
                                <a href="{{ route('admin.rental.orders.show', $order) }}" class="flex px-4 py-3 hover:bg-slate-50 border-b border-slate-100 last:border-b-0 gap-3 items-center">
                                    <div class="flex-shrink-0">
                                        <div class="h-9 w-9 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-xs">
                                            <i class="fas fa-store"></i>
                                        </div>
                                    </div>
                                    <div class="text-xs flex-1">
                                        <div class="font-bold text-slate-900">{{ $order->user->full_name }}</div>
                                        <div class="text-slate-600 font-medium">Paket {{ $order->package->nama }}</div>
                                        <div class="text-[10px] text-amber-600 font-semibold mt-0.5"><i class="fas fa-clock mr-0.5"></i> {{ $order->created_at->diffForHumans() }}</div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-700">{{ $order->package->harga_format }}</span>
                                </a>
                                @empty
                                <div class="px-4 py-6 text-center text-xs text-slate-400">Tidak ada pesanan sewa baru</div>
                                @endforelse
                            </div>
                            <a href="{{ route('admin.rental.orders.index') }}" class="block text-center py-2.5 text-xs font-bold text-indigo-600 hover:text-indigo-500 border-t border-slate-100 bg-slate-50/50">Kelola Semua Pesanan →</a>
                        </div>
                    </div>
                    @endif

                    <!-- Notifications Dropdown -->
                    <div class="relative">
                        <button id="alerts-btn"
                            data-mark-url="{{ route('notifications.markRsvpRead') }}"
                            class="p-2 text-slate-600 hover:bg-slate-50 rounded-lg relative focus:outline-none">
                            <i class="fas fa-bell text-xl"></i>
                            @if($unreadRsvpsCount > 0)
                            <span id="alerts-badge" class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-rose-500 text-[10px] font-bold text-white ring-2 ring-white">{{ $unreadRsvpsCount }}</span>
                            @endif
                        </button>
                        <!-- Dropdown Panel -->
                        <div id="alerts-dropdown" class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-slate-100 hidden overflow-hidden py-1 z-50">
                            <div class="px-4 py-2 border-b border-slate-100 bg-slate-50/50 text-xs font-semibold text-slate-700">Konfirmasi RSVP Baru</div>
                            <div class="max-h-64 overflow-y-auto">
                                @forelse($recentRsvps as $rsvp)
                                <a href="{{ route('rsvp.index') }}" class="flex px-4 py-3 hover:bg-slate-50 border-b border-slate-100 last:border-b-0 gap-3">
                                    <div class="flex-shrink-0 mt-1">
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full {{ $rsvp->kehadiran ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                            <i class="fas {{ $rsvp->kehadiran ? 'fa-user-check' : 'fa-user-times' }}"></i>
                                        </span>
                                    </div>
                                    <div class="text-xs">
                                        <div class="font-medium text-slate-900">Tamu <strong>{{ $rsvp->nama_tamu }}</strong></div>
                                        <div class="text-slate-500">Mengonfirmasi {{ $rsvp->kehadiran ? 'Hadir (' . $rsvp->jumlah . ' org)' : 'Tidak Hadir' }}</div>
                                        <div class="text-[10px] text-slate-400 mt-1">{{ $rsvp->created_at->diffForHumans() }}</div>
                                    </div>
                                </a>
                                @empty
                                <div class="px-4 py-6 text-center text-xs text-slate-400">Belum ada RSVP baru</div>
                                @endforelse
                            </div>
                            <a href="{{ route('rsvp.index') }}" class="block text-center py-2 text-xs font-semibold text-indigo-600 hover:text-indigo-500 border-t border-slate-100">Tampilkan Semua RSVP</a>
                        </div>
                    </div>

                    <!-- Messages Dropdown -->
                    <div class="relative">
                        <button id="messages-btn"
                            data-mark-url="{{ route('notifications.markWishRead') }}"
                            class="p-2 text-slate-600 hover:bg-slate-50 rounded-lg relative focus:outline-none">
                            <i class="fas fa-envelope text-xl"></i>
                            @if($unreadWishesCount > 0)
                            <span id="messages-badge" class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-rose-500 text-[10px] font-bold text-white ring-2 ring-white">{{ $unreadWishesCount }}</span>
                            @endif
                        </button>
                        <!-- Dropdown Panel -->
                        <div id="messages-dropdown" class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-slate-100 hidden overflow-hidden py-1 z-50">
                            <div class="px-4 py-2 border-b border-slate-100 bg-slate-50/50 text-xs font-semibold text-slate-700">Ucapan & Doa Restu Terbaru</div>
                            <div class="max-h-64 overflow-y-auto">
                                @forelse($recentWishes as $wish)
                                <a href="{{ route('wish.index') }}" class="flex px-4 py-3 hover:bg-slate-50 border-b border-slate-100 last:border-b-0 gap-3">
                                    <div class="flex-shrink-0 mt-1">
                                        <div class="h-8 w-8 rounded-full bg-indigo-550 bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm">
                                            {{ strtoupper(substr($wish->nama, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="text-xs flex-1">
                                        <div class="font-medium text-slate-900">{{ $wish->nama }}</div>
                                        <div class="text-slate-500 truncate max-w-[180px]">{{ $wish->ucapan }}</div>
                                        <div class="text-[10px] text-slate-400 mt-1">{{ $wish->created_at->diffForHumans() }}</div>
                                    </div>
                                </a>
                                @empty
                                <div class="px-4 py-6 text-center text-xs text-slate-400">Belum ada ucapan baru</div>
                                @endforelse
                            </div>
                            <a href="{{ route('wish.index') }}" class="block text-center py-2 text-xs font-semibold text-indigo-600 hover:text-indigo-500 border-t border-slate-100">Tampilkan Semua Ucapan</a>
                        </div>
                    </div>

                    <div class="h-6 w-px bg-slate-200"></div>

                    <!-- User Dropdown -->
                    <div class="relative">
                        <button id="user-btn" class="flex items-center gap-2 text-sm text-slate-700 hover:bg-slate-50 p-1 rounded-lg focus:outline-none">
                            <div class="h-8 w-8 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-sm shadow-md">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden md:block font-medium text-slate-700">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-[10px] text-slate-400 hidden md:block"></i>
                        </button>
                        <!-- Dropdown Panel -->
                        <div id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-slate-100 hidden py-1 z-50">
                            <a href="{{ route('profile.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                <i class="fas fa-user text-slate-400 w-4"></i> Profile
                            </a>
                            <hr class="my-1 border-slate-100">
                            <a href="#" id="logout-trigger" class="flex items-center gap-2 px-4 py-2 text-sm text-rose-600 hover:bg-rose-50/50">
                                <i class="fas fa-sign-out-alt text-rose-400 w-4"></i> Keluar
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-6 sm:p-8">
                @yield('main-content')
            </main>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logout-modal" class="fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-sm hidden items-center justify-center">
        <div class="bg-white rounded-2xl p-6 shadow-2xl border border-slate-100 w-full max-w-sm mx-4 transform transition-all duration-300">
            <h3 class="text-lg font-bold text-slate-900 mb-2">Konfirmasi Keluar</h3>
            <p class="text-sm text-slate-500 mb-6">Apakah Anda yakin ingin keluar dari panel admin {{ $store_name ?? config('app.name') }}?</p>
            <div class="flex justify-end gap-3">
                <button id="logout-cancel" class="px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">Batal</button>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="px-4 py-2 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-lg transition-colors">Keluar</a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <!-- SweetAlert2 (global) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Global scripts -->
    @stack('scripts')

    <!-- Global Flash Message Alert -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashSuccess = <?php echo json_encode(session('success')); ?>;
            const flashError   = <?php echo json_encode(session('error')); ?>;
            const flashWarning = <?php echo json_encode(session('warning')); ?>;
            const flashInfo    = <?php echo json_encode(session('info')); ?>;

            if (flashSuccess) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: flashSuccess,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'text-sm',
                        title: 'text-base font-bold',
                    }
                });
            }

            if (flashError) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: flashError,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'text-sm',
                        title: 'text-base font-bold',
                    }
                });
            }

            if (flashWarning) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: flashWarning,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'text-sm',
                        title: 'text-base font-bold',
                    }
                });
            }

            if (flashInfo) {
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: flashInfo,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'text-sm',
                        title: 'text-base font-bold',
                    }
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggles
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            if (mobileMenuButton && sidebar && sidebarOverlay) {
                mobileMenuButton.addEventListener('click', () => {
                    sidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.remove('hidden');
                });

                sidebarOverlay.addEventListener('click', () => {
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                });
            }

            // Dropdown togglers with mark-as-read support
            function setupDropdown(btnId, dropdownId, badgeId) {
                const btn = document.getElementById(btnId);
                const dropdown = document.getElementById(dropdownId);

                if (btn && dropdown) {
                    btn.addEventListener('click', function(e) {
                        e.stopPropagation();

                        const isOpening = dropdown.classList.contains('hidden');

                        // Close others
                        document.querySelectorAll('[id$="-dropdown"]').forEach(d => {
                            if (d.id !== dropdownId) d.classList.add('hidden');
                        });
                        dropdown.classList.toggle('hidden');

                        // If opening dropdown AND there's a mark-url → fire AJAX + hide badge
                        if (isOpening && btn.dataset.markUrl) {
                            const badge = badgeId ? document.getElementById(badgeId) : null;

                            // Immediately hide badge for instant UI feedback
                            if (badge) {
                                badge.style.transition = 'opacity 0.3s, transform 0.3s';
                                badge.style.opacity = '0';
                                badge.style.transform = 'scale(0)';
                                setTimeout(() => badge.remove(), 300);
                            }

                            // Persist read state on server via session
                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            fetch(btn.dataset.markUrl, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json',
                                },
                            }).catch(err => console.error('Mark-as-read failed:', err));
                        }
                    });
                }
            }

            setupDropdown('orders-btn', 'orders-dropdown', 'orders-badge');
            setupDropdown('alerts-btn', 'alerts-dropdown', 'alerts-badge');
            setupDropdown('messages-btn', 'messages-dropdown', 'messages-badge');
            setupDropdown('user-btn', 'user-dropdown', null);

            // Close dropdowns on outside click
            document.addEventListener('click', function() {
                document.querySelectorAll('[id$="-dropdown"]').forEach(d => d.classList.add('hidden'));
            });

            // Logout Modal Trigger
            const logoutTrigger = document.getElementById('logout-trigger');
            const logoutModal = document.getElementById('logout-modal');
            const logoutCancel = document.getElementById('logout-cancel');

            if (logoutTrigger && logoutModal && logoutCancel) {
                logoutTrigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    logoutModal.classList.remove('hidden');
                    logoutModal.classList.add('flex');
                });

                logoutCancel.addEventListener('click', function() {
                    logoutModal.classList.add('hidden');
                    logoutModal.classList.remove('flex');
                });
            }
        });
    </script>
</body>

</html>