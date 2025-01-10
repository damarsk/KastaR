<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// INDEX
Route::get('/', function () {
    return view('welcome');
});

// LOGIN
Route::middleware('guest')->group(function () {
Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'store'])->name('auth.store');
});

Route::middleware('auth')->group(function () {
    // DASHBOARD
    Route::get('/dashboard', function () {  
        return view('dashboard');
    })->name('dashboard.index');

    // AUTH
    Route::post('/logout', [AuthController::class, 'destroy'])->name('auth.logout');
});