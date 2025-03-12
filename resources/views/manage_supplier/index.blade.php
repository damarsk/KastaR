@extends('layouts.app')
@section('title', 'KastaR - Supplier')
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
                        <li class="breadcrumb-item active" aria-current="manage_member">Supplier</li>
                    </ol>
                </nav>
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
                                        <th style="width: 5%">Foto</th>
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
    @includeIf('manage_supplier.form')
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
                    url: '{{ route('supplier.data') }}',
                },
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    {
                        data: 'foto', orderable: false, searchable: false,
                        render: function(data) {
                            return data ?
                            `<img src="{{ asset('uploads/photos') }}/${data}" style="object-fit: cover; border-radius: 50%; height: 28px; width: 28px">` :
                            '<img src="{{ asset('images') }}/unknown-avatar.png" style="object-fit: cover; border-radius: 50%; height: 28px; width: 28px">';
                        }
                    },
                    { data: 'nama' },
                    { data: 'telepon' },
                    { data: 'alamat' },
                    { data: 'aksi', orderable: false, searchable: false }
                ]
            });

            // Ubah metode submit untuk mengikutsertakan file
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
                            var notyf = new Notyf({
                                duration: 2000,
                                position: { x: 'right', y: 'top' },
                                dismissible: true
                            });
                            notyf.success(response);
                            table.ajax.reload();
                        },
                        error: function(errors) {
                            var notyf = new Notyf({
                                duration: 2000,
                                position: { x: 'right', y: 'top' },
                                dismissible: true
                            });
                            notyf.error('Tidak dapat menyimpan supplier');
                        }
                    });
                }
            });
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Supplier');
            $('#modal-form form').get(0).reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');

            $('#modal-form').on('shown.bs.modal', function() {
                $('#modal-form [name=nama_supplier]').focus();
            });
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Supplier');
            $('#modal-form form').get(0).reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');

            $('#modal-form').on('shown.bs.modal', function() {
                $('#modal-form [name=nama]').focus();
            });
            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama]').val(response.nama);
                    $('#modal-form [name=alamat]').val(response.alamat);
                    $('#modal-form [name=telepon]').val(response.telepon);
                    if (response.foto) {
                    $('#photo-preview').attr('src', '{{ asset('uploads/photos') }}/' + response.foto).show();
                    } else {
                        $('#photo-preview').hide();
                    }
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
                        var notyf = new Notyf({
                                duration: 2000,
                                position: { x: 'right', y: 'top' },
                                dismissible: true
                        });
                        notyf.success('Supplier berhasil dihapus!');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        var notyf = new Notyf({
                            duration: 2000,
                            position: { x: 'right', y: 'top' },
                            dismissible: true
                        });
                        notyf.error('Tidak dapat menghapus supplier!');
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
