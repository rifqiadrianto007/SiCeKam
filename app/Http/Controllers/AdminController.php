<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function akun()
    {
        $users = User::select('id', 'name', 'email')->get();
        return view('akun', compact('users'));
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
}
