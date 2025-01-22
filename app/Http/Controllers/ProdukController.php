<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');
        return view('produk.index', compact('kategori'));
    }

    public function data()
    {
        $produk = Produk::leftJoin('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')
        ->select('produk.*', 'kategori.nama_kategori')
        ->get();

        return datatables()
            ->of($produk)
            ->addIndexColumn()
            ->addColumn('select_all', function ($produk) {
                return '<input type="checkbox" name="id_produk[]" value="' . $produk->id_produk . '">';
            })
            ->addColumn('kode_produk', function ($produk) {
                return '<span class="badge text-bg-success text-white">' . $produk->kode_produk . '</span>';
            })
            ->addColumn('harga_beli', function ($produk) {
                return 'Rp. ' . format_uang($produk->harga_beli);
            })
            ->addColumn('harga_jual', function ($produk) {
                return 'Rp. ' . format_uang($produk->harga_jual);
            })
            ->addColumn('stok', function ($produk) {
                return format_uang($produk->stok);
            })
            ->addColumn('aksi', function ($produk) {
                return '
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button type="button" onclick="editForm(`' .
                    route('produk.update', $produk->id_produk) .
                    '`)" class="btn btn-primary btn-sm text-white" id="edit" data-id="' .
                    $produk->id_produk .
                    '"><i class="fa fa-edit"></i></button>
                <button type="button" onclick="deleteData(`' .
                    route('produk.destroy', $produk->id_produk) .
                    '`)" class="btn btn-danger btn-sm text-white" id="hapus" data-id="' .
                    $produk->id_produk .
                    '"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'select_all', 'kode_produk'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|unique:produk,nama_produk',
        ]);

        $produk = Produk::latest()->first() ?? new Produk();
        $request['kode_produk'] = 'P'. tambah_nol_didepan((int)$produk->id_produk + 1, 6);

        $produk = Produk::create($request->all());

        return response()->json('Data berhasil disimpan', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Produk::find($id);
        return response()->json($produk);
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
        $produk = Produk::find($id);
        $produk->update($request->all());

        return response()->json('Data Berhasil Disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $produk->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $dataproduk = array();
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $dataproduk[] = $produk;
        }

        $count = 1;
        return view('produk.barcode', compact('dataproduk', 'count'));
    }
}
