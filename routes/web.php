<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

// Route::post('/logout', function() {
//     Auth::logout();
//     return redirect()->route('login');
// })->name('logout');

Route::get('/main', function () {
    return view('main');
})->name('main');

Route::get('/scan', function () {
    return view('scan');
})->name('scan');

Route::get('/penyakit', function () {
    return view('penyakit');
})->name('penyakit');
