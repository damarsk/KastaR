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
                            <form method="POST" class="form-kasir">
                                @csrf
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- MODAL BOX --}}
    <div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form">
        <div class="modal-dialog modal-dialog-scrollable">
            <form action="" method="POST" class="was-validated" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="method" value="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="judul">Tambah Petugas Kasir</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Masukkan nama lengkap petugas kasir" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Masukkan email petugas kasir" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Masukkan password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                id="password_confirmation" placeholder="Konfirmasi password" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Pas Foto 4x3 (Untuk Profil)</label>
                            <div class="photo-frame">
                                <img id="photo-preview" src="#" alt="Pratinjau Pas Foto" class="img-fluid">
                                <input type="file" name="photo" class="form-control-file" id="photo"
                                    accept="image/*" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary text-white">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js-lib/jquery.min.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js-lib/validator.min.js') }}"></script>
    <script>
        let table;

        $(function() {
            // Initialize DataTables
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
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `<button onclick="showEdit(${data})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                    <button onclick="deleteData('{{ route('kasir.destroy', ':id') }}'.replace(':id', ${data}))" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>`;
                        }
                    }
                ]
            });

            // Handle form submission
            $('#modal-form form').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const formData = new FormData(form[0]);
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // 422 Unprocessable Entity
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = 'Kesalahan Validasi:\n';
                            for (const key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessage += `${errors[key].join(', ')}\n`;
                                }
                            }
                            alert(errorMessage);
                        } else {
                            alert('Tidak dapat menyimpan data');
                        }
                    }
                });
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
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form #method').val('post');
            $('#photo-preview').hide();
        }

        // Show edit form with data
        function showEdit(id) {
            const url = `{{ route('kasir.edit', ':id') }}`.replace(':id', id);
            editForm(url);
        }

        // Edit form
        function editForm(url) {
            event.preventDefault();
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Petugas Kasir');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form #method').val('put');
            $('#photo-preview').hide();

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=name]').val(response.name);
                    $('#modal-form [name=email]').val(response.email);
                    if (response.foto) {
                        $('#photo-preview')
                            .attr('src', `{{ asset('uploads/photos') }}/${response.foto}`)
                            .show();
                    }
                })  
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
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