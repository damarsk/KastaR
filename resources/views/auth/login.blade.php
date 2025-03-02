<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KastaR - Login</title>
    <link href="{{ asset('land_style/img/logo-circle.png') }}" rel="icon"  type="image/x-icon">
    <link href="{{ asset('auth_style/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('auth_style/css/font-awesome/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('auth_style/css/toast/notyf.min.css') }}" rel="stylesheet">
    <link href="{{ asset('auth_style/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('auth_style/css/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('auth_style/css/font/poppins.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center login-container" style="min-height: 100vh;">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10">
                <div class="card" data-aos="fade-up" data-aos-duration="800">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body">
                                <div class="back-btn">
                                    <a href="{{ route('home') }}" class="btn btn-light mb-4">
                                        <i class="fas fa-arrow-left me-2"></i> Kembali
                                    </a>
                                </div>

                                <div class="logo-container text-center">
                                    <img src="{{ asset('land_style/img/logo.svg') }}" class="logo-img" alt="KastaR Logo">
                                    <h3 class="brand-title mt-3">KastaR | Kasir Pintar</h3>
                                </div>

                                <!-- Error Handling -->
                                @if ($errors->any())
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var notyf = new Notyf({
                                                duration: 5000,
                                                position: {
                                                    x: 'right',
                                                    y: 'top',
                                                },
                                                dismissible: true
                                            });
                                            
                                            @foreach ($errors->all() as $error)
                                                notyf.error("{{ $error }}");
                                            @endforeach
                                        });
                                    </script>
                                @endif

                                <h4 class="mb-4 text-center">Selamat Datang</h4>
                                <p class="text-muted text-center mb-4">Silakan masuk untuk melanjutkan</p>

                                <form method="POST" action="{{ route('auth.store') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label" for="email">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" id="form2Example11" name="email" class="form-control"
                                                placeholder="Masukkan email Anda" autocomplete="email" required autofocus />
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" id="form2Example22" name="password" class="form-control"
                                                placeholder="Masukkan password Anda" autocomplete="current-password" required />
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 mb-4">
                                        <button class="btn btn-primary" type="submit">
                                            Masuk <i class="fas fa-sign-in-alt ms-2"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-md-block gradient-custom right-panel">
                            <div class="h-100 d-flex align-items-center">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Kami Lebih Dari Sekedar Perusahaan</h4>
                                    <p class="mb-0">Kami berkomitmen untuk memberikan solusi inovatif yang memenuhi kebutuhan pelanggan kami. Dengan tim yang berpengalaman dan dedikasi tinggi, kami berusaha untuk menciptakan nilai tambah dan pengalaman terbaik bagi setiap klien.</p>
                                    <div class="mt-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-check-circle me-3"></i>
                                            <span>Solusi kasir modern untuk bisnis Anda</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-check-circle me-3"></i>
                                            <span>Mudah digunakan dan diintegrasikan</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-check-circle me-3"></i>
                                            <span>Dukungan 24/7 untuk semua pengguna</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('auth_style/js/aos/aos.js') }}"></script>
    <script src="{{ asset('auth_style/js/toast/notyf.min.js') }}"></script>
    <script src="{{ asset('auth_style/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('auth_style/js/font-awesome/all.min.js') }}"></script>
    <script src="{{ asset('auth_style/js/main.js') }}"></script>
</body>

</html>