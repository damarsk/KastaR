<div class="modal fade" id="modal-supplier" tabindex="-1" aria-labelledby="modal-supplier">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul">Judul</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($supplier as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->telepon}}</td>
                                <td>{{$item->alamat}}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm text-white">
                                        <i class="fa fa-check"></i>
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
