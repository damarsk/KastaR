@extends('layouts.app')
@section('title', 'TokoRetail - Penjualan')
@section('styles')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('content')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <h4 class="c-grey-900">Transaksi Penjualan</h4>
            <div class="container-fluid bgc-white p-20">
                <div class="alert alert-success alert-dismissible mB-30">
                    <i class="fa fa-check me-2"></i><span>Data Transaksi telah selesai.</span>
                </div>
                <div class="footer">
                    @if ($setting->tipe_nota == '1')
                        <button class="btn btn-secondary" onclick="notaKecil('{{ route('transaksi.nota_kecil') }}', 'Nota Kecil')">Cetak Ulang Nota</button>
                    @else
                        <button class="btn btn-secondary" onclick="notaBesar('{{ route('transaksi.nota_besar') }}', 'Nota PDF')">Cetak Ulang Nota</button>
                    @endif
                    <a href="{{ route('transaksi.baru') }}" class="btn btn-primary">Transaksi Baru</a>
                </div>
            </div>
        </div>
    </main>
    @includeIf('penjualan.detail')
@endsection

@section('scripts')
    <script src="{{ asset('js-lib/jquery.min.js') }}"></script>
    <script>
        function notaKecil(url, title) {
            popupCenter(url, title, 625, 500);
        }

        function notaBesar(url, title) {
            popupCenter(url, title, 900, 675);
        }

        function popupCenter(url, title, w, h) {
            const dualScreenLeft = window.screenLeft !==  undefined   ? window.screenLeft : window.screenX;
            const dualScreenTop  = window.screenTop  !==  undefined   ? window.screenTop  : window.screenY;

            const width  = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
            const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

            const systemZoom = width / window.screen.availWidth;
            const left       = (width - w) / 2 / systemZoom + dualScreenLeft
            const top        = (height - h) / 2 / systemZoom + dualScreenTop
            const newWindow  = window.open(url, title, 
            `
            scrollbars=yes,
            width   = ${w / systemZoom}, 
            height  = ${h / systemZoom}, 
            top     = ${top}, 
            left    = ${left}
            `
            )

            if (window.focus) newWindow.focus();
        }
    </script>
@endsection
