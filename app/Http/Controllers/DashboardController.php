<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Produk;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index() {
        $kategori = Kategori::count();
        $supplier = Supplier::count();
        $produk = Produk::count();
        $member = Member::count();

        if(auth()->user()->level >= 1) {
            return view('admin.dashboard', compact('kategori', 'supplier', 'produk', 'member'));
        } else {
            return view('kasir.dashboard');
        }
    }
}
