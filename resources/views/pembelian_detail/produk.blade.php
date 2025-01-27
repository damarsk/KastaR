<div class="modal fade" id="modal-produk" tabindex="-1" aria-labelledby="modal-produk">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul">Pilih Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="dataProduk" class="table table-striped table-bordered">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga Beli</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($produk as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td><span class="badge text-bg-success text-white">{{$item->kode_produk}}</span></td>
                                <td>{{$item->nama_produk}}</td>
                                <td>{{$item->harga_beli}}</td>
                                <td>
                                    <button onclick="pilihProduk('{{$item->id_produk}}', '{{$item->kode_produk}}')" class="btn btn-primary btn-sm text-white">
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
