<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form">
    <div class="modal-dialog modal-dialog-scrollable">
        <form action="" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judul">Judul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" id="nama_produk" placeholder="Masukkan nama produk" required autofocus>
                        <div class="invalid-feedback">
                            Nama produk wajib diisi.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kode_produk" class="form-label">Kode Produk</label>
                        <input type="text" name="kode_produk" class="form-control" id="kode_produk" placeholder="Masukkan kode produk" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Kategori wajib dipilih.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk (Opsional)</label>
                        <input type="text" name="merk" class="form-control" id="merk" placeholder="Masukkan merk produk">
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label">Harga Beli</label>
                        <input type="number" name="harga_beli" class="form-control" id="harga_beli" placeholder="Masukkan Harga Beli" required>
                        <div class="invalid-feedback">
                            Harga beli wajib diisi.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control" id="harga_jual" placeholder="Masukkan Harga Jual" required>
                        <div class="invalid-feedback">
                            Harga jual wajib diisi.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok Barang</label>
                        <input type="number" name="stok" class="form-control" id="stok" placeholder="Masukkan Stok Barang" required>
                        <div class="invalid-feedback">
                            Stok barang wajib diisi.
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
