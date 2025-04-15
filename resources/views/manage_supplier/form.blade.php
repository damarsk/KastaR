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
        display: none; /* Awalnya disembunyikan */
    }

    .photo-frame input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0; /* Membuat input file transparan */
        cursor: pointer;
    }

    .remove-photo {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        cursor: pointer;
        z-index: 2;
        display: none;
    }
</style>
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form">  
    <div class="modal-dialog modal-dialog-scrollable">
        <form action="" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">  
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
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama" required>  
                        <div class="invalid-feedback">
                            Tolong masukkan nama lengkap.
                        </div>
                    </div> 
                    <div class="mb-3">  
                        <label for="telepon" class="form-label">Telepon</label>  
                        <input type="text" name="telepon" class="form-control" id="telepon" placeholder="Masukkan nomor telepon" required>  
                        <div class="invalid-feedback">
                            Tolong masukkan nomor telepon.
                        </div>
                    </div>
                    <div class="mb-3">  
                        <label for="alamat" class="form-label">Alamat</label>  
                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan alamat" required>  
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
