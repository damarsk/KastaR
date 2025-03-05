<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form">  
    <div class="modal-dialog modal-dialog-scrollable">
        <form action="{{  route('laporan.index') }}" method="get" data-toggle="validator" autocomplete="off">
            <div class="modal-content">  
                <div class="modal-header">  
                    <h5 class="modal-title" id="judul">Periode Laporan</h5>  
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
                </div>  
                <div class="modal-body">  
                    <label for="tanggal_awal" class="form-label fw-500">Tanggal Awal</label>
                    <div class="timepicker-input input-icon mb-3">
                        <div class="input-group">
                            <div class="input-group-text bgc-white bd bdwR-0">
                                <i class="ti-calendar"></i>
                            </div>
                            <input type="text" name="tanggal_awal" class="form-control bdc-grey-200 datepicker" id="tanggal_awal" placeholder="Pilih Tanggal Awal"
                                data-provide="datepicker" value="{{ request('tanggal_awal') }}" required>
                        </div>
                    </div>
                    <label for="tanggal_akhir" class="form-label fw-500">Tanggal Akhir</label>
                    <div class="timepicker-input input-icon mb-3">
                        <div class="input-group">
                            <div class="input-group-text bgc-white bd bdwR-0">
                                <i class="ti-calendar"></i>
                            </div>
                            <input type="text" name="tanggal_akhir" class="form-control bdc-grey-200 datepicker" id="tanggal_akhir" placeholder="Pilih Tanggal Akhir"
                                data-provide="datepicker" value="{{ request('tanggal_awal') }}" required>
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