<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class PembelianController extends Controller
{
    public function index() {
        $supplier = Supplier::orderBy('nama')->get();
        
        return view('pembelian.index', compact('supplier'));
    }
}
