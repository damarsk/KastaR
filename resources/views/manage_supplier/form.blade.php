<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form">  
    <div class="modal-dialog modal-dialog-scrollable">
        <form action="" method="POST" class="was-validated">  
            @csrf  
            @method('POST')  
            <div class="modal-content">  
                <div class="modal-header">  
                    <h5 class="modal-title" id="judul">Judul</h5>  
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
                </div>  
                <div class="modal-body">  
                    <div class="mb-3">  
                        <label for="nama" class="form-label">Nama</label>  
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama" required autofocus>  
                    </div> 
                    <div class="mb-3">  
                        <label for="telepon" class="form-label">Telepon</label>  
                        <input type="text" name="telepon" class="form-control" id="telepon" placeholder="Masukkan nomor telepon" required>  
                    </div>
                    <div class="mb-3">  
                        <label for="alamat" class="form-label">Alamat</label>  
                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan alamat" required>  
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