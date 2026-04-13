<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- ============================== --}}
    {{-- META TAGS --}}
    {{-- ============================== --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Inventory Management System - Sistem manajemen inventaris barang SMK Wikrama Bogor yang modern dan efisien.">
    <meta name="author" content="SMK Wikrama Bogor">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Inventaris - SMK Wikrama Bogor')</title>

    {{-- ============================== --}}
    {{-- FONTS --}}
    {{-- ============================== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- ============================== --}}
    {{-- CSS LIBRARIES --}}
    {{-- ============================== --}}
    {{-- Bootstrap 5.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- ============================== --}}
    {{-- CUSTOM CSS --}}
    {{-- ============================== --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #1f2937;
            margin: 0;
            padding-top: 84px;
        }
        .navbar-landing {
            background: #ffffff;
            border-bottom: 1px solid rgba(15, 23, 42, .08);
            transition: all .2s ease-in-out;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: .02em;
        }
        .hero-section {
            padding: 5rem 0 3rem;
        }
        .hero-title {
            font-size: clamp(2.25rem, 4vw, 3.5rem);
            font-weight: 700;
            line-height: 1.05;
            margin-bottom: 1rem;
        }
        .hero-subtitle {
            max-width: 540px;
            font-size: 1.05rem;
            color: #475569;
            margin-bottom: 1.75rem;
        }
        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .85rem 1.5rem;
            background-color: #0d6efd;
            color: #ffffff;
            border-radius: 999px;
            border: 1px solid transparent;
            text-decoration: none;
            font-weight: 600;
        }
        .btn-cta:hover {
            background-color: #0b5ed7;
            color: #fff;
        }
        .features-section,
        .cta-section,
        .footer-section {
            padding: 4rem 0;
        }
        .section-title,
        .cta-title {
            font-size: clamp(1.75rem, 3vw, 2.5rem);
            font-weight: 700;
            margin-bottom: .75rem;
        }
        .section-subtitle,
        .cta-text {
            color: #475569;
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        .feature-item {
            display: flex;
            gap: 1rem;
            padding: 1.4rem;
            border-radius: 1rem;
            background: #ffffff;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .07);
            min-height: 180px;
            align-items: flex-start;
        }
        .feature-icon {
            width: 3rem;
            height: 3rem;
            display: grid;
            place-items: center;
            border-radius: 18px;
            background: #eef2ff;
            color: #4338ca;
            font-size: 1.35rem;
        }
        .feature-title {
            font-weight: 700;
            margin-bottom: .4rem;
        }
        .feature-desc {
            margin: 0;
            color: #64748b;
        }
        .footer-section {
            background: #ffffff;
        }
        .footer-brand {
            display: flex;
            gap: .75rem;
            align-items: center;
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 1rem;
        }
        .footer-desc,
        .footer-contact-item span {
            color: #64748b;
        }
        .footer-contact-item {
            display: flex;
            gap: .75rem;
            align-items: center;
            margin-bottom: .75rem;
        }
        .footer-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .footer-bottom {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(15, 23, 42, .08);
            color: #475569;
        }
        .modal-content {
            border-radius: 1rem;
        }
    </style>

    @stack('styles')
</head>

<body>
    {{-- Main Content --}}
    @yield('content')

    {{-- ============================== --}}
    {{-- JS LIBRARIES --}}
    {{-- ============================== --}}
    {{-- Bootstrap 5.3 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- ============================== --}}
    {{-- CUSTOM JS --}}
    {{-- ============================== --}}
    {{-- <script src="{{ asset('assets/js/landing.js') }}"></script> --}}

    @stack('scripts')
</body>

</html>