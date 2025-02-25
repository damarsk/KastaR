<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    KategoriController,
    ProdukController,
    SupplierController,
    PengeluaranController,
    PembelianController,
    PembelianDetailController,
    ManageKasirController,
    ManageAdminController,
    MemberController,
    PenjualanController,
    PenjualanDetailController,
};

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

    // DASH-MEMBER
    Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
    Route::post('/member/cetak-member', [MemberController::class, 'cetakMember'])->name('member.cetakMember');
    Route::resource('member', MemberController::class);

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
    Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
    Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
    Route::resource('/pembelian', PembelianController::class)->except(['create']);

    // PEMBELIAN-DETAIL
    Route::put('/pembelian_detail/{id}', [PembelianDetailController::class, 'update'])->name('pembelian_detail.update');
    Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
    Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.load_form');
    Route::resource('/pembelian_detail', PembelianDetailController::class)
        ->except('create', 'show', 'edit', 'update');

    // PENJUALAN
    Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
    Route::get('/transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
    Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadform'])->name('transaksi.load_form');
    Route::resource('/transaksi', PenjualanDetailController::class)
        ->except('show');

    // DASH-MANAGE-KASIR && MANAGE ADMIN
    Route::prefix('manage')->group(function () {
        // MANAGE PETUGAS KASIR (Hanya bisa diakses oleh level 1 & 2)
        Route::middleware('check.role:1,2')->group(function () {
            Route::get('/kasir/data', [ManageKasirController::class, 'data'])->name('kasir.data');
            Route::get('/kasir/edit/{id}', [ManageKasirController::class, 'edit'])->name('kasir.edit');
            Route::patch('/kasir/update/{id}', [ManageKasirController::class, 'update'])->name('kasir.update');
            Route::resource('kasir', ManageKasirController::class)->except(['edit', 'update']);
        });

        // MANAGE ADMIN (Hanya bisa diakses oleh level 2)
        Route::middleware('check.role:2')->group(function () {
            Route::get('/admin/data', [ManageAdminController::class, 'data'])->name('admin.data');
            Route::get('/admin/edit/{id}', [ManageAdminController::class, 'edit'])->name('admin.edit');
            Route::patch('/admin/update/{id}', [ManageAdminController::class, 'update'])->name('admin.update');
            Route::resource('admin', ManageAdminController::class)->except(['edit', 'update']);
        });
    });

    // AUTH
    Route::post('/logout', [AuthController::class, 'destroy'])->name('auth.logout');
});
