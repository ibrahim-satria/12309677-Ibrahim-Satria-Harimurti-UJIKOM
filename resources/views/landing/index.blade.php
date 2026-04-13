{{-- ============================== --}}
{{-- LANDING PAGE --}}
{{-- Extends: layouts.landing --}}
{{-- ============================== --}}
@extends('layouts.landing')

@section('title', 'Inventory Management - SMK Wikrama Bogor')

@section('content')

    {{-- Navbar Section --}}
    <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-landing fixed-top">
        <div class="container">
            {{-- Brand --}}
            <a class="navbar-brand" href="#hero">
                <span class="brand-icon">
                    <i class="bi bi-box-seam-fill"></i>
                </span>
                Inventaris
            </a>

            {{-- Mobile Toggle --}}
            <button class="navbar-toggler border-0 shadow-none" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarContent"
                    aria-controls="navbarContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <i class="bi bi-list fs-4"></i>
            </button>

            {{-- Nav Links --}}
            <div class="collapse navbar-collapse" id="navbarContent">
                {{-- Login Button --}}
                <div class="d-flex ms-auto">
                    <button type="button" class="btn btn-login" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section id="hero" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                {{-- Left Content --}}
                <div class="col-lg-6 text-center text-lg-start">
                    {{-- Title --}}
                    <h1 class="hero-title">
                        Inventory Management of SMK Wikrama Bogor
                    </h1>

                    {{-- Subtitle --}}
                    <p class="hero-subtitle">
                        Sistem inventaris modern untuk pengelolaan barang yang efisien.
                    </p>

                    {{-- CTA Buttons --}}
                    <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-cta">
                                    Dashboard <i class="bi bi-arrow-right"></i>
                                </a>
                            @else
                                <button type="button" class="btn-cta" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Mulai Sekarang <i class="bi bi-arrow-right"></i>
                                </button>
                            @endauth
                        @endif
                    </div>
                </div>

                {{-- Right Image --}}
                <div class="col-lg-6">
                    <div class="hero-image text-center">
                        {{-- Placeholder for image --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="features" class="features-section">
        <div class="container">
            {{-- Section Header --}}
            <div class="text-center">
                <h2 class="section-title">Fitur Utama</h2>
                <p class="section-subtitle">
                    Fitur canggih untuk pengelolaan inventaris.
                </p>
            </div>

            {{-- Feature Grid --}}
            <div class="row g-4">
                {{-- Feature 1 --}}
                <div class="col-lg-4">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div>
                            <h5 class="feature-title">Keamanan Data</h5>
                            <p class="feature-desc">
                                Data terlindungi dengan autentikasi aman.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Feature 2 --}}
                <div class="col-lg-4">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <div>
                            <h5 class="feature-title">Dashboard Real-time</h5>
                            <p class="feature-desc">
                                Pantau inventaris secara real-time.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Feature 3 --}}
                <div class="col-lg-4">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        <div>
                            <h5 class="feature-title">Responsive</h5>
                            <p class="feature-desc">
                                Akses dari berbagai perangkat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section id="cta" class="cta-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 class="cta-title">Siap Mengelola Inventaris?</h2>
                    <p class="cta-text">
                        Mulai gunakan sistem inventaris modern.
                    </p>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-cta">
                                Buka Dashboard <i class="bi bi-arrow-right"></i>
                            </a>
                        @else
                            <button type="button" class="btn-cta" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Login Sekarang <i class="bi bi-arrow-right"></i>
                            </button>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Footer Section --}}
    <footer id="contact" class="footer-section">
        <div class="container">
            <div class="row g-4">
                {{-- Footer Brand --}}
                <div class="col-lg-6">
                    <div class="footer-brand">
                        <span class="brand-icon">
                            <i class="bi bi-box-seam-fill"></i>
                        </span>
                        Inventaris
                    </div>
                    <p class="footer-desc">
                        Sistem manajemen inventaris untuk SMK Wikrama Bogor.
                    </p>
                </div>

                {{-- Contact Info --}}
                <div class="col-lg-6">
                    <h6 class="footer-title">Kontak</h6>
                    <div class="footer-contact-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Jl. Raya Wangun, Bogor</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bi bi-envelope-fill"></i>
                        <span>info@smkwikrama.sch.id</span>
                    </div>
                </div>
            </div>

            {{-- Footer Bottom --}}
            <div class="footer-bottom">
                <p class="mb-0">
                    &copy; {{ date('Y') }} <strong>SMK Wikrama Bogor</strong>. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    {{-- Login Modal --}}
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 justify-content-center pt-4 pb-0">
                    <h4 class="modal-title fw-normal" id="loginModalLabel">Login</h4>
                </div>
                <div class="modal-body px-5 pt-3 pb-5">
                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label text-dark">Email</label>
                            <input type="email" class="form-control shadow-none" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label text-dark">Password</label>
                            <input type="password" class="form-control shadow-none" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="d-flex gap-2 mt-4">
                            <button type="button" class="btn text-white shadow-none" data-bs-dismiss="modal" style="background-color: #fe774f; border-color: #fe774f;">Close</button>
                            <button type="submit" class="btn text-white shadow-none" style="background-color: #55dea8; border-color: #55dea8;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
