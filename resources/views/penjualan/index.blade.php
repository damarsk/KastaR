@extends('layouts.app')
@section('title', 'TokoRetail - Penjualan')
@section('styles')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('content')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
                @includeIf('layouts.breadcrumb')
                <h4 class="c-grey-900 mT-10 mB-30">Manage Penjualan</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20" style="float: left">Tabel Penjualan</h4>
                            <form action="" method="POST" class="form-supplier">
                                @csrf
                                <table id="tabel-detail" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <th style="width: 5%">No</th>
                                        <th>Tanggal</th>
                                        <th>Kode Member</th>
                                        <th>Total Item</th>
                                        <th>Total Harga</th>
                                        <th>Diskon</th>
                                        <th>Total Bayar</th>
                                        <th>Kasir</th>
                                        <th width="10%"><i class="fa fa-cog"></i></th>
                                    </thead>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @includeIf('penjualan.detail')
@endsection

@section('scripts')
    <script src="{{ asset('js-lib/jquery.min.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js-lib/validator.min.js') }}"></script>
    <script>
        let detailTable;
        let detailModalTable;

        $(function() {
            detailTable = $('#tabel-detail').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('penjualan.data') }}',
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
                        data: 'kode_member',
                    },
                    {
                        data: 'total_item'
                    },
                    {
                        data: 'total_harga'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'bayar'
                    },
                    {
                        data: 'kasir'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        orderable: false
                    }
                ]
            });
        });

        $(function() {
            detailModalTable = $('#modalDetailTable').DataTable({
                processing: true,
                bSort: false,
                dom: 'Brt',
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'kode_produk'
                    },
                    {
                        data: 'nama_produk'
                    },
                    {
                        data: 'harga_jual'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'subtotal'
                    },
                ]
            });
        });

        function showDetail(url) {
            event.preventDefault();
            $('#modal-detail').modal('show');
            detailModalTable.ajax.url(url).load();
        }

        function deleteData(url) {
            event.preventDefault();
            if (confirm('Apakah anda yakin ingin menghapus log penjualan ini?')) {
                $.post(url, {
                        '_method': 'delete',
                        '_token': $('meta[name=csrf-token]').attr('content')
                    })
                    .done((response) => {
                        var notyf = new Notyf({
                                duration: 2000,
                                position: {
                                    x: 'right',
                                    y: 'top',
                                },
                                dismissible: true
                            });
                            notyf.success(response);
                        detailTable.ajax.reload();
                    })
                    .fail((errors) => {
                        var notyf = new Notyf({
                                duration: 2000,
                                position: {
                                    x: 'right',
                                    y: 'top',
                                },
                                dismissible: true
                            });
                            notyf.error('Tidak dapat menghapus log penjualan');
                        alert('Tidak dapat menghapus log penjualan');
                        return;
                    });
            }
        }
    </script>
@endsection
