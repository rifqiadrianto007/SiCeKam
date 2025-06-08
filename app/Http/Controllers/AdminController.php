<?php

namespace App\Http\Controllers;

use App\Models\Scan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function akun()
    {
        $users = User::select('id', 'name', 'email')
                    ->where('role', '!=', 'admin')
                    ->get();

        return view('admin.akun', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit-akun', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email']));

        return response()->json(['message' => 'Berhasil diupdate.']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Berhasil dihapus.']);
    }

    public function storeBlok(Request $request)
    {
        $request->validate([
            'blok' => 'required|string|max:10',
        ]);

        $existingBlok = Scan::where('blok', $request->blok)->first();

        if ($existingBlok) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Blok kandang "'.$request->blok.'" sudah ada!');
        }

        Scan::create([
            'blok' => $request->blok,
        ]);

        return redirect()->back()
            ->with('success', 'Blok kandang "'.$request->blok.'" berhasil ditambahkan.');
    }

public function dashboard()
    {
        $totalBlok = DB::table('scans')->distinct('blok')->count('blok');
        $totalAyam = DB::table('scans')->sum('jumlah_ayam');
        $ayamSakit = DB::table('scans')->sum('ayam_sakit');

        $ayamSehat = $totalAyam - $ayamSakit;
        $persentaseSehat = $totalAyam > 0 ? round(($ayamSehat / $totalAyam) * 100, 1) : 0;

        $distribusi = DB::table('scans')
            ->select('blok', DB::raw('SUM(jumlah_ayam) as jumlah_ayam'))
            ->groupBy('blok')
            ->orderBy('blok')
            ->get();

        return view('admin.admin', compact('totalBlok', 'totalAyam', 'ayamSakit', 'persentaseSehat', 'distribusi'));
    }
}
