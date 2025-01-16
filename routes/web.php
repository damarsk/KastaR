<?php

use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\AuthController;  
use App\Http\Controllers\KategoriController;  
  
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
  
    // DASH KATEGORI  
    Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
    Route::resource('kategori', KategoriController::class);
  
    // AUTH  
    Route::post('/logout', [AuthController::class, 'destroy'])->name('auth.logout');  
});