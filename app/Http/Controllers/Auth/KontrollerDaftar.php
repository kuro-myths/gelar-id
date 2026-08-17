<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KontrollerDaftar extends Controller
{
    public function tampilFormDaftar()
    {
        if (Auth::check()) {
            return redirect(Auth::user()->isAdmin() ? '/admin/dasbor' : '/pengguna/dasbor');
        }
        return view('auth.daftar');
    }

    public function daftar(Request $request)
    {
        $validasi = $request->validate([
            'nama'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:pengguna,email',
            'nama_pengguna'         => 'required|string|min:3|max:30|unique:pengguna,nama_pengguna|alpha_dash',
            'password'              => 'required|min:8|confirmed',
            'institusi'             => 'nullable|string|max:255',
            'telepon'               => 'nullable|string|max:20',
        ]);

        $pengguna = Pengguna::create([
            'nama'          => $validasi['nama'],
            'email'         => $validasi['email'],
            'nama_pengguna' => $validasi['nama_pengguna'],
            'password'      => Hash::make($validasi['password']),
            'institusi'     => $validasi['institusi'] ?? null,
            'telepon'       => $validasi['telepon'] ?? null,
            'nim'           => 'KV-' . date('Y') . '-' . str_pad(Pengguna::count() + 1, 4, '0', STR_PAD_LEFT),
            'peran'         => 'pengguna',
            'aktif'         => true,
        ]);

        Auth::login($pengguna);
        return redirect('/pengguna/dasbor')->with('sukses', 'Selamat datang, ' . $pengguna->nama . '!');
    }
}
