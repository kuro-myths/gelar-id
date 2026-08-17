<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\PesertaPertemuan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontrollerPertemuan extends Controller
{
    public function daftar()
    {
        $pengguna = Auth::user();

        // Ambil program_id yang diikuti pengguna
        $programIds = $pengguna->pendaftaran()
            ->whereIn('status', ['aktif', 'selesai'])
            ->pluck('program_id');

        $pertemuan = Pertemuan::with(['program.jenisGelar', 'pembuat'])
            ->whereIn('program_id', $programIds)
            ->whereIn('status', ['terjadwal', 'berlangsung'])
            ->orderBy('dijadwalkan_pada')
            ->paginate(10);

        $pertemuanSelesai = Pertemuan::with('program.jenisGelar')
            ->whereIn('program_id', $programIds)
            ->where('status', 'selesai')
            ->latest('dijadwalkan_pada')
            ->take(5)
            ->get();

        return view('pengguna.pertemuan.daftar', compact('pertemuan', 'pertemuanSelesai'));
    }

    public function tampil(Pertemuan $pertemuan)
    {
        $pengguna = Auth::user();

        // Cek akses — harus terdaftar di program
        $terdaftar = Pendaftaran::where('pengguna_id', $pengguna->id)
            ->where('program_id', $pertemuan->program_id)
            ->whereIn('status', ['aktif', 'selesai'])
            ->exists();

        if (!$terdaftar) {
            return redirect('/pengguna/pertemuan')->with('galat', 'Anda tidak terdaftar di program ini.');
        }

        $pertemuan->load(['program.jenisGelar', 'sesiBelajar', 'pembuat', 'peserta']);
        $sudahGabung = $pertemuan->peserta->where('pengguna_id', $pengguna->id)->first();

        return view('pengguna.pertemuan.tampil', compact('pertemuan', 'sudahGabung'));
    }

    public function gabung(Pertemuan $pertemuan)
    {
        $pengguna = Auth::user();

        if ($pertemuan->status === 'batal') {
            return back()->with('galat', 'Pertemuan ini dibatalkan.');
        }

        // Catat kehadiran
        PesertaPertemuan::updateOrCreate(
            ['pertemuan_id' => $pertemuan->id, 'pengguna_id' => $pengguna->id],
            ['hadir' => true, 'bergabung_pada' => now()]
        );

        // Jika ada tautan eksternal (Zoom/Meet/Teams), redirect ke sana
        if ($pertemuan->tautan_gabung) {
            return redirect()->away($pertemuan->tautan_gabung);
        }

        // Jika internal, redirect ke halaman ruangan
        return redirect('/pengguna/pertemuan/' . $pertemuan->id . '/ruangan');
    }

    public function ruangan(Pertemuan $pertemuan)
    {
        $pengguna = Auth::user();
        $peserta  = PesertaPertemuan::where('pertemuan_id', $pertemuan->id)
            ->with('pengguna')
            ->get();

        $pertemuan->load('program.jenisGelar');
        return view('pengguna.pertemuan.ruangan', compact('pertemuan', 'peserta'));
    }

    public function keluar(Pertemuan $pertemuan)
    {
        $peserta = PesertaPertemuan::where('pertemuan_id', $pertemuan->id)
            ->where('pengguna_id', Auth::id())
            ->first();

        if ($peserta && !$peserta->keluar_pada) {
            $durasi = now()->diffInMinutes($peserta->bergabung_pada ?? now());
            $peserta->update([
                'keluar_pada'        => now(),
                'durasi_hadir_menit' => $durasi,
            ]);
        }

        return redirect('/pengguna/pertemuan')->with('sukses', 'Anda telah keluar dari pertemuan.');
    }
}
