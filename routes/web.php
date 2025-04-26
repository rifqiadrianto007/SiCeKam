<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScanController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/main', function () {
    return view('main');
})->name('main');

Route::get('/scan', function () {
    return view('scan');
})->name('scan');

Route::post('/scan', [ScanController::class, 'store'])->name('scan.post');

Route::get('/penyakit', function () {
    return view('penyakit');
})->name('penyakit');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/ayam', function () {
    return view('ayam');
})->name('ayam');

Route::get('/akun', function () {
    return view('akun');
})->name('akun');
