<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\PersetujuanPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontrollerPersetujuan extends Controller
{
    public function tampil(Pendaftaran $pendaftaran)
    {
        if ($pendaftaran->pengguna_id !== Auth::id()) abort(403);
        if ($pendaftaran->persetujuan_lengkap) {
            return redirect('/pengguna/daftar-ku')->with('sukses', 'Persetujuan sudah lengkap.');
        }
        $pendaftaran->load('program.jenisGelar');
        return view('pengguna.persetujuan', compact('pendaftaran'));
    }

    public function simpan(Request $request, Pendaftaran $pendaftaran)
    {
        if ($pendaftaran->pengguna_id !== Auth::id()) abort(403);

        $request->validate([
            'tipe_wali'          => 'required|in:orang_tua,wali,mandiri',
            'nama_wali'          => 'required_unless:tipe_wali,mandiri|nullable|string|max:255',
            'hubungan_wali'      => 'required_unless:tipe_wali,mandiri|nullable|string|max:100',
            'telepon_wali'       => 'nullable|string|max:20',
            'email_wali'         => 'nullable|email|max:255',
            'pernyataan_mandiri' => 'required_if:tipe_wali,mandiri|nullable|string|min:30',
            'setuju_syarat'      => 'required|accepted',
            'setuju_independen'  => 'required|accepted',
            'setuju_swadaya'     => 'required|accepted',
        ], [
            'setuju_syarat.accepted'     => 'Anda harus menyetujui syarat dan ketentuan.',
            'setuju_independen.accepted' => 'Anda harus memahami status kampus independen.',
            'setuju_swadaya.accepted'    => 'Anda harus menyetujui pernyataan swadaya karir.',
            'nama_wali.required_unless'  => 'Nama wali/orang tua wajib diisi.',
            'pernyataan_mandiri.required_if' => 'Pernyataan mandiri wajib diisi minimal 30 karakter.',
        ]);

        // Buat tanda tangan digital (hash)
        $tandaTangan = hash('sha256',
            $pendaftaran->id . Auth::id() . $request->tipe_wali . now()->timestamp
        );

        PersetujuanPendaftaran::updateOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            [
                'tipe_wali'           => $request->tipe_wali,
                'nama_wali'           => $request->nama_wali,
                'hubungan_wali'       => $request->hubungan_wali,
                'telepon_wali'        => $request->telepon_wali,
                'email_wali'          => $request->email_wali,
                'pernyataan_mandiri'  => $request->pernyataan_mandiri,
                'setuju_syarat'       => true,
                'setuju_independen'   => true,
                'setuju_swadaya'      => true,
                'tanda_tangan_digital'=> $tandaTangan,
                'disetujui_pada'      => now(),
                'alamat_ip'           => $request->ip(),
            ]
        );

        $pendaftaran->update(['persetujuan_lengkap' => true]);

        return redirect('/pengguna/daftar-ku')
            ->with('sukses', '✅ Persetujuan berhasil disimpan! Pendaftaran kamu sekarang aktif.');
    }
}
