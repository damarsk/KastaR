<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('manage_supplier.index', compact('suppliers'));
    }

    public function data()
    {
        $supplier = Supplier::select('supplier.*')
            ->get();

        return datatables()
            ->of($supplier)
            ->addIndexColumn()
            ->addColumn('aksi', function ($supplier) {
                return '
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" onclick="editForm(`' .
                    route('supplier.update', $supplier->id_supplier) .
                    '`)" class="btn btn-primary btn-sm text-white" id="edit" data-id="' .
                    $supplier->id_supplier .
                    '"><i class="fa fa-edit"></i></button>
                <button type="button" onclick="deleteData(`' .
                    route('supplier.destroy', $supplier->id_supplier) .
                    '`)" class="btn btn-danger btn-sm text-white" id="hapus" data-id="' .
                    $supplier->id_supplier .
                    '"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $supplier = Supplier::create($request->all());

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show(string $id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    public function update(Request $request, string $id)
    {
        $supplier = Supplier::find($id)->update($request->all());
        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        return response(null, 204);
    }
}
