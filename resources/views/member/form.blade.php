<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form">
    <div class="modal-dialog">
        <form action="" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judul">Judul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" id="nama"
                            placeholder="Nama Lengkap" required>
                        <div class="invalid-feedback">
                            Tolong masukkan nama lengkap.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" placeholder="Nomor Telepon" required>
                        <div class="invalid-feedback">
                            Tolong masukkan nomor telepon.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Tempat Tinggal</label>
                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat Lengkap" required rows="3"></textarea>
                        <div class="invalid-feedback">
                            Tolong masukkan alamat lengkap.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary text-white">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
