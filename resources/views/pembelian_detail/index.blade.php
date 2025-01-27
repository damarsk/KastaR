@extends('layouts.app')
@section('title', 'KastaR - Pembelian')
@section('styles')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('content')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
                <h4 class="c-grey-900 mT-10 mB-30">Transaksi Pembelian</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <table class="mb-3 c-grey-900">
                                <tr>
                                    <td>Supplier</td>
                                    <td>: {{$supplier->nama}}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>: {{$supplier->telepon}}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{$supplier->alamat}}</td>
                                </tr>
                            </table>
                            <form action="" method="POST" class="form-supplier">
                                @csrf
                                <div class="form-group row">
                                    <label for="kode_produk" class="col-lg-2 c-grey-900">Kode Produk</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                        <input type="hidden" name="id_produk" id="id_produk">
                                        <input type="text" class="form-control" name="kode_produk" id="kode_produk">
                                        <button onclick="tampilProduk()" class="btn btn-secondary text-white" type="button" id="button-addon2"><i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <th style="width: 5%">No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
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
    @includeIf('pembelian_detail.produk')
@endsection

@section('scripts')
    <script src="{{ asset('js-lib/jquery.min.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js-lib/validator.min.js') }}"></script>
    <script>
        let table;

        $(function() {
            // Inisialisasi DataTables  
            table = $('#dataTable').DataTable({
                // processing: true,
                // autoWidth: false,
                // ajax: {
                //     url: '{{ route('supplier.data') }}',
                // },
                // columns: [{
                //         data: 'DT_RowIndex',
                //         orderable: false,
                //         searchable: false
                //     },
                //     {
                //         data: 'nama'
                //     },
                //     {
                //         data: 'telepon'
                //     },
                //     {
                //         data: 'alamat'
                //     },
                //     {
                //         data: 'aksi',
                //         searchable: false
                //     }
                // ]
            });
            table = $('#dataProduk').DataTable({
                // processing: true,
                // autoWidth: false,
                // ajax: {
                //     url: '{{ route('supplier.data') }}',
                // },
                // columns: [{
                //         data: 'DT_RowIndex',
                //         orderable: false,
                //         searchable: false
                //     },
                //     {
                //         data: 'nama'
                //     },
                //     {
                //         data: 'telepon'
                //     },
                //     {
                //         data: 'alamat'
                //     },
                //     {
                //         data: 'aksi',
                //         searchable: false
                //     }
                // ]
            });
        });

        // Fungsi untuk menampilkan modal tambah form    
        function tampilProduk() {
            $('#modal-produk').modal('show');
        }

        function pilihProduk(id, kode) {
            $('#id_produk').val(id);
            $('#kode_produk').val(kode);
            $('#modal-produk').modal('hide');
            tambahProduk();
        } 

        function tambahProduk() {
            
        }

        function deleteData(url) {
            if (confirm('Apakah anda yakin ingin menghapus supplier ini?')) {
                $.post(url, {
                        '_method': 'delete',
                        '_token': $('meta[name=csrf-token]').attr('content')
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus supplier');
                        return;
                    });
            }
        }
    </script>
@endsection
