@extends('layouts.app')
@section('title', 'KastaR - Produk')
@section('styles')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('content')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
                <h4 class="c-grey-900 mT-10 mB-30">Manage Produk</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20" style="float: left">Tabel Produk</h4>
                            <div class="btn-group" style="float: right; margin-bottom: 10px;">
                                <button onclick="addForm('{{ route('produk.store') }}')"
                                    class="btn cur-p btn-success btn-color btn-sm"><i class="fa fa-plus"></i> Tambah
                                    Produk</button>
                                <button onclick="deleteSelected(' {{ route('produk.deleteSelected') }} ')"
                                    class="btn cur-p btn-danger btn-color btn-sm"><i class="fa fa-trash"></i> Hapus
                                    Produk</button>
                            </div>
                            <form action="" method="POST" class="form-produk">
                                @csrf
                                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <th><input type="checkbox" name="select_all" id="select_all"></th>
                                        <th style="width: 5%">No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Merk</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Diskon</th>
                                        <th>Stok</th>
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
    {{-- @includeIf('produk.form') --}}
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
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('kasir.index') }}',
                },
                columns: [{
                        data: 'select_all',
                        orderable: false,
                        searchable: false
                    },
                    {
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
                        data: 'nama_kategori'
                    },
                    {
                        data: 'merk'
                    },
                    {
                        data: 'harga_beli'
                    },
                    {
                        data: 'harga_jual'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'stok'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#modal-form').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                        .done((response) => {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak dapat menyimpan data');
                            return;
                        });
                }
            });

            $('[name=select_all]').on('click', function() {
                $('input[type="checkbox"]').prop('checked', this.checked);
            });
        });

        // Fungsi untuk menampilkan modal tambah form  
        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Produk');
            $('#modal-form form').get(0).reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');

            // Tambahkan event listener untuk fokus setelah modal ditampilkan  
            $('#modal-form').on('shown.bs.modal', function() {
                $('#modal-form [name=nama_produk]').focus();
            });
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Produk');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama_produk]').focus();

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama_produk]').val(response.nama_produk);
                    $('#modal-form [name=id_kategori]').val(response.id_kategori);
                    $('#modal-form [name=merk]').val(response.merk);
                    $('#modal-form [name=harga_beli]').val(response.harga_beli);
                    $('#modal-form [name=harga_jual]').val(response.harga_jual);
                    $('#modal-form [name=diskon]').val(response.diskon);
                    $('#modal-form [name=stok]').val(response.stok);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
        }

        function deleteData(url) {
            if (confirm('Apakah anda yakin ingin menghapus produk ini?')) {
                $.post(url, {
                        '_method': 'delete',
                        '_token': $('meta[name=csrf-token]').attr('content')
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus produk');
                        return;
                    })
            }
        }

        function deleteSelected(url) {
            if ($('input:checked').length > 0) {
                if (confirm('Apakah anda yakin ingin menghapus produk ini?')) {
                    $.post(url, $('.form-produk').serialize())
                        .done((response) => {
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak dapat menghapus produk');
                            return;
                        })
                }
            } else {
                alert('Pilih data yang akan dihapus');
                return;
            }
        }
    </script>
@endsection
