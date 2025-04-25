@extends('layouts.app')
@section('title', 'KastaR - Laporan Pendapatan')
@section('styles')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dash_style/css/bootstrap/bootstrap-datepicker.min.css') }}">
    <style>
        .datepicker.datepicker-dropdown {
            width: 250px;
            font-size: 14px;
        }

        .datepicker-dropdown .datepicker-days {
            width: 100%;
        }

        .datepicker-dropdown .datepicker-days table.table-condensed {
            width: 100%;
        }

        .datepicker-dropdown .datepicker-days table.table-condensed th,
        .datepicker-dropdown .datepicker-days table.table-condensed td {
            height: 30px;
            vertical-align: middle;
            text-align: center;
            font-size: 14px;
        }

        .datepicker-dropdown .datepicker-months table.table-condensed td,
        .datepicker-dropdown .datepicker-months table.table-condensed th {
            height: 40px;
            vertical-align: middle;
            text-align: center;
            font-size: 14px;
        }

        .datepicker-dropdown .datepicker-title {
            font-size: 16px;
            padding: 8px;
        }

        .datepicker-dropdown .datepicker-switch {
            font-size: 16px;
        }

        .datepicker-dropdown .prev,
        .datepicker-dropdown .next {
            font-size: 16px;
        }
    </style>
@endsection

@section('content')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
                @includeIf('layouts.breadcrumb')
                <h4 class="c-grey-900 mT-10 mB-30">Laporan Pendapatan {{ tanggal_indonesia($tanggalAwal, false) }} s/d
                    {{ tanggal_indonesia($tanggalAkhir, false) }}</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20" style="float: left">Tabel Laporan</h4>
                            <div class="btn-group" style="float: right;">
                                <button onclick="updatePeriode()"
                                    class="btn cur-p btn-info btn-color btn-sm"><i class="fa fa-plus"></i> Ubah
                                    Periode</button>
                                <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank"
                                    class="btn cur-p btn-success btn-color btn-sm"><i class="fa fa-file-excel-o"></i> Export PDF</a>
                            </div>
                            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <th style="width: 5%">No</th>
                                    <th>Tanggal</th>
                                    <th>Penjualan</th>
                                    <th>Pembelian</th>
                                    <th>Pengeluaran</th>
                                    <th>Pendapatan</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @includeIf('laporan.form')
@endsection

@section('scripts')
    <script src="{{ asset('js-lib/jquery.min.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    {{-- <script src="{{ asset('js-lib/validator.min.js') }}"></script> --}}
    <script src="{{ asset('dash_style/js/bootstrap/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('dash_style/js/bootstrap/bootstrap-datepicker.id.min.js') }}"></script>
    <script>
        let table;

        $(function() {
            table = $('#dataTable').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal'
                    },
                    {
                        data: 'penjualan'
                    },
                    {
                        data: 'pembelian'
                    },
                    {
                        data: 'pengeluaran'
                    },
                    {
                        data: 'pendapatan'
                    },
                ],
                dom: 'Brt',
                bSort: false,
                bPaginate: false,
            });
        });

        function updatePeriode() {
            $('#modal-form').modal('show');
        }

        $('.datepicker').datepicker({
            language: 'id',
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

    </script>
@endsection
