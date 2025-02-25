<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('land_style/img/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    @yield('styles')
    <style>
        #loader {
            transition: all .3s ease-in-out;
            opacity: 1;
            visibility: visible;
            position: fixed;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 90000;
        }

        #loader.fadeOut {
            opacity: 0;
            visibility: hidden;
        }

        .spinner {
            width: 40px;
            height: 40px;
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1s infinite ease-in-out;
            animation: sk-scaleout 1s infinite ease-in-out;
        }

        .sidebar-menu .dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            display: block !important;
            padding: 0;
        }

        .sidebar-menu li.dropdown.open>.dropdown-menu {
            max-height: 1000px;
            /* Large enough to contain content */
            transition: max-height 0.5s ease-in;
        }

        .sidebar-menu .dropdown-menu>li>a {
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        .sidebar-menu li.dropdown.open>.dropdown-menu>li>a {
            transform: translateX(0);
        }

        /* Add transition delay for each item */
        .sidebar-menu .dropdown-menu>li:nth-child(1)>a {
            transition-delay: 0.1s;
        }

        .sidebar-menu .dropdown-menu>li:nth-child(2)>a {
            transition-delay: 0.15s;
        }

        .sidebar-menu .dropdown-menu>li:nth-child(3)>a {
            transition-delay: 0.2s;
        }

        .sidebar-menu .dropdown-menu>li:nth-child(4)>a {
            transition-delay: 0.25s;
        }

        .sidebar-menu .dropdown-menu>li:nth-child(5)>a {
            transition-delay: 0.3s;
        }

        .arrow i {
            transition: transform 0.3s ease;
        }

        .arrow i.rotate-90 {
            transform: rotate(90deg);
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
            }

            100% {
                -webkit-transform: scale(1);
                opacity: 0;
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                opacity: 0;
            }
        }
    </style>
    <link href="{{ asset('dash_style/css/style.css') }}" rel="stylesheet">
</head>

<body class="app font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <div id="loader">
            <div class="spinner"></div>
        </div>
        <script>
            window.addEventListener("load", function() {
                const loader = document.getElementById("loader");
                setTimeout(function() {
                    loader.classList.add("fadeOut");
                }, 300);
            });
        </script>
        <div>
            <!-- #Left Sidebar ==================== -->
            <div class="sidebar">
                <div class="sidebar-inner">
                    <!-- ### $Sidebar Header ### -->
                    <div class="sidebar-logo">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer peer-greed">
                                <a class="sidebar-link td-n" href="{{ route('dashboard.index') }}">
                                    <div class="peers ai-c fxw-nw">
                                        <div class="peer">
                                            <div class="logo d-flex justify-content-center align-items-center">
                                                <img src="{{ asset('land_style/img/logo.png') }}" alt="Logo"
                                                    width="70px">
                                            </div>
                                        </div>
                                        <div class="peer peer-greed">
                                            <h5 class="lh-1 mB-0 logo-text">KastaR Dashboard</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="peer">
                                <div class="mobile-toggle sidebar-toggle">
                                    <a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ### $Sidebar Menu ### -->
                    <ul class="sidebar-menu scrollable pos-r">
                        <li class="nav-item mT-30 actived">
                            <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                                <span class="icon-holder"><i class="c-grey-900 ti-home"></i></span>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        @if (Auth::user()->level == 1 || Auth::user()->level == 2)
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle" href="javascript:void(0);">
                                    <span class="icon-holder"><i class="c-green-500 ti-money"></i></span>
                                    <span class="title">Transaksi</span>
                                    <span class="arrow"><i class="ti-angle-right"></i></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="sidebar-link" href="{{ route('pengeluaran.index') }}">
                                            <i class="c-green-500 ti-money me-2"></i>
                                            Pengeluaran
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidebar-link" href="{{ route('pembelian.index') }}">
                                            <i class="c-green-500 ti-download me-2"></i>
                                            Pembelian
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidebar-link" href="#">
                                            <i class="c-green-500 ti-upload me-2"></i>
                                            Penjualan
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidebar-link" href="{{ route('transaksi.index') }}">
                                            <i class="c-green-500 ti-shopping-cart me-2"></i>
                                            Transaksi Lama
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidebar-link" href="{{ route('transaksi.baru') }}">
                                            <i class="c-green-500 ti-shopping-cart me-2"></i>
                                            Transaksi Aktif
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="sidebar-link" href="charts.html">
                                    <span class="icon-holder"><i class="c-indigo-500 ti-bar-chart"></i></span>
                                    <span class="title">Analisis</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="sidebar-link" href="{{ route('kategori.index') }}">
                                    <span class="icon-holder"><i class="c-brown-600 ti-package"></i></span>
                                    <span class="title">Kategori</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="sidebar-link" href="{{ route('produk.index') }}">
                                    <span class="icon-holder"><i class="c-green-300 ti-dropbox"></i></span>
                                    <span class="title">Produk</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle" href="javascript:void(0);">
                                    <span class="icon-holder"><i class="c-blue-500 ti-id-badge"></i></span>
                                    <span class="title">Users</span>
                                    <span class="arrow"><i class="ti-angle-right"></i></span>
                                </a>
                                <ul class="dropdown-menu">
                                    @if (Auth::user()->level == 2)
                                        <li>
                                            <a class="sidebar-link" href="{{ route('admin.index') }}">
                                                <i class="c-blue-500 ti-user me-2"></i>
                                                Manage Admin
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="sidebar-link" href="{{ route('supplier.index') }}">
                                            <i class="c-blue-500 ti-user me-2"></i>
                                            Manage Supplier
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidebar-link" href="{{ route('member.index') }}">
                                            <i class="c-blue-500 ti-user me-2"></i>
                                            Manage Member
                                        </a>
                                    <li>
                                        <a class="sidebar-link" href="{{ route('kasir.index') }}">
                                            <i class="c-blue-500 ti-user me-2"></i>
                                            Manage Kasir
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->level == 0)
                            <li class="nav-item"><a class="sidebar-link" href="index.html"><span
                                        class="icon-holder"><i class="c-green-500 ti-shopping-cart-full"></i>
                                    </span><span class="title">Transaksi Baru</span></a></li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder"><i class="c-grey-700 ti-user"></i></span>
                                <span class="title">Profile</span>
                                <span class="arrow"><i class="ti-angle-right"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="sidebar-link" href="basic-table.html">
                                        <i class="c-grey-800 ti-settings me-2"></i> Settings
                                    </a>
                                </li>
                                <li>
                                    <a class="sidebar-link" href="javascript:void(0);"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="c-red-500 ti-back-left me-2"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- #Main ============================ -->
            <div class="page-container">
                <!-- ### $Topbar ### -->
                <div class="header navbar">
                    <div class="header-container">
                        <ul class="nav-left">
                            <li>
                                <a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);">
                                    <i class="ti-menu"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="notifications dropdown">
                                <span class="counter bgc-red">3</span>
                                <a href="" class="dropdown-toggle no-after" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-bell"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li class="pX-20 pY-15 bdB">
                                        <i class="ti-bell pR-10"></i>
                                        <span class="fsz-sm fw-600 c-grey-900">Notifications</span>
                                    </li>
                                    <li>
                                        <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
                                            <li>
                                                <a href=""
                                                    class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                    <div class="peer mR-15">
                                                        <img class="w-3r bdrs-50p"
                                                            src="https://randomuser.me/api/portraits/men/1.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="peer peer-greed">
                                                        <span>
                                                            <span class="fw-500">John Doe</span>
                                                            <span class="c-grey-600">liked your <span
                                                                    class="text-dark">post</span></span>
                                                        </span>
                                                        <p class="m-0"><small class="fsz-xs">5 mins ago</small></p>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href=""
                                                    class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                    <div class="peer mR-15">
                                                        <img class="w-3r bdrs-50p"
                                                            src="https://randomuser.me/api/portraits/men/2.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="peer peer-greed">
                                                        <span>
                                                            <span class="fw-500">Moo Doe</span>
                                                            <span class="c-grey-600">liked your <span
                                                                    class="text-dark">cover image</span></span>
                                                        </span>
                                                        <p class="m-0"><small class="fsz-xs">7 mins ago</small></p>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href=""
                                                    class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                    <div class="peer mR-15">
                                                        <img class="w-3r bdrs-50p"
                                                            src="https://randomuser.me/api/portraits/men/3.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="peer peer-greed">
                                                        <span>
                                                            <span class="fw-500">Lee Doe</span>
                                                            <span class="c-grey-600">commented on your <span
                                                                    class="text-dark">video</span></span>
                                                        </span>
                                                        <p class="m-0"><small class="fsz-xs">10 mins ago</small>
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="pX-20 pY-15 ta-c bdT">
                                        <span>
                                            <a href="" class="c-grey-600 cH-blue fsz-sm td-n">
                                                View All Notifications <i class="ti-angle-right fsz-xs mL-10"></i>
                                            </a>
                                        </span>
                                    </li>
                                </ul>
                            </li>
                            <li class="notifications dropdown">
                                <span class="counter bgc-blue">3</span>
                                <a href="" class="dropdown-toggle no-after" data-bs-toggle="dropdown">
                                    <i class="ti-email"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="pX-20 pY-15 bdB">
                                        <i class="ti-email pR-10"></i>
                                        <span class="fsz-sm fw-600 c-grey-900">Emails</span>
                                    </li>
                                    <li>
                                        <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
                                            <li>
                                                <a href=""
                                                    class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                    <div class="peer mR-15">
                                                        <img class="w-3r bdrs-50p"
                                                            src="https://randomuser.me/api/portraits/men/1.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="peer peer-greed">
                                                        <div>
                                                            <div class="peers jc-sb fxw-nw mB-5">
                                                                <div class="peer">
                                                                    <p class="fw-500 mB-0">John Doe</p>
                                                                </div>
                                                                <div class="peer"><small class="fsz-xs">5 mins
                                                                        ago</small></div>
                                                            </div>
                                                            <span class="c-grey-600 fsz-sm">Want to create your own
                                                                customized data generator for your app...</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href=""
                                                    class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                    <div class="peer mR-15">
                                                        <img class="w-3r bdrs-50p"
                                                            src="https://randomuser.me/api/portraits/men/2.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="peer peer-greed">
                                                        <div>
                                                            <div class="peers jc-sb fxw-nw mB-5">
                                                                <div class="peer">
                                                                    <p class="fw-500 mB-0">Moo Doe</p>
                                                                </div>
                                                                <div class="peer"><small class="fsz-xs">15 mins
                                                                        ago</small></div>
                                                            </div>
                                                            <span class="c-grey-600 fsz-sm">Want to create your own
                                                                customized data generator for your app...</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href=""
                                                    class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                    <div class="peer mR-15">
                                                        <img class="w-3r bdrs-50p"
                                                            src="https://randomuser.me/api/portraits/men/3.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="peer peer-greed">
                                                        <div>
                                                            <div class="peers jc-sb fxw-nw mB-5">
                                                                <div class="peer">
                                                                    <p class="fw-500 mB-0">Lee Doe</p>
                                                                </div>
                                                                <div class="peer"><small class="fsz-xs">25 mins
                                                                        ago</small></div>
                                                            </div>
                                                            <span class="c-grey-600 fsz-sm">Want to create your own
                                                                customized data generator for your app...</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="pX-20 pY-15 ta-c bdT">
                                        <span>
                                            <a href="email.html" class="c-grey-600 cH-blue fsz-sm td-n">
                                                View All Email <i class="fs-xs ti-angle-right mL-10"></i>
                                            </a>
                                        </span>
                                    </li>
                                </ul>
                            </li>
                            <li class="profile-menu">
                                <div class="no-after peers fxw-nw ai-c lh-1 mL-5 mR-10 mT-15">
                                    <div class="peer mR-10">
                                        <img class="w-2r bdrs-50p"
                                            src="{{ Auth::user()->foto ? asset('uploads/photos/' . Auth::user()->foto) : asset('images/unknown-avatar.png') }}"
                                            alt="Foto Profil">
                                    </div>
                                    <div class="peer">
                                        <span class="fsz-sm c-grey-900">{{ Auth::user()->name }}</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ### $App Screen Content ### -->
                <!-- Page Content -->
                <main>
                    @yield('content')
                </main>
                <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                    <span>© KastaR 2025 | All rights reserved.</span>
                </footer>
            </div>
        </div>
        <script defer src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ asset('js-lib/jquery.min.js') }}"></script>
        @yield('scripts')
        <script defer src="{{ asset('dash_style/js/main.js') }}"></script>
    </div>
</body>

</html>
