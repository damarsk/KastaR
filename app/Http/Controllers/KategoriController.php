<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kategori.index');
    }

    public function data()
    {
        $kategori = Kategori::orderBy('id_kategori', 'desc')->get();

        return datatables()
            ->of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                return '
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button onclick="editForm(`' .
                    route('kategori.update', $kategori->id_kategori) .
                    '`)" class="btn btn-primary btn-sm text-white" id="edit" data-id="' .
                    $kategori->id_kategori .
                    '"><i class="fa fa-edit"></i></button>
                <button onclick="deleteData(`' .
                    route('kategori.destroy', $kategori->id_kategori) .
                    '`)" class="btn btn-danger btn-sm text-white" id="hapus" data-id="' .
                    $kategori->id_kategori .
                    '"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function generateKodeKategori()
    {
        $lastKategori = Kategori::orderBy('id_kategori', 'desc')->first();
        $lastKode = $lastKategori ? intval(substr($lastKategori->kode_kategori, 1)) : 0;
        $newKode = 'K' . str_pad($lastKode + 1, 3, '0', STR_PAD_LEFT);
        
        return $newKode;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori',
        ]);

        $kategori = new Kategori();
        $kategori->kode_kategori = $this->generateKodeKategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return response()->json('Data Berhasil Disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::find($id);

        return response()->json($kategori);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->update();

        return response()->json('Data Berhasil Disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json('Data Berhasil Dihapus', 204);
    }
}
