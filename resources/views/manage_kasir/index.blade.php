@extends('layouts.app')

@section('title', 'KastaR - Petugas Kasir')

@section('styles')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <style>
        .photo-frame {
            position: relative;
            width: 150px;
            height: 200px;
            border: 2px dashed #ccc;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
            /* Awalnya disembunyikan */
        }

        .photo-frame input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            /* Membuat input file transparan */
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
                <h4 class="c-grey-900 mT-10 mB-30">Manage Petugas Kasir</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20" style="float: left">Tabel Petugas Kasir</h4>
                            <div class="btn-group" style="float: right; margin-bottom: 10px;">
                                <button onclick="addForm('{{ route('kasir.store') }}')"
                                    class="btn cur-p btn-success btn-color btn-sm">
                                    <i class="fa fa-plus"></i> Tambah Petugas Kasir
                                </button>
                            </div>
                                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th style="width: 5%">Foto</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th width="10%"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    @include('manage_kasir.form')
@endsection

@section('scripts')
    <script src="{{ asset('js-lib/jquery.min.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js-lib/validator.min.js') }}"></script>
    <script>
        let table;

        $(function() {
            table = $('#dataTable').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('kasir.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'foto',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return data ?
                                `<img src="{{ asset('uploads/photos') }}/${data}" class="img-thumbnail rounded-circle" width="50" height="50">` :
                                'No Image';
                        }
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
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
                    $.ajax({
                        url: $('#modal-form form').attr('action'),
                        type: 'POST',
                        data: new FormData($('#modal-form form')[0]),
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        },
                        error: function(errors) {
                            alert('Tidak dapat menyimpan data');
                            return;
                        }
                    });
                }
            });

            // Image preview
            $('#photo').on('change', function(event) {
                const [file] = event.target.files;
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#photo-preview')
                            .attr('src', e.target.result)
                            .show();
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Add form
        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Petugas Kasir');
            $('#modal-form form').get(0).reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form').on('shown.bs.modal', function() {
                $('#modal-form [name=name]').focus();
            });
        }

        // Edit form
        function editForm(urlEdit, urlUpdate) {
            $.get(urlEdit, function(data) {
                $('#modal-form').modal('show');
                $('#modal-form .modal-title').text('Edit Petugas Kasir');
                $('#modal-form form')[0].reset();
                $('#modal-form form').attr('action', urlUpdate);
                $('#modal-form #method').val('patch');
                $('#name').val(data.name);
                $('#email').val(data.email);
                if (data.foto) {
                    $('#photo-preview').attr('src', '{{ asset('uploads/photos') }}/' + data.foto).show();
                } else {
                    $('#photo-preview').hide();
                }
            });
        }

        // Delete data
        function deleteData(url) {
            if (confirm('Apakah anda yakin ingin menghapus petugas kasir ini?')) {
                $.post(url, {
                        '_method': 'delete',
                        '_token': $('meta[name=csrf-token]').attr('content')
                    })
                    .done((response) => {
                        alert(response.message);
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus petugas kasir');
                        return;
                    });
            }
        }
    </script>
@endsection
