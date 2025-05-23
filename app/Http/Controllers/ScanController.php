<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Scan;
use Illuminate\Validation\Rule;

class ScanController extends Controller
{
    // Simpan hasil scan
    public function store(Request $request)
    {
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'blok'          => ['required', 'string', Rule::in(['A', 'B', 'C', 'D', 'E'])],
            'scan_type'     => 'required|in:jumlah,penyakit',
            'detected_count'=> 'nullable|integer|min:0',
            'is_sick'       => 'nullable|boolean',
        ]);

        // Simpan gambar ke storage
        $path = $request->file('image')->store('public/scan');
        $publicPath = Storage::url($path);

        // Cari atau buat data scan berdasarkan blok
        $scan = Scan::firstOrNew(['blok' => $request->blok]);

        if ($request->scan_type === 'jumlah') {
            $scan->jumlah_ayam = $request->detected_count;
        } elseif ($request->scan_type === 'penyakit') {
            $scan->ayam_sakit = $request->is_sick ? 1 : 0;
        }

        // Simpan path gambar (jika ingin disimpan)
        $scan->image_path = $publicPath;
        $scan->save();

        return back()
            ->with('success', 'Data blok berhasil disimpan!')
            ->with('image', $publicPath);
    }

    // Menampilkan semua data
    public function index()
    {
        $scans = Scan::all(); // Ambil semua data scan
        return view('admin.kandang', compact('scans'));
    }

    // Ambil data scan untuk edit
    public function edit($id)
    {
        $scan = Scan::findOrFail($id);
        return response()->json($scan); // Untuk ditangani di modal/edit frontend
    }

    // Update data scan
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_ayam' => 'nullable|integer|min:0',
            'ayam_sakit'  => 'nullable|integer|min:0',
        ]);

        $scan = Scan::findOrFail($id);
        $scan->jumlah_ayam = $request->jumlah_ayam;
        $scan->ayam_sakit = $request->ayam_sakit;
        $scan->save();

        return redirect()->back()->with('success', 'Data berhasil diupdate.');
    }

    // Hapus data scan
    public function destroy($id)
    {
        $scan = Scan::findOrFail($id);
        $scan->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
