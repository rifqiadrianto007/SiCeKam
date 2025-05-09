<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\AdminController;

// Halaman login dan register
Route::get('/', function () {
    return view('login');
})->name('login.page');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/admin/akun', [AdminController::class, 'akun'])->name('admin.akun');
Route::get('/admin/akun/{id}/edit', [AdminController::class, 'edit'])->name('admin.akun.edit');
Route::put('/admin/akun/{id}', [AdminController::class, 'update'])->name('admin.akun.update');
Route::delete('/admin/akun/{id}', [AdminController::class, 'destroy'])->name('admin.akun.destroy');

// Rute setelah login untuk pengguna
Route::middleware(['auth', 'verified', RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/main', function () {
        return view('main');
    })->name('user.dashboard');

    Route::get('/scan', function () {
        return view('scan');
    })->name('scan');

    Route::post('/scan', [ScanController::class, 'store'])->name('scan.post');

    Route::get('/penyakit', function () {
        return view('penyakit');
    })->name('penyakit');
});

// Rute untuk admin
Route::middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin.dashboard');

    Route::get('/ayam', function () {
        return view('ayam');
    })->name('ayam');

    Route::get('/akun', function () {
        return view('akun');
    })->name('akun');
});

// Rute untuk login, register, dan logout
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Logout hanya bisa diakses oleh pengguna yang terautentikasi
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
