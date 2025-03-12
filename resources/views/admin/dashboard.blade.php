@extends('layouts.app')
@section('title', 'KastaR - Dashboard')
@section('content')
@section('styles')
    <style>
        .head {
            font-weight: 600;
        }

        #fa-xl {
            font-size: 60px;
        }

        .bd-lihat {
            border-right: 1px solid rgba(0, 0, 0, .063) !important;
            border-left: 1px solid rgba(0, 0, 0, .063) !important;
            border-bottom: 1px solid rgba(0, 0, 0, .063) !important;
        }

        @media (min-width: 768px) and (max-width: 900px) {
            #fa-xl {
                font-size: 30px;
            }
        }
    </style>
@endsection
<main class="main-content bgc-grey-100">
    @includeIf('layouts.breadcrumb')
    <div id="mainContent">
        <h2>👋 Halo, {{ Auth::user()->name }}!</h2>
        <div class="row gap-20 masonry pos-r">
            <div class="masonry-item w-100">
                <div class="row gap-20">
                    <div class="col-md-3">
                        <div class="d-flex justify-content-start bd bgc-white p-20">
                            <div class="layer mB-10">
                                <h2 class="head">{{ $kategori }}</h2>
                                <h6 class="lh-1">Total Kategori</h6>
                            </div>
                            <div class="layer d-flex justify-content-end align-items-center" style="flex: auto;">
                                <i id="fa-xl" class="ti-package"></i>
                            </div>
                        </div>
                        <div class="bd-lihat d-flex justify-content-center align-items-center bgc-grey-200 w-100">
                            <a class="c-grey-700" href="{{ route('kategori.index') }}">Lihat <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex justify-content-start bd bgc-white p-20">
                            <div class="layer mB-10">
                                <h2 class="head">{{ $produk }}</h2>
                                <h6 class="lh-1">Total Produk</h6>
                            </div>
                            <div class="layer d-flex justify-content-end align-items-center" style="flex: auto;">
                                <i id="fa-xl" class="ti-archive"></i>
                            </div>
                        </div>
                        <div class="bd-lihat d-flex justify-content-center align-items-center bgc-grey-200 w-100">
                            <a class="c-grey-700" href="{{ route('produk.index') }}">Lihat <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex justify-content-start bd bgc-white p-20">
                            <div class="layer mB-10">
                                <h2 class="head">{{ $member }}</h2>
                                <h6 class="lh-1">Total Member</h6>
                            </div>
                            <div class="layer d-flex justify-content-end align-items-center" style="flex: auto;">
                                <i id="fa-xl" class="ti-id-badge"></i>
                            </div>
                        </div>
                        <div class="bd-lihat d-flex justify-content-center align-items-center bgc-grey-200 w-100">
                            <a class="c-grey-700" href="{{ route('member.index') }}">Lihat <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex justify-content-start bd bgc-white p-20">
                            <div class="layer mB-10">
                                <h2 class="head">{{ $supplier }}</h2>
                                <h6 class="lh-1">Total Supplier</h6>
                            </div>
                            <div class="layer d-flex justify-content-end align-items-center" style="flex: auto;">
                                <i id="fa-xl" class="ti-truck"></i>
                            </div>
                        </div>
                        <div class="bd-lihat d-flex justify-content-center align-items-center bgc-grey-200 w-100">
                            <a class="c-grey-700" href="{{ route('supplier.index') }}">Lihat <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="masonry-item col-12">
                <a class="weatherwidget-io" href="https://forecast7.com/en/n0d79113d92/indonesia/"
                    data-label_1="INDONESIA" data-label_2="WEATHER" data-theme="clear">INDONESIA WEATHER</a>
            </div>
            <div class="masonry-item col-12">
                <div class="bd bgc-white">
                    <div class="layers">
                        <div class="layer w-100 pX-20 pT-20">
                            <h6 class="lh-1">Grafik Pendapatan {{ tanggal_indonesia($tanggal_awal, false) }} s/d
                                {{ tanggal_indonesia($tanggal_akhir, false) }}</h6>
                        </div>
                        <div class="layer w-100 p-20">
                            <canvas id="line-chart" height="320"></canvas>
                        </div>
                        <div class="layer bdT p-20 w-100">
                            <div class="peers ai-c jc-c gapX-20">
                                <div class="peer fw-600">
                                    <span class="fsz-def fw-600 mR-10 c-grey-800">{{ number_format($profit_percentage, 2) }}%
                                        <i class="fa {{ $icon_profit }}"></i></span>
                                    <small class="c-grey-500 fw-600">Profit</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- ### $App Screen Footer ### -->

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        if (!$('#weatherwidget-io-js').length) {
            $.getScript('https://weatherwidget.io/js/widget.min.js');
        }

        const ctx = $('#line-chart')[0].getContext('2d');
        const lineChart = new Chart(ctx, {
            type: 'line',

            data: {
                labels: {{ json_encode($data_tanggal) }},
                datasets: [{
                    label: 'Pendapatan',
                    data: {{ json_encode($data_pendapatan) }},
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Menjaga rasio aspek
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
