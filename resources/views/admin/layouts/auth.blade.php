<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Auth</title>

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

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
</head>
<body class="h-full">
    @include('components.preloader')

<div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gradient-to-tr from-slate-100 via-slate-50 to-indigo-50/30">
    @yield('main-content')
</div>

<!-- SweetAlert2 (global) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Global Flash Message Alert -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const flashSuccess = {!! json_encode(session('success')) !!};
        const flashError   = {!! json_encode(session('error')) !!};
        const flashWarning = {!! json_encode(session('warning')) !!};
        const flashInfo    = {!! json_encode(session('info')) !!};

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

@stack('scripts')
</body>
</html>
