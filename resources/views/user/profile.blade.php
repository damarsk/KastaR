@extends('layouts.app')
@section('title', 'KastaR - Profile')
@section('styles')

@endsection
@section('content')
    <main class="main-content bgc-grey-100">
        <div class="container-fluid py-1">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Pengaturan User</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.update_profile') }}" method="post" class="form-profile" 
                                data-toggle="validator" enctype="multipart/form-data">
                                @csrf

                                <div class="alert alert-info alert-dismissible fade show d-none" role="alert">
                                    <i class="fa fa-check me-2"></i> Perubahan berhasil disimpan
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                                <div class="mb-3 row">
                                    <label for="name" class="col-md-4 col-form-label">Nama</label>
                                    <div class="col-md-8">
                                        <input type="text" name="name" class="form-control" id="name" 
                                            required autofocus value="{{ $profile->name }}">
                                        <div class="invalid-feedback">Nama harus diisi</div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="foto" class="col-md-4 col-form-label">Profil</label>
                                    <div class="col-md-8">
                                        <input type="file" name="foto" class="form-control" id="foto"
                                            onchange="preview('.tampil-foto', this.files[0])">
                                        <div class="mt-2 tampil-foto">
                                            <img src="{{ asset('uploads/photos/' . ($profile->foto ?? 'default.jpg')) }}" width="200">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="old_password" class="col-md-4 col-form-label">Password Lama</label>
                                    <div class="col-md-8">
                                        <input type="password" name="old_password" class="form-control" 
                                            id="old_password" minlength="6">
                                        <div class="invalid-feedback">Password minimal 6 karakter</div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="password" class="col-md-4 col-form-label">Password Baru</label>
                                    <div class="col-md-8">
                                        <input type="password" name="password" class="form-control" 
                                            id="password" minlength="6">
                                        <div class="invalid-feedback">Password minimal 6 karakter</div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="password_confirmation" class="col-md-4 col-form-label">Konfirmasi Password</label>
                                    <div class="col-md-8">
                                        <input type="password" name="password_confirmation" class="form-control" 
                                            id="password_confirmation" data-match="#password">
                                        <div class="invalid-feedback">Konfirmasi password tidak sesuai</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary text-white">
                                            <i class="fa fa-save me-2"></i>Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js-lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js-lib/validator.min.js') }}"></script>
    <script>
        $(function() {
            $('#old_password').on('keyup', function() {
                if ($(this).val() != "") $('#password, #password_confirmation').attr('required', true);
                else $('#password, #password_confirmation').attr('required', false);
            });

            $('.form-profile').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                            url: $('.form-profile').attr('action'),
                            type: $('.form-profile').attr('method'),
                            data: new FormData($('.form-profile')[0]),
                            async: false,
                            processData: false,
                            contentType: false
                        })
                        .done(response => {
                            $('[name=name]').val(response.name);
                            $('.tampil-foto').html(`<img src="{{ asset('uploads/photos/') }}/${response.foto}" width="200">`);
                            $('.img-profile').attr('src', `{{ asset('uploads/photos/') }}/${response.foto}`);
                            $('.username').text(response.name);

                            if ($('.alert').hasClass('d-none')) {
                                $('.alert').removeClass('d-none');
                            }

                            $("html, body").animate({ scrollTop: 0 }, 'slow', function() {
                                setTimeout(() => {
                                    $('.alert').fadeOut('slow', () => {
                                        $('.alert').addClass('d-none');
                                        $('.alert').fadeIn();
                                    });
                                }, 3000);
                            });
                        })
                        .fail(errors => {
                            if (errors.status == 422) {
                                alert(errors.responseJSON);
                            } else {
                                alert('Tidak dapat menyimpan data');
                            }
                            return;
                        });
                }
            });
        });

        function preview(selector, file, width = 200) {
            if (!file) return;

            if (!file.type.match('image.*')) {
                alert('Silakan pilih file gambar');
                return;
            }

            const reader = new FileReader();

            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.width = width;

                const previewContainer = document.querySelector(selector);
                previewContainer.innerHTML = '';

                previewContainer.appendChild(imgElement);
            }

            reader.readAsDataURL(file);
        }
    </script>
@endsection
