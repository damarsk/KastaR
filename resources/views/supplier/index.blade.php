@extends('layouts.app')
@section('title', 'KastaR - Supplier')
@section('styles')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('content')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
                <h4 class="c-grey-900 mT-10 mB-30">Manage Supplier</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20" style="float: left">Tabel Supplier</h4>
                            <div class="btn-group" style="float: right; margin-bottom: 10px;">
                                <button onclick="addForm('{{ route('supplier.store') }}')"
                                    class="btn cur-p btn-success btn-color btn-sm"><i class="fa fa-plus"></i> Tambah
                                    Supplier</button>
                            </div>
                            <form action="" method="POST" class="form-supplier">
                                @csrf
                                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <th style="width: 5%">No</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
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
    @includeIf('supplier.form')
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
                    url: '{{ route('supplier.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'telepon'
                    },
                    {
                        data: 'alamat'
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
            $('#modal-form .modal-title').text('Tambah Supplier');
            $('#modal-form form').get(0).reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');

            // Tambahkan event listener untuk fokus setelah modal ditampilkan    
            $('#modal-form').on('shown.bs.modal', function() {
                $('#modal-form [name=nama_supplier]').focus();
            });
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Supplier'); // Ubah judul menjadi 'Edit Supplier'  
            $('#modal-form form').get(0).reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');

            // Tambahkan event listener untuk fokus setelah modal ditampilkan    
            $('#modal-form').on('shown.bs.modal', function() {
                $('#modal-form [name=nama]').focus();
            });

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama]').val(response.nama);
                    $('#modal-form [name=alamat]').val(response.alamat);
                    $('#modal-form [name=telepon]').val(response.telepon);
                    // Tambahkan kolom lain yang ada di tabel supplier jika diperlukan  
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
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
