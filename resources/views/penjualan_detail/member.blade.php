<div class="modal fade" id="modal-member" tabindex="-1" aria-labelledby="modal-member">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul">Pilih Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="modalmemberTable" class="table table-striped table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($member as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->telepon}}</td>
                                <td>{{$item->alamat}}</td>
                                <td>
                                    <button onclick="pilihMember('{{$item->id_member}}', '{{$item->kode_member}}')" class="btn btn-primary btn-sm text-white">
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
