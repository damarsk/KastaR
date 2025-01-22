<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\AuthController;  
use App\Http\Controllers\KategoriController;  
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PembelianController;
  
/*  
|--------------------------------------------------------------------------  
| Web Routes  
|--------------------------------------------------------------------------  
|  
| Here is where you can register web routes for your application. These  
| routes are loaded by the RouteServiceProvider and all of them will  
| be assigned to the "web" middleware group. Make something great!  
|  
*/  
  
// LOGIN  
Route::middleware('guest')->group(function () {  
    // HOME  
    Route::get('/', function () {  
        return view('welcome');  
    });  
    Route::get('/login', [AuthController::class, 'index'])->name('auth.index');  
    Route::post('/login', [AuthController::class, 'store'])->name('auth.store');  
});  
  
Route::middleware('auth')->prefix('dashboard')->group(function () {  
    // DASHBOARD  
    Route::get('/', function () {    
        return view('dashboard');  
    })->name('dashboard.index');  
  
    // DASH-KATEGORI
    Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
    Route::resource('kategori', KategoriController::class);
    // DASH-PRODUK
    Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
    Route::post('/produk/delete-selected', [ProdukController::class, 'deleteSelected'])->name('produk.deleteSelected');
    Route::post('/produk/cetak-barcode', [ProdukController::class, 'cetakBarcode'])->name('produk.cetakBarcode');
    Route::resource('produk', ProdukController::class);
    // DASH-SUPPLIER
    Route::get('/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
    Route::resource('supplier', SupplierController::class);
    // DASH-PENGELUARAN
    Route::get('/pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
    Route::resource('pengeluaran', PengeluaranController::class);
    // DASH-PEMBELIAN
    Route::resource('/pembelian', PembelianController::class);
    
    // AUTH  
    Route::post('/logout', [AuthController::class, 'destroy'])->name('auth.logout');  
});