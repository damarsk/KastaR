<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form">
    <div class="modal-dialog">
        <form action="" method="POST">
          @csrf
          @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judul">Judul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Category Name</label>
                        <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" placeholder="Enter category name"
                            required autofocus>
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
