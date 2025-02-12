@extends('layouts.app')
@section('title', 'KastaR - Pembelian')
@section('styles')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <style>
        .bg-cos1 {
            background: #007ee6 !important;
        }

        .tampil-bayar {
            font-size: 5em;
            text-align: center;
            height: 100px;
        }

        .tampil-terbilang {
            padding: 10px;
            background: #f0f0f0;
        }

        .dataTable tbody tr:last-child {
            display: none;
        }

        @media(max-width: 768px) {
            .tampil-bayar {
                font-size: 3em;
                height: 70px;
                padding-top: 5px;
            }
        }
    </style>
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
                                    <td>: {{ $supplier->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>: {{ $supplier->telepon }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $supplier->alamat }}</td>
                                </tr>
                            </table>
                            <form action="" method="POST" class="form-produk">
                                @csrf
                                <div class="form-group row">
                                    <label for="kode_produk" class="col-lg-2 c-grey-900">Kode Produk</label>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <input type="hidden" name="id_pembelian" id="id_pembelian"
                                                value="{{ $id_pembelian }}">
                                            <input type="hidden" name="id_produk" id="id_produk">
                                            <input type="text" class="form-control" name="kode_produk" id="kode_produk">
                                            <button onclick="tampilProduk()" class="btn btn-secondary text-white"
                                                type="button" id="button-addon2"><i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="dataTable" class="table table-striped table-bordered my-3" cellspacing="0"
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
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="tampil-bayar bg-cos1 text-white">Rp.</div>
                                    <div class="tampil-terbilang">Rp.</div>
                                </div>
                                <div class="col-lg-4">
                                    <form action="{{ route('pembelian.store') }}" class="form-pembelian" method="post">
                                        @csrf
                                        <input type="hidden" name="id_pembelian" value="{{ $id_pembelian }}">
                                        <input type="hidden" name="total" id="total">
                                        <input type="hidden" name="total_item" id="total_item">
                                        <input type="hidden" name="bayar" id="bayar">

                                        <div class="form-group row mb-3">
                                            <label for="totalrp" class="col-lg-2 control-label">Total</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="totalrp" class="form-control" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="diskon" class="col-lg-2 control-label">Diskon</label>
                                            <div class="col-lg-8">
                                                <input type="number" name="diskon" id="diskon" class="form-control"
                                                    value="{{ $diskon }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bayar" class="col-lg-2 control-label">Bayar</label>
                                            <div class="col-lg-8">
                                                <input type="text" id="bayarrp" class="form-control">
                                            </div>
                                        </div>
                                    </form>
                                    <div class="box-footer pt-3">
                                        <button type="submit"
                                            class="btn btn-primary btn-sm pull-right btn-simpan text-white"><i
                                                class="fa fa-floppy-o"></i> Simpan Transaksi</button>
                                    </div>
                                </div>
                            </div>
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
        let tableProduk;

        $(function() {
            table = $('#dataTable').DataTable({
                proccessing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pembelian_detail.data', $id_pembelian) }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_produk'
                    },
                    {
                        data: 'nama_produk'
                    },
                    {
                        data: 'harga_beli'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'subtotal'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false,
                    },
                ],
                dom: 'Brt',
                bSort: false,
            }).on('draw.dt', function() {
                loadForm($('#diskon').val());
            });
            tableProduk = $('#dataProduk').DataTable();

            $(document).on('input', '.quantity', function() {
                let id = $(this).data('id');
                let jumlah = parseInt($(this).val());

                if (jumlah < 1) {
                    $(this).val(1);
                    alert('Jumlah tidak boleh kurang dari 1');
                    return;
                }
                if (jumlah > 10000) {
                    $(this).val(10000);
                    alert('Jumlah tidak boleh lebih dari 10000');
                    return;
                }

                $.post(`{{ route('pembelian_detail.update', '') }}/${id}`, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'put',
                        'jumlah': jumlah
                    })
                    .done(response => {
                        $(this).on('mouseout', function() {
                            table.ajax.reload(() => loadForm($('#diskon').val()));
                        });
                    })
                    .fail(errors => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            });

            $(document).on('input', '#diskon', function() {
                if ($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadForm($(this).val());
            });

            $('.btn-simpan').on('click', function() {
                $('.form-pembelian').submit();
            });
        });

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
            $.post('{{ route('pembelian_detail.store') }}', $('.form-produk').serialize())
                .done((response) => {
                    $('#kode_produk').focus();
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }

        function deleteData(url) {
            event.preventDefault();
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        alert('Data berhasil dihapus');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }

        function loadForm(diskon = 0) {
            $('#total').val($('.total').text());
            $('#total_item').val($('.total_item').text());

            $.get(`{{ url('/dashboard/pembelian_detail/loadform') }}/${diskon}/${$('.total').text()}`)
                .done((response) => {
                    $('#totalrp').val('Rp. ' + response.totalrp);
                    $('#bayarrp').val('Rp. ' + response.bayarrp);
                    $('#bayar').val(response.bayar);
                    $('.tampil-bayar').text('Rp. ' + response.bayarrp);
                    $('.tampil-terbilang').text('Rp. ' + response.terbilang);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
        }
    </script>
@endsection
