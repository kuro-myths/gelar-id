<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Pencapaian;
use App\Models\PencapaianPengguna;
use Illuminate\Http\Request;

class KontrollerPencapaian extends Controller
{
    // Halaman daftar pencapaian + status pengguna
    public function index()
    {
        $semuaPencapaian = Pencapaian::aktif()->get();
        $pencapaianSaya  = PencapaianPengguna::where('pengguna_id', auth()->id())
            ->with('pencapaian')
            ->get()
            ->keyBy('pencapaian_id');

        return view('pengguna.pencapaian-ku', compact('semuaPencapaian', 'pencapaianSaya'));
    }

    // Ajukan klaim pencapaian (manual/upload)
    public function ajukan(Request $request, Pencapaian $pencapaian)
    {
        if (!in_array($pencapaian->tipe_syarat, ['manual', 'upload'])) {
            return back()->with('galat', 'Pencapaian ini tidak bisa diklaim secara manual.');
        }

        $sudahAda = PencapaianPengguna::where('pengguna_id', auth()->id())
            ->where('pencapaian_id', $pencapaian->id)
            ->exists();

        if ($sudahAda) {
            return back()->with('galat', 'Kamu sudah pernah mengajukan pencapaian ini.');
        }

        $request->validate([
            'catatan_pengguna' => 'nullable|string|max:1000',
            'bukti'            => 'nullable|string|max:2000',
        ]);

        PencapaianPengguna::create([
            'pengguna_id'      => auth()->id(),
            'pencapaian_id'    => $pencapaian->id,
            'status'           => 'menunggu',
            'catatan_pengguna' => $request->catatan_pengguna,
            'bukti'            => $request->bukti,
        ]);

        return back()->with('sukses', '✅ Klaim pencapaian berhasil diajukan! Admin akan memverifikasi segera.');
    }
}
