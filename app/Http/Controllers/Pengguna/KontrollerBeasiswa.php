<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\PendaftarBeasiswa;
use App\Models\Program;
use Illuminate\Http\Request;

class KontrollerBeasiswa extends Controller
{
    // Daftar semua beasiswa aktif + status pendaftaran pengguna
    public function index()
    {
        $beasiswa = Beasiswa::aktif()->withCount('pendaftar')->get();

        $pendaftaranSaya = PendaftarBeasiswa::where('pengguna_id', auth()->id())
            ->pluck('status', 'beasiswa_id');

        // Pencapaian yang sudah diraih pengguna (untuk cek syarat)
        $pencapaianDiraih = auth()->user()->pencapaianDiraih()
            ->pluck('pencapaian_id')
            ->toArray();

        return view('pengguna.beasiswa.daftar', compact('beasiswa', 'pendaftaranSaya', 'pencapaianDiraih'));
    }

    // Detail satu beasiswa + form pendaftaran
    public function tampil(Beasiswa $beasiswa)
    {
        if (!$beasiswa->aktif) {
            return redirect('/beasiswa')->with('galat', 'Beasiswa tidak tersedia.');
        }

        $program = Program::with('jenisGelar')->aktif()->get();

        $sudahDaftar = PendaftarBeasiswa::where('pengguna_id', auth()->id())
            ->where('beasiswa_id', $beasiswa->id)->first();

        $pencapaianDiraih = auth()->user()->pencapaianDiraih()
            ->pluck('pencapaian_id')->toArray();

        $pencapaianWajib = $beasiswa->pencapaianWajib();

        $memenuhiSyaratPencapaian = empty($beasiswa->pencapaian_wajib) ||
            count(array_intersect($beasiswa->pencapaian_wajib ?? [], $pencapaianDiraih))
                === count($beasiswa->pencapaian_wajib ?? []);

        return view('pengguna.beasiswa.tampil', compact(
            'beasiswa', 'program', 'sudahDaftar',
            'pencapaianDiraih', 'pencapaianWajib', 'memenuhiSyaratPencapaian'
        ));
    }

    // Proses pendaftaran beasiswa
    public function daftar(Request $request, Beasiswa $beasiswa)
    {
        if (!$beasiswa->masih_buka) {
            return back()->with('galat', 'Pendaftaran beasiswa sudah ditutup.');
        }

        if ($beasiswa->kuota > 0 && $beasiswa->sisa_kuota <= 0) {
            return back()->with('galat', 'Kuota beasiswa sudah penuh.');
        }

        $sudahDaftar = PendaftarBeasiswa::where('pengguna_id', auth()->id())
            ->where('beasiswa_id', $beasiswa->id)->exists();

        if ($sudahDaftar) {
            return back()->with('galat', 'Kamu sudah pernah mendaftar beasiswa ini.');
        }

        // Cek pencapaian wajib
        if (!empty($beasiswa->pencapaian_wajib)) {
            $pencapaianDiraih = auth()->user()->pencapaianDiraih()
                ->pluck('pencapaian_id')->toArray();
            $belumRaih = array_diff($beasiswa->pencapaian_wajib, $pencapaianDiraih);
            if (!empty($belumRaih)) {
                return back()->with('galat', 'Kamu belum memenuhi semua pencapaian yang dipersyaratkan.');
            }
        }

        $request->validate([
            'program_id'       => 'nullable|exists:program,id',
            'surat_motivasi'   => 'required|string|min:100|max:3000',
            'dokumen_prestasi' => 'nullable|string|max:2000',
        ]);

        PendaftarBeasiswa::create([
            'pengguna_id'    => auth()->id(),
            'beasiswa_id'    => $beasiswa->id,
            'program_id'     => $request->program_id,
            'surat_motivasi' => $request->surat_motivasi,
            'dokumen'        => [
                'prestasi'      => $request->dokumen_prestasi,
                'game_bukti'    => $request->game_bukti,
                'keterangan'    => $request->keterangan_tambahan,
            ],
            'status' => 'menunggu',
        ]);

        return redirect('/beasiswa')->with('sukses',
            '🎉 Pendaftaran beasiswa berhasil dikirim! Admin akan mereview segera.');
    }

    // Riwayat pendaftaran beasiswa pengguna
    public function riwayat()
    {
        $pendaftaran = PendaftarBeasiswa::where('pengguna_id', auth()->id())
            ->with('beasiswa', 'program.jenisGelar')
            ->latest()->get();

        return view('pengguna.beasiswa.riwayat', compact('pendaftaran'));
    }
}
