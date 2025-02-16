@extends('layouts.app')
@section('title', 'KastaR - Pembelian')
@section('styles')
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
@endsection

@section('content')
{{-- @includeIf('pembelian.supplier')
@includeIf('pembelian.detail') --}}
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            <div class="container-fluid">
                <h4 class="c-grey-900 mT-10 mB-30">Manage Pembelian</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20 mB-20">
                            <h4 class="c-grey-900 mB-20" style="float: left">Tabel Pembelian</h4>
                            <div class="btn-group" style="float: right; margin-bottom: 10px;">
                                <button onclick="addForm('{{ route('supplier.store') }}')"
                                    class="btn cur-p btn-success btn-color btn-sm"><i class="fa fa-plus"></i> Transaksi
                                    Baru</button>
                                @empty(!session('id_pembelian'))
                                    <a href="{{ route('pembelian_detail.index') }}"
                                        class="btn cur-p btn-info btn-color btn-sm"><i class="fa fa-edit"></i> Update
                                        Transaksi</a>
                                @endempty

                            </div>
                            <form action="" method="POST" class="form-supplier">
                                @csrf
                                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <th style="width: 5%">No</th>
                                        <th>Tanggal</th>
                                        <th>Supplier</th>
                                        <th>Total Item</th>
                                        <th>Total Harga</th>
                                        <th>Diskon</th>
                                        <th>Total Bayar</th>
                                        <th width="10%"><i class="fa fa-cog"></i></th>
                                    </thead>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('js-lib/jquery.min.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js-lib/validator.min.js') }}"></script>
    <script>
        $(function() {
            $('#dataTable').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pembelian.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal'
                    },
                    {
                        data: 'supplier'
                    },
                    {
                        data: 'total_item'
                    },
                    {
                        data: 'total_harga'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'bayar'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        orderable: false
                    }
                ]
            });
        });

        $(function() {
            $('#modalDetailTable').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('supplier.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'telepon'
                    },
                    {
                        data: 'alamat'
                    },
                    {
                        data: 'aksi',
                        searchable: false
                    }
                ]
            });
        });

        function addForm() {
            $('#modal-supplier').modal('show');
        }

        function showDetail() {
            event.preventDefault();
            $('#modal-detail').modal('show');
        }

        function deleteData(url) {
            if (confirm('Apakah anda yakin ingin menghapus supplier ini?')) {
                $.post(url, {
                        '_method': 'delete',
                        '_token': $('meta[name=csrf-token]').attr('content')
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus supplier');
                        return;
                    });
            }
        }
    </script>
@endsection
