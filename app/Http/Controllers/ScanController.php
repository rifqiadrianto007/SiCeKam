<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('image')->store('public/scan');

        $publicPath = Storage::url($path);

        return back()->with('success', 'Gambar berhasil diunggah!')->with('image', $publicPath);
    }
}

