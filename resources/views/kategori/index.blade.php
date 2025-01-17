@extends('layouts.app')
@section('title', 'KastaR - Kategori')
@section('styles')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('content')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
                <h4 class="c-grey-900 mT-10 mB-30">Manage Kategori</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20" style="float: left">Tabel Kategori</h4>
                            <button onclick="addForm('{{ route('kategori.store') }}')" style="float: right"
                                class="btn cur-p btn-success btn-color btn-sm mb-4" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Tambah Kategori</button>
                            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 50px">No</th>
                                        <th>Kategori</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th style="width: 50px">No</th>
                                        <th>Kategori</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($kategoris as $index => $kategori)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $kategori->nama_kategori }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @includeIf('kategori.form')
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
                // ajax: {      
                //     url: '{{ route('kategori.data') }}',      
                // }      
            });

            // Menangani submit form di modal  
            $('#modal-form').validator().on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    $.ajax({
                            url: $('#modal-form form').attr('action'),
                            type: 'post',
                            data: $('#modal-form form').serialize()
                        })
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
        });

        // Fungsi untuk menampilkan modal tambah form  
        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Kategori');

            $('#modal-form form').get(0).reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nama_kategori]').focus();
        }
    </script>
@endsection
