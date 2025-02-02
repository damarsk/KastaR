@extends('layouts.app')
@section('title', 'KastaR - Manage Admin')
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
                <h4 class="c-grey-900 mT-10 mB-30">Manage Admin</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20" style="float: left">Manage Administrator</h4>
                            <button onclick="addForm('{{ route('admin.store') }}')" style="float: right"
                                class="btn cur-p btn-success btn-color btn-sm mb-4" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Tambah Admin</button>
                            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 50px">No</th>
                                        <th>Foto</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th width="15%"><i class="fa fa-cog"></i> Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @includeIf('manage_admin.form')
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
                    url: '{{ route('admin.data') }}',
                },
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { 
                        data: 'foto',
                        render: function(data, type, row) {
                            return `<img src="${data}" alt="Foto Admin" style="width: 28px; height: 28px; object-fit: cover; border-radius: 50%;">`;
                        }
                    },
                    { data: 'name' },
                    { data: 'email' },
                    { 
                        data: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Handle form submission
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
        });

        // Function to show add form modal
        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Admin');
            $('#modal-form form').get(0).reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form').on('shown.bs.modal', function () {  
                $('#modal-form [name=name]').focus();  
            });  
        }

        // Function to show edit form modal
        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Admin');
            $('#modal-form form').get(0).reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form').on('shown.bs.modal', function () {  
                $('#modal-form [name=name]').focus();  
            });  

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=name]').val(response.name);
                    $('#modal-form [name=email]').val(response.email);
                    $('#modal-form [name=foto]').val(response.foto);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
        }

        // Function to delete admin
        function deleteData(url) {
            if (confirm('Apakah anda yakin ingin menghapus admin ini?')) {
                $.post(url, {
                        '_method': 'delete',
                        '_token': $('meta[name=csrf-token]').attr('content')
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus admin');
                        return;
                    });
            }
        }
    </script>
@endsection