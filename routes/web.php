<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return view('main');
})->name('user.dashboard');

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->back();
    }

    return view('login');
})->name('login.page');


Route::get('/register', function () {
    return view('register');
})->name('register');

// Rute untuk pengguna
Route::middleware(['auth', RoleMiddleware::class . ':user'])->group(function () {

    Route::get('/scan', function () {
        return view('user.scan');
    })->name('scan');

    Route::get('/scan', [ScanController::class, 'showScanForm'])->name('scan');

    Route::post('/scan', [ScanController::class, 'store'])->name('scan.post');

    Route::post('/scan/tambah', [ScanController::class, 'tambahJumlah']);
    Route::post('/scan/simpan', [ScanController::class, 'simpanJumlah']);
    Route::post('/penyakit/tambah', [ScanController::class, 'tambahAyamSakit']);

    Route::get('/penyakit', function () {
        return view('user.penyakit');
    })->name('penyakit');
});

// Rute untuk admin
Route::middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])->group(function () {

    Route::get('/admin/akun', [AdminController::class, 'akun'])->name('admin.akun');
    Route::put('/admin/akun/{id}', [AdminController::class, 'update'])->name('akun.update');
    Route::delete('/admin/akun/{id}', [AdminController::class, 'destroy'])->name('akun.destroy');
    Route::post('/admin/blok', [AdminController::class, 'storeBlok'])->name('blok.store');

    // Route::get('/admin', function () {
    //     return view('admin.admin');
    // })->name('admin.dashboard');

    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');


    Route::get('/admin/kandang', [ScanController::class, 'index'])->name('kandang.index');
    Route::get('/admin/kandang/{id}/edit', [ScanController::class, 'edit']);
    Route::put('/admin/kandang/{id}', [ScanController::class, 'update']);
    Route::delete('/admin/kandang/{id}', [ScanController::class, 'destroy']);
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
