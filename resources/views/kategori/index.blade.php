@extends('layouts.app')  
@section('title', 'KastaR - Kategori')  
@section('styles')  
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">  
@endsection  
  
@section('content')  
<main class="main-content bgc-grey-100">  
    <div id="mainContent">  
        <div class="container-fluid">  
            <h4 class="c-grey-900 mT-10 mB-30">Manage Kategori</h4>  
            <div class="row">  
                <div class="col-md-12">  
                    <div class="bgc-white bd bdrs-3 p-20 mB-20">  
                        <h4 class="c-grey-900 mB-20" style="float: left">Tabel Kategori</h4>
                        <button type="button" style="float: right" class="btn cur-p btn-success btn-color btn-sm mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Kategori</button>  
                        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">  
                            <thead>  
                                <tr>  
                                    <th>Name</th>  
                                    <th>Position</th>  
                                    <th>Office</th>  
                                    <th>Age</th>  
                                    <th>Start date</th>  
                                    <th>Salary</th>  
                                </tr>  
                            </thead>  
                            <tfoot>  
                                <tr>  
                                    <th>Name</th>  
                                    <th>Position</th>  
                                    <th>Office</th>  
                                    <th>Age</th>  
                                    <th>Start date</th>  
                                    <th>Salary</th>  
                                </tr>  
                            </tfoot>  
                        </table>  
                    </div>  
                </div>  
            </div>  
        </div>  
    </div>  
</main>  
@includeIf('kategori.form')
@endsection   
  
@section('scripts')  
<script src="{{ asset('js-lib/jquery.min.js') }}"></script> 
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>  
<script>  
    let table;  
  
    $(function() {
        table = $('#dataTable').DataTable({  
            processing: true,  
            autoWidth: false,  
            // ajax: {    
            //     url: '{{ route('kategori.data') }}',    
            // }    
        });  
    });  
  
    function addForm() {
        $('#modal-form').modal('show');  
        $('#modal-form .modal-title').text('Tambah Kategori');  
    }  
</script>  
@endsection  
