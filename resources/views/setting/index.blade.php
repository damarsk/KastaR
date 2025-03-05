@extends('layouts.app')
@section('title', 'KastaR - Pengaturan')
@section('styles')

@endsection
@section('content')
    <main class="main-content bgc-grey-100">
        <div class="container-fluid py-1">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Pengaturan Perusahaan</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('setting.update') }}" method="post" class="form-setting"
                                data-toggle="validator" enctype="multipart/form-data">
                                @csrf

                                <div class="alert alert-info alert-dismissible fade show d-none" role="alert">
                                    <i class="fa fa-check me-2"></i> Perubahan berhasil disimpan
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nama_perusahaan" class="col-md-4 col-form-label">Nama Perusahaan</label>
                                    <div class="col-md-8">
                                        <input type="text" name="nama_perusahaan" class="form-control"
                                            id="nama_perusahaan" required autofocus>
                                        <div class="invalid-feedback">Nama perusahaan harus diisi</div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="telepon" class="col-md-4 col-form-label">Telepon</label>
                                    <div class="col-md-8">
                                        <input type="text" name="telepon" class="form-control" id="telepon" required>
                                        <div class="invalid-feedback">Nomor telepon harus diisi</div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="alamat" class="col-md-4 col-form-label">Alamat</label>
                                    <div class="col-md-8">
                                        <textarea name="alamat" class="form-control" id="alamat" rows="3" required></textarea>
                                        <div class="invalid-feedback">Alamat harus diisi</div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="path_logo" class="col-md-4 col-form-label">Logo Perusahaan</label>
                                    <div class="col-md-8">
                                        <input type="file" name="path_logo" class="form-control" id="path_logo"
                                            onchange="preview('.tampil-logo', this.files[0])">
                                        <div class="mt-2 tampil-logo"></div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="path_kartu_member" class="col-md-4 col-form-label">Kartu Member</label>
                                    <div class="col-md-8">
                                        <input type="file" name="path_kartu_member" class="form-control"
                                            id="path_kartu_member"
                                            onchange="preview('.tampil-kartu-member', this.files[0], 300)">
                                        <div class="mt-2 tampil-kartu-member"></div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="diskon" class="col-md-4 col-form-label">Diskon</label>
                                    <div class="col-md-4">
                                        <input type="number" name="diskon" class="form-control" id="diskon" required>
                                        <div class="invalid-feedback">Diskon harus diisi</div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="tipe_nota" class="col-md-4 col-form-label">Tipe Nota</label>
                                    <div class="col-md-4">
                                        <select name="tipe_nota" class="form-control" id="tipe_nota" required>
                                            <option value="1">Nota Kecil</option>
                                            <option value="2">Nota Besar</option>
                                        </select>
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
            showData();

            $('.form-setting').validator().on('submit', function(e) {
                e.preventDefault()
                $.ajax({
                        url: $('.form-setting').attr('action'),
                        type: $('.form-setting').attr('method'),
                        data: new FormData($('.form-setting')[0]),
                        async: false,
                        processData: false,
                        contentType: false
                    })
                    .done(response => {
                        showData();
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
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            });
        });

        function showData() {
            $.get('{{ route('setting.show') }}')
                .done(response => {
                    $('[name=nama_perusahaan]').val(response.nama_perusahaan);
                    $('[name=telepon]').val(response.telepon);
                    $('[name=alamat]').val(response.alamat);
                    $('[name=diskon]').val(response.diskon);
                    $('[name=tipe_nota]').val(response.tipe_nota);
                    $('title').text(response.nama_perusahaan + ' | Pengaturan');

                    let words = response.nama_perusahaan.split(' ');
                    let word = '';
                    words.forEach(w => {
                        word += w.charAt(0);
                    });
                    $('.logo-mini').text(word);
                    $('.logo-lg').text(response.nama_perusahaan);

                    $('.tampil-logo').html(`<img src="{{ url('/') }}${response.path_logo}" width="200">`);
                    $('.tampil-kartu-member').html(
                        `<img src="{{ url('/') }}${response.path_kartu_member}" width="300">`);
                    $('[rel=icon]').attr('href', `{{ url('/') }}${response.path_logo}`);
                })
                .fail(errors => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
        }

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
