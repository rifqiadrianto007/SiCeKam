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
Route::middleware(['auth', 'verified', RoleMiddleware::class . ':user'])->group(function () {

    Route::get('/scan', function () {
        return view('user.scan');
    })->name('scan');

    Route::post('/scan', [ScanController::class, 'store'])->name('scan.post');

    Route::get('/penyakit', function () {
        return view('user.penyakit');
    })->name('penyakit');
});

// Rute untuk admin
Route::middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])->group(function () {

    Route::get('/admin/akun', [AdminController::class, 'akun'])->name('admin.akun');
    Route::put('/admin/akun/{id}', [AdminController::class, 'update'])->name('akun.update');
    Route::delete('/admin/akun/{id}', [AdminController::class, 'destroy'])->name('akun.destroy');

    Route::get('/admin', function () {
        return view('admin.admin');
    })->name('admin.dashboard');

    Route::get('/kandang', function () {
        return view('admin.kandang');
    })->name('kandang');
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
