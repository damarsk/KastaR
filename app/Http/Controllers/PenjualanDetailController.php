<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Member;
use App\Models\Penjualan;
use App\Models\Setting;
use App\Models\PenjualanDetail;
use Illuminate\Http\Request;

class PenjualanDetailController extends Controller
{
    public function index() {
        $produk = Produk::orderBy('nama_produk')->get();
        $member = Member::orderBy('nama')->get();
        $diskon = Setting::first()->diskon ?? 0;

        if ($id_penjualan = session('id_penjualan')) {
            return view('penjualan_detail.index', compact('produk', 'member', 'diskon', 'id_penjualan'));
        }

        if(auth()->user()->level == 1) {
            return redirect()->route('transaksi.baru');
        } else {
            return redirect()->route('dashboard.index');
        }
    }

    public function data($id)
    {
        $detail = PenjualanDetail::with('produk')
            ->where('id_penjualan', $id)
            ->get();
        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['kode_produk'] = '<span class="badge text-bg-success text-white">'. $item->produk['kode_produk'] .'</span';
            $row['nama_produk'] = $item->produk['nama_produk'];
            $row['harga_jual']  = 'Rp. '. format_uang($item->harga_jual);
            $row['jumlah']      = '<input type="number" min="1" class="form-control input-sm quantity" data-id="'. $item->id_penjualan_detail .'" value="'. $item->jumlah .'">';
            $row['diskon']      = $item->diskon .'%';
            $row['subtotal']    = 'Rp. '. format_uang($item->subtotal);
            $row['aksi']        = '<div class="btn-group">
                                    <span onclick="deleteData(`'. route('transaksi.destroy', $item->id_penjualan_detail) .'`)" class="btn btn-sm btn-danger text-white"><i class="fa fa-trash"></i></span>
                                </div>';
            $data[] = $row;

            $total += $item->harga_jual * $item->jumlah;
            $total_item += $item->jumlah;
        }
        $data[] = [
            'kode_produk' => '
                <div class="total d-none">'. $total .'</div>
                <div class="total_item d-none">'. $total_item .'</div>',
            'nama_produk' => '',
            'harga_jual'  => '',
            'jumlah'      => '',
            'diskon'      => '',
            'subtotal'    => '',
            'aksi'        => '',
        ];

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->rawColumns(['aksi', 'kode_produk', 'jumlah'])
            ->make(true);
    }

    public function store(Request $request) {
        $produk = Produk::findOrFail($request->id_produk);
        if (!$produk) {
            return response()->json(['status' => '404', 'message' => 'Produk tidak ditemukan']);
        }

        $detail = new PenjualanDetail();
        $detail->id_penjualan = $request->id_penjualan;
        $detail->id_produk = $produk->id_produk;
        $detail->harga_jual = $produk->harga_jual;
        $detail->jumlah = 1;
        $detail->diskon = 0;
        $detail->subtotal = $produk->harga_jual;
        $detail->save();

        return response()->json(['status' => '200', 'id' => $detail->id_penjualan_detail]);
    }

    public function loadform($diskon, $total, $diterima)
    {
        $bayar = $total - ($total * $diskon / 100);
        $kembali = ($diterima != 0) ? $diterima - $bayar : 0;
        $data = [
            'totalrp' => format_uang($total),
            'bayar' => $bayar,
            'bayarrp' => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar) . ' Rupiah'),
            'kembalirp' => format_uang($kembali),
        ];

        return response()->json($data);
    }
}
