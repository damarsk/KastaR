<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Member;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $kategori = Kategori::count();
        $supplier = Supplier::count();
        $produk = Produk::count();
        $member = Member::count();

        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');

        $total_penjualan = Penjualan::sum('bayar');
        $total_pembelian = Pembelian::sum('bayar');
        $total_pengeluaran = Pengeluaran::sum('nominal');

        $profit = $total_penjualan - $total_pembelian - $total_pengeluaran;

        if ($total_penjualan == 0) {
            $profit_percentage = 0;
        } else {
            if ($profit > 0) {
                $profit_percentage = ($profit / $total_penjualan) * 100;
            } else {
                $loss_percentage = (($total_pembelian + $total_pengeluaran - $total_penjualan) / $total_penjualan) * 100;
                $profit_percentage = -$loss_percentage;
            }
        }

        $icon_profit = $profit > 0 ? 'fa-level-up c-green-500' : 'fa-level-down c-red-500';

        $data_tanggal = array();
        $data_profit = array();

        while (strtotime($tanggal_awal) <= strtotime($tanggal_akhir)) {
            $data_tanggal[] = (int) substr($tanggal_awal, 8, 2);

            $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('bayar');
            $total_pembelian = Pembelian::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('bayar');
            $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('nominal');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
            $data_profit[] = $pendapatan;

            $tanggal_awal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_awal)));
        }

        $tanggal_awal = date('Y-m-01');

        if (auth()->user()->level >= 1) {
            return view('admin.dashboard', compact('kategori', 'produk', 'supplier', 'member', 'tanggal_awal', 'tanggal_akhir', 'data_tanggal', 'data_profit', 'profit_percentage', 'icon_profit'));
        } else {
            return view('kasir.dashboard');
        }
    }
}
