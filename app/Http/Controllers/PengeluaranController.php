<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::all();
        return view('pengeluaran.index', compact('pengeluarans'));
    }

    public function data()
    {
        $pengeluaran = Pengeluaran::orderBy('id_pengeluaran', 'desc')->get();

        return datatables()
            ->of($pengeluaran)
            ->addIndexColumn()
            ->addColumn('created_at', function ($pengeluaran) { 
                return tanggal_indonesia($pengeluaran->created_at, false);
            })
            ->addColumn('nominal', function ($pengeluaran) { 
                return "Rp. " . format_uang($pengeluaran->nominal);
            })
            ->addColumn('aksi', function ($pengeluaran) {
                return '  
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">  
                <button type="button" onclick="editForm(`' .
                    route('pengeluaran.update', $pengeluaran->id_pengeluaran) .
                    '`)" class="btn btn-primary btn-sm text-white" id="edit" data-id="' .
                    $pengeluaran->id_pengeluaran .
                    '"><i class="fa fa-edit"></i></button>  
                <button type="button" onclick="deleteData(`' .
                    route('pengeluaran.destroy', $pengeluaran->id_pengeluaran) .
                    '`)" class="btn btn-danger btn-sm text-white" id="hapus" data-id="' .
                    $pengeluaran->id_pengeluaran .
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
            'deskripsi' => 'required|string|max:255',
        ]);

        $pengeluaran = Pengeluaran::create($request->all());

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show(string $id)
    {
        $pengeluaran = Pengeluaran::find($id);
        return response()->json($pengeluaran);
    }

    public function update(Request $request, string $id)
    {
        $pengeluaran = Pengeluaran::find($id)->update($request->all());
        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function destroy(string $id)
    {
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();

        return response(null, 204);
    }
}
