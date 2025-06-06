<?php

namespace App\Http\Controllers;

use App\Models\Scan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            'blok' => 'nullable|string|min:0',
            'jumlah_ayam' => 'nullable|integer|min:0',
            'ayam_sakit'  => 'nullable|integer|min:0',
        ]);

        $scan = Scan::findOrFail($id);
        $scan->blok = $request->blok;
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

    public function showScanForm()
    {
        $bloks = DB::table('scans')->distinct()->pluck('blok');
        return view('user.scan', compact('bloks'));
    }

    public function tambahJumlah(Request $request)
    {
        $validated = $request->validate([
            'blok' => 'required|string',
            'jumlah_ayam' => 'required|integer',
        ]);

        $scan = Scan::firstOrCreate(['blok' => $validated['blok']]);
        $scan->jumlah_ayam = ($scan->jumlah_ayam ?? 0) + $validated['jumlah_ayam'];
        $scan->save();

        return response()->json([
            'success' => true,
            'message' => 'Jumlah ayam berhasil ditambahkan.'
        ]);
    }

    public function simpanJumlah(Request $request)
    {
        $validated = $request->validate([
            'blok' => 'required|string',
            'jumlah_ayam' => 'required|integer',
        ]);

        $scan = Scan::where('blok', $validated['blok'])->first();

        if ($scan) {
            $scan->update([
                'jumlah_ayam' => $validated['jumlah_ayam'],
                'ayam_sakit' => 0
            ]);
        } else {
            Scan::create([
                'blok' => $validated['blok'],
                'jumlah_ayam' => $validated['jumlah_ayam'],
                'ayam_sakit' => 0
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Jumlah ayam berhasil disimpan dan jumlah ayam sakit direset ke 0.'
        ]);
    }

    public function tambahAyamSakit(Request $request)
    {
        $validated = $request->validate([
            'blok' => 'required|string',
            'ayam_sakit' => 'required|integer|min:1',
        ]);

        $scan = Scan::where('blok', $validated['blok'])->first();

        if (!$scan) {
            return response()->json([
                'success' => false,
                'message' => 'Data blok tidak ditemukan.'
            ], 404);
        }

        $scan->ayam_sakit = ($scan->ayam_sakit ?? 0) + $validated['ayam_sakit'];
        $scan->save();

        return response()->json([
            'success' => true,
            'message' => 'Jumlah ayam sakit berhasil ditambahkan.'
        ]);
    }
}
