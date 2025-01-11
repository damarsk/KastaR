@extends('layouts.app')
@section('title', 'KastaR - Login')
@section('styles')
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <style>
        .gradient-custom {
            background: linear-gradient(135deg, #5fb2ff, #5d5beb);
        }

        .container {
            height: 100vh;
        }
    </style>
    <link href="{{ asset('land_css/vendor/aos/aos.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="gradient-form" style="background-color: #eee;">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row d-flex justify-content-center align-items-center" data-aos="fade-down" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="{{ asset('land_css/img/logo.png') }}" style="width: 145px;"
                                            alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">KastaR | Kasir Pintar</h4>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger" style="padding-bottom: 0px;">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form class="md-form" method="POST" action="{{ route('auth.store') }}">  
                                        @csrf  
                                        <div class="form-outline mb-4">  
                                            <label class="form-label" for="email">Email</label>  
                                            <input type="email" id="form2Example11" name="email" class="form-control"  
                                                placeholder="Enter your Email" required />  
                                        </div>  
                                      
                                        <div class="form-outline mb-4">  
                                            <label class="form-label" for="password">Password</label>  
                                            <input type="password" id="form2Example22" name="password" class="form-control"  
                                                placeholder="Enter your Password" required />  
                                        </div>  
                                      
                                        <div class="form-check mb-4">  
                                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" />  
                                            <label class="form-check-label" for="rememberMe">Remember me</label>  
                                        </div>  
                                      
                                        <div class="text-center pt-1 mb-5 pb-1">  
                                            <button class="btn btn-primary btn-block w-100 fa-lg mb-3"  
                                                type="submit">Masuk</button>  
                                        </div>  
                                    </form>                                      
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">We are more than just a company</h4>
                                    <p class="small mb-0">Kami berkomitmen untuk memberikan solusi inovatif yang memenuhi
                                        kebutuhan pelanggan kami. Dengan tim yang berpengalaman dan dedikasi tinggi, kami
                                        berusaha untuk menciptakan nilai tambah dan pengalaman terbaik bagi setiap klien.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('land_css/vendor/aos/aos.js') }}"></script>
    <script>
        AOS.init();
    </script>
@endsection
