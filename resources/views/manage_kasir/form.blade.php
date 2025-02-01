<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form">
    <div class="modal-dialog modal-dialog-scrollable">
        <form action="" method="POST" class="was-validated" enctype="multipart/form-data">
            @csrf
            @method('POST')
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
                            placeholder="Masukkan password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation" placeholder="Konfirmasi password">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Pas Foto 4x3 (Untuk Profil)</label>
                        <div class="photo-frame">
                            <img id="photo-preview" src="#" alt="Pratinjau Pas Foto" class="img-fluid">
                            <input type="file" name="photo" class="form-control-file" id="photo"
                                accept="image/*">
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