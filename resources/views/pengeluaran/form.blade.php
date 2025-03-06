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
                        <label for="deskripsi" class="form-label">Deskripsi</label>  
                        <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukkan deskripsi" required autofocus>  
                        <div class="invalid-feedback">
                            Deskripsi wajib diisi.
                        </div>
                    </div>
                    <div class="mb-3">  
                        <label for="nominal" class="form-label">Nominal</label>  
                        <input type="number" name="nominal" class="form-control" id="nominal" placeholder="Masukkan nominal" required autofocus>  
                        <div class="invalid-feedback">
                            Nominal wajib diisi.
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