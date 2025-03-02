<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KastaR - Solusi Kasir Pintar</title>
    
    <link rel="icon" href="{{ asset('land_style/img/logo-circle.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('land_style/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('land_style/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('land_style/vendor/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('land_style/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('land_style/css/main.css') }}">
    
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
</head>
<body>
    <!-- Navbar -->
    <nav id="home" class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a href="#" class="logo">
                <img src="{{ asset('land_style/img/logo.svg') }}" alt="KastaR Logo">
                KastaR
            </a>
            
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <ul class="nav-links">
                <li><a href="#home" class="active">Beranda</a></li>
                <li><a href="#features">Fitur</a></li>
                <li><a href="#introduction">Tentang</a></li>
                <li><a href="#benefits">Keunggulan</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
            
            <a href="{{ route('auth.index') }}" class="btn d-none d-lg-block">Masuk</a>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="hero d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row gy-4">
                <!-- Kolom untuk teks -->
                <div class="col-12 col-md-6 order-2 order-md-1">
                    <h1 class="display-1 fw-bold text-start">KastaR</h1>
                    <p class="fs-4 text-start">Solusi Kasir Pintar Untuk Bisnis Anda</p>
                    <p class="text-start">KastaR adalah solusi kasir pintar yang dirancang untuk memudahkan pengelolaan transaksi bisnis Anda, membantu meningkatkan efisiensi dan akurasi dalam pencatatan penjualan.</p>
                    <!-- Wrapper untuk tombol agar rata kiri -->
                    <div class="text-start">
                        <a href="https://www.youtube.com/watch?v=QfavjTWfN9M&t=256s" class="glightbox">
                            <button class="btn btn-hero-2"><i class="bi bi-play"></i> Tutorial Penggunaan</button>
                        </a>
                    </div>
                </div>
                <!-- Kolom untuk preview interface -->
                <div class="col-12 col-md-6 order-1 order-md-2">
                    <div class="d-flex justify-content-center align-items-center hero-img">
                        <img src="{{ asset('land_style/img/cash.webp') }}" alt="Cahier" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section id="features" class="features">
        <h2 class="section-title" data-aos="fade-up">Fitur Utama</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">KastaR hadir dengan berbagai fitur unggulan yang dirancang khusus untuk memenuhi kebutuhan bisnis Anda.</p>
        
        <div class="feature-cards">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-graph-up-arrow feature-icon"></i>
                <h3>Meningkatkan Penjualan</h3>
                <p>Meningkatkan penjualan dengan sistem kasir yang efisien dan mudah digunakan.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-phone feature-icon"></i>
                <h3>Kemudahan Akses</h3>
                <p>Kemudahan Akses untuk meningkatkan Efisiensi dalam pengelolaan bisnis Anda.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                <i class="bi bi-laptop feature-icon"></i>
                <h3>Sistem Terbaik</h3>
                <p>Memiliki User Interface/Experience Terbaik yang mudah dipahami dan digunakan.</p>
            </div>
        </div>
    </section>
    
    <!-- Product Introduction -->
    <section id="introduction" class="introduction">
        <h2 class="section-title" data-aos="fade-up">Kenapa Memilih KastaR?</h2>
        <p data-aos="fade-up" data-aos-delay="200">KastaR adalah sistem kasir pintar modern yang dikembangkan khusus untuk memenuhi kebutuhan bisnis kecil dan menengah di Indonesia.</p>
        
        <div class="container statistics">
            <div class="row">
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="statistic-item p-4 border rounded shadow-sm">
                <div class="feature-icon mb-3">
                    <i class="bi bi-people"></i>
                </div>
                <h3><span class="purecounter" data-purecounter-start="0" data-purecounter-end="5000" data-purecounter-duration="2">0</span>+ Pengguna</h3>
                <p class="mb-0">Lebih dari 5000 pengguna telah mempercayai KastaR untuk mengelola bisnis mereka.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="statistic-item p-4 border rounded shadow-sm">
                <div class="feature-icon mb-3">
                    <i class="bi bi-shop"></i>
                </div>
                <h3><span class="purecounter" data-purecounter-start="0" data-purecounter-end="1200" data-purecounter-duration="2">0</span>+ Toko</h3>
                <p class="mb-0">Lebih dari 1200 toko menggunakan KastaR untuk operasional sehari-hari.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="500">
                <div class="statistic-item p-4 border rounded shadow-sm">
                <div class="feature-icon mb-3">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <h3><span class="purecounter" data-purecounter-start="0" data-purecounter-end="100000" data-purecounter-duration="2">0</span>+ Transaksi</h3>
                <p class="mb-0">Lebih dari 100,000 transaksi telah diproses menggunakan KastaR.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4" data-aos="fade-up" data-aos-delay="600">
                <div class="statistic-item p-4 border rounded shadow-sm">
                <div class="feature-icon mb-3">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <h3><span class="purecounter" data-purecounter-start="0" data-purecounter-end="200" data-purecounter-duration="2">0</span>+ Pertumbuhan</h3>
                <p class="mb-0">KastaR membantu bisnis tumbuh dengan cepat dan efisien.</p>
                </div>
            </div>
            </div>
        </div>
    </section>
    
    <!-- Benefits Section -->
    <section id="benefits" class="benefits">
        <h2 class="section-title" data-aos="fade-up">Manfaat Utama KastaR</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">Nikmati berbagai keunggulan KastaR yang akan membuat pengelolaan bisnis Anda menjadi lebih efisien.</p>
        
        <div class="container benefits-container">
            <div class="benefit-item" data-aos="fade-up" data-aos-delay="300">
                <div class="benefit-icon">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="benefit-content">
                    <h3>Hemat Waktu & Tenaga</h3>
                    <p>Proses transaksi yang cepat memungkinkan Anda melayani lebih banyak pelanggan dalam waktu yang sama.</p>
                </div>
            </div>
            <div class="benefit-item" data-aos="fade-up" data-aos-delay="400">
                <div class="benefit-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="benefit-content">
                    <h3>Kelola Pelanggan</h3>
                    <p>Fitur database pelanggan membantu Anda membangun hubungan yang lebih baik dengan meningkatkan loyalitas.</p>
                </div>
            </div>
            <div class="benefit-item" data-aos="fade-up" data-aos-delay="500">
                <div class="benefit-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="benefit-content">
                    <h3>Manajemen Stok Otomatis</h3>
                    <p>Pembaruan stok otomatis setiap kali transaksi terjadi membantu mencegah kehabisan stok atau overstocking.</p>
                </div>
            </div>
            <div class="benefit-item" data-aos="fade-up" data-aos-delay="600">
                <div class="benefit-icon">
                    <i class="bi bi-headset"></i>
                </div>
                <div class="benefit-content">
                    <h3>Dukungan Responsif</h3>
                    <p>Tim dukungan pelanggan kami siap membantu Anda 7 hari seminggu untuk memastikan bisnis berjalan lancar.</p>
                </div>
            </div>
            <div class="benefit-item" data-aos="fade-up" data-aos-delay="700">
                <div class="benefit-icon">
                    <i class="bi bi-cash-coin"></i>
                </div>
                <div class="benefit-content">
                    <h3>Harga Terjangkau</h3>
                    <p>Paket berlangganan yang fleksibel dan terjangkau untuk semua ukuran bisnis tanpa biaya tersembunyi.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- How It Works -->
    <section id="how" class="how-it-works">
        <h2 class="section-title" data-aos="fade-up">Cara Kerja KastaR</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">Mulai menggunakan KastaR dengan 4 langkah mudah berikut ini.</p>
        
        <div class="steps">
            <div class="step" data-aos="fade-up" data-aos-delay="300">
                <div class="step-number">1</div>
                <h3>Beli Aplikasi</h3>
                <p>Hubungi CS untuk mendapatkan lisensi KastaR sesuai dengan kebutuhan bisnis Anda.</p>
            </div>
            <div class="step" data-aos="fade-up" data-aos-delay="400">
                <div class="step-number">2</div>
                <h3>Sesuaikan Pengaturan</h3>
                <p>Masukkan data produk, kategori, harga, dan informasi bisnis lainnya sesuai kebutuhan Anda.</p>
            </div>
            <div class="step" data-aos="fade-up" data-aos-delay="500">
                <div class="step-number">3</div>
                <h3>Mulai Transaksi</h3>
                <p>Mulai mencatat transaksi penjualan dengan mudah melalui antarmuka yang intuitif dan ramah pengguna.</p>
            </div>
            <div class="step" data-aos="fade-up" data-aos-delay="600">
                <div class="step-number">4</div>
                <h3>Analisis & Kembangkan</h3>
                <p>Pantau dan analisis laporan bisnis untuk mengambil keputusan strategis Anda.</p>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section id="contact" class="cta">
        <h2 data-aos="fade-up">Siap Meningkatkan Bisnis Anda?</h2>
        <p data-aos="fade-up" data-aos-delay="200">Bergabunglah dengan ribuan pemilik bisnis yang telah berhasil mengoptimalkan operasional mereka dengan KastaR. Mulai sekarang dan rasakan perbedaannya!</p>
        <a href="#" class="btn btn-white" data-aos="fade-up" data-aos-delay="400">Daftar Sekarang untuk Uji Coba Gratis 14 Hari!</a>
    </section>
    
    <!-- Footer Section -->
    <footer id="footer" class="py-5 bg-dark text-white">
        <div class="container">
            <div class="row gy-4">

                <!-- About Us -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="footer-about">
                        <a href="#" class="logo d-flex align-items-center">
                            <img src="{{ asset('land_style/img/logo-white.svg') }}" alt="KastaR Logo">
                            <h1 class="sitename ms-3 text-light fs-4">KastaR</h1>
                        </a>
                        <p class="mt-3">
                            KastaR adalah solusi kasir pintar yang dirancang untuk membantu bisnis Anda tumbuh lebih cepat dengan teknologi terkini.
                        </p>
                        <div class="social-links mt-3">
                            <a href="https://instagram.com/damarsyahada" class="text-light me-2"><i class="bi bi-instagram fs-4"></i></a>
                            <a href="https://www.youtube.com/@damarsyahada" class="text-light me-2"><i class="bi bi-youtube fs-4"></i></a>
                            <a href="HTTPS://linkedin.com/in/damarsyahada" class="text-light"><i class="bi bi-linkedin fs-4"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <h5 class="mb-4 fw-bold text-light">Tautan Cepat</h5>
                    <ul class="list-unstyled fast-links">
                        <li><a href="#home">Beranda</a></li>
                        <li><a href="#features">Fitur Unggulan</a></li>
                        <li><a href="#benefits">Keunggulan</a></li>
                        <li><a href="#how">Cara Kerja</a></li>
                        <li><a href="#contact">Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <h5 class="mb-4 fw-bold text-light">Kontak Kami</h5>
                    <p class="mb-2"><i class="bi bi-geo-alt me-2"></i> Jl. Hercules IV No.123, Kab. Bandung</p>
                    <p class="mb-2"><i class="bi bi-envelope me-2"></i> support@kastar.com</p>
                    <p class="mb-2"><i class="bi bi-phone me-2"></i> +62 812-3456-7890</p>
                </div>

                <!-- Newsletter -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <h5 class="mb-4 fw-bold text-light">Berlangganan</h5>
                    <p>Dapatkan update terbaru langsung ke email Anda.</p>
                    <form action="#" class="d-flex">
                        <input type="email" class="form-control me-2" placeholder="Masukkan email Anda" required>
                        <button type="submit" class="btn btn-primary">Langganan</button>
                    </form>
                </div>

            </div>

            <!-- Copyright -->
            <div class="footer-copyright text-center mt-5">
                <p>&copy; 2025 <strong>KastaR</strong>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('land_style/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('land_style/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('land_style/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('land_style/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('land_style/js/main.js') }}"></script>
</body>
</html>