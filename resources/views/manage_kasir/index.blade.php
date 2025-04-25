@extends('layouts.app')
@section('title', 'KastaR - Manage Petugas Kasir')
@section('styles')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('content')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
                <nav aria-label="breadcrumb" class="float-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Manage</li>
                        <li class="breadcrumb-item active" aria-current="manage_kasir">Kasir</li>
                    </ol>
                </nav>
                <h4 class="c-grey-900 mT-10 mB-30">Manage Petugas Kasir</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20" style="float: left">Manage Petugas Kasir</h4>
                            <div class="btn-group" style="float: right; margin-bottom: 10px;">
                                <button onclick="addForm('{{ route('kasir.store') }}')"
                                    class="btn cur-p btn-success btn-color btn-sm">
                                    <i class="fa fa-plus"></i> Tambah Petugas Kasir
                                </button>
                            </div>
                            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
    @includeIf('manage_kasir.form')
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
                                `<img src="{{ asset('uploads/photos') }}/${data}" style="object-fit: cover; border-radius: 50%; height: 28px; width: 28px">` :
                                '<img src="{{ asset('images') }}/unknown-avatar.png" style="object-fit: cover; border-radius: 50%; height: 28px; width: 28px">';
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
                            $('#modal-form').modal('hide');
                            var notyf = new Notyf({
                                duration: 2000,
                                position: {
                                    x: 'right',
                                    y: 'top',
                                },
                                dismissible: true
                            });
                            notyf.success(response);
                            table.ajax.reload();
                        },
                        error: function(errors) {
                            var notyf = new Notyf({
                                duration: 2000,
                                position: {
                                    x: 'right',
                                    y: 'top',
                                },
                                dismissible: true
                            });
                            notyf.error('Tidak dapat menyimpan petugas kasir');
                            return;
                        }
                    });
                }
            });
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Petugas Kasir');
            $('#modal-form form').get(0).reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form').on('shown.bs.modal', function() {
                $('#modal-form [name=name]').focus();
            });

            $('#password').closest('.mb-3').show();
            $('#password_confirmation').closest('.mb-3').show();
            $('#password').attr('required', 'required');
            $('#password_confirmation').attr('required', 'required');
        }

        function editForm(urlEdit, urlUpdate) {
            $('#password').closest('.mb-3').hide();
            $('#password_confirmation').closest('.mb-3').hide();
            $('#password').removeAttr('required');
            $('#password_confirmation').removeAttr('required');
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

        function deleteData(url) {
            if (confirm('Apakah anda yakin ingin menghapus petugas kasir ini?')) {
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
                            notyf.success(response.message);
                        table.ajax.reload();
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
                            notyf.error('Tidak dapat menghapus petugas kasir');
                        return;
                    });
            }
        }

        $(document).ready(function() {
            const $photoInput = $('#photo');
            const $photoPreview = $('#photo-preview');
            const $removePhotoBtn = $('#remove-photo-btn');
            const $modalForm = $('#modal-form');

            $photoInput.on('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $photoPreview.attr('src', e.target.result);
                        $photoPreview.show();
                        $removePhotoBtn.show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $photoPreview.attr('src', '#');
                    $photoPreview.hide();
                    $removePhotoBtn.hide();
                }
            });

            $removePhotoBtn.on('click', function() {
                $photoPreview.attr('src', '#');
                $photoPreview.hide();
                $removePhotoBtn.hide();
                $photoInput.val('');
            });

            $modalForm.on('hidden.bs.modal', function() {
                $photoInput.val('');
                $photoPreview.attr('src', '#');
                $photoPreview.hide();
                $removePhotoBtn.hide();
                $('#name').val('');
                $('#email').val('');
                $('#password').val('');
                $('#password_confirmation').val('');
            });
        });
    </script>
@endsection
