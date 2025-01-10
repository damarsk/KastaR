@extends('layouts.app')
@section('title', 'KastaR - Solusi Kasir Pintar')
@section('styles')
<!-- Favicons -->
<link href="{{ asset('land_css/img/favicon.png') }}" rel="icon">
<link href="{{ asset('land_css/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset('land_css/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('land_css/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('land_css/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('land_css/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('land_css/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

<!-- Main CSS File -->
<link href="{{ asset('land_css/css/main.css') }}" rel="stylesheet">
@endsection

@section('content')
<header id="header" class="header d-flex align-items-center fixed-top">
    <div
        class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            <img src="{{ asset('land_css/img/logo.png') }}" alt="">
            <h1 class="sitename">KastaR | Kasir Pintar</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            <ul class="navbar-list">
                <li><a href="#tutorial">Tutorial Penggunaan</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
        </nav>

        <a class="btn-getstarted" href="{{ route('login') }}">Masuk</a>
    </div>
</header>

<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-up" data-aos-delay="200">

                        <h1 class="mb-4">
                            KastaR <br>
                            Solusi Kasir Pintar <br>
                            <span class="accent-text">Untuk Bisnis Anda</span>
                        </h1>

                        <p class="mb-4 mb-md-5">
                            KastaR adalah solusi kasir pintar yang dirancang untuk memudahkan pengelolaan transaksi
                            bisnis Anda.
                            Dengan membantu meningkatkan efisiensi dan akurasi dalam pencatatan penjualan.
                        </p>

                        <div class="hero-buttons">
                            <a href="#about" class="btn btn-primary me-0 me-sm-2 mx-1">Masuk</a>
                            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                                class="btn btn-link mt-2 mt-sm-0 glightbox">
                                <i class="bi bi-play-circle me-1"></i>
                                Tutorial Penggunaan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
                        <img src="{{ asset('land_css/img/illustration-1.webp') }}" alt="Hero Image" class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
                <div class="col-lg-4 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="bi bi-basket"></i>
                        </div>
                        <div class="stat-content">
                            <h4>Meningkatkan Penjualan</h4>
                            <p class="mb-0">Meningkatkan penjualan dengan sistem kasir yang efisien dan mudah
                                digunakan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="bi bi-globe2"></i>
                        </div>
                        <div class="stat-content">
                            <h4>Kemudahan Akses</h4>
                            <p class="mb-0">Kemudahan Akses untuk meningkatkan Efisiensi</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="bi bi-award"></i>
                        </div>
                        <div class="stat-content">
                            <h4>Sistem Terbaik</h4>
                            <p class="mb-0">Memiliki U/E Interface Terbaik</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Hero Section -->

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
@endsection

@section('scripts')
    <!-- Vendor JS Files -->
    <script src="{{ asset('land_css/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('land_css/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('land_css/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('land_css/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('land_css/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('land_css/vendor/purecounter/purecounter_vanilla.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('land_css/js/main.js') }}"></script>
@endsection
