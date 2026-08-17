<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Pendaftaran;
use App\Models\KemajuanAkademik;
use App\Models\SesiBelajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontrollerDasbor extends Controller
{
    public function index()
    {
        $pengguna    = Auth::user();
        $pendaftaran = $pengguna->pendaftaran()->with('program.jenisGelar')->latest()->take(5)->get();
        $sertifikat  = $pengguna->sertifikat()->with('jenisGelar')->latest()->take(5)->get();

        $statistik = [
            'total'      => $pengguna->pendaftaran()->count(),
            'aktif'      => $pengguna->pendaftaran()->where('status', 'aktif')->count(),
            'selesai'    => $pengguna->pendaftaran()->where('status', 'selesai')->count(),
            'sertifikat' => $pengguna->sertifikat()->count(),
        ];

        return view('pengguna.dasbor', compact('pendaftaran', 'sertifikat', 'statistik'));
    }

    public function daftarKu()
    {
        $pendaftaran = Auth::user()->pendaftaran()
            ->with('program.jenisGelar')
            ->latest()->paginate(10);
        return view('pengguna.daftar-ku', compact('pendaftaran'));
    }

    public function daftar(Program $program)
    {
        $pengguna = Auth::user();

        $sudahDaftar = Pendaftaran::where('pengguna_id', $pengguna->id)
            ->where('program_id', $program->id)
            ->whereIn('status', ['menunggu', 'aktif'])->exists();

        if ($sudahDaftar) {
            return back()->with('galat', 'Anda sudah terdaftar di program ini.');
        }

        if ($program->penuh) {
            return back()->with('galat', 'Maaf, kuota program sudah penuh.');
        }

        $hargaBayar = (float) $program->harga;
        $diskonDigunakan = null;

        // Proses kode diskon jika ada
        if (request('kode_diskon')) {
            $diskon = \App\Models\Diskon::aktif()
                ->where('kode', strtoupper(request('kode_diskon')))
                ->first();

            if ($diskon && $diskon->berlakuUntukProgram($program->id)) {
                $hargaBayar = $diskon->hitungHargaAkhir($hargaBayar);
                $diskonDigunakan = $diskon;
            }
        }

        $pendaftaran = Pendaftaran::create([
            'pengguna_id'    => $pengguna->id,
            'program_id'     => $program->id,
            'status'         => 'aktif',
            'terdaftar_pada' => now(),
            'jumlah_bayar'   => $hargaBayar,
        ]);

        // Catat pemakaian diskon
        if ($diskonDigunakan) {
            \App\Models\PemakaianDiskon::create([
                'diskon_id'      => $diskonDigunakan->id,
                'pengguna_id'    => $pengguna->id,
                'pendaftaran_id' => $pendaftaran->id,
                'nilai_potongan' => (float)$program->harga - $hargaBayar,
            ]);
            $diskonDigunakan->increment('total_digunakan');
        }

        return redirect('/pengguna/daftar-ku')
            ->with('sukses', '🎉 Berhasil mendaftar program ' . $program->nama . '!');
    }

    public function sertifikatku()
    {
        $sertifikat = Auth::user()->sertifikat()
            ->with('jenisGelar', 'pendaftaran.program')
            ->latest()->paginate(10);
        return view('pengguna.sertifikat-ku', compact('sertifikat'));
    }

    public function kemajuan(Pendaftaran $pendaftaran)
    {
        // Pastikan milik pengguna ini
        if ($pendaftaran->pengguna_id !== Auth::id()) abort(403);

        $pendaftaran->load([
            'program.jenisGelar',
            'program.semester.sesiBelajar.pertemuan',
            'program.semester.sesiBelajar.kuesioner',
            'kemajuanAkademik.sesiBelajar',
        ]);

        $persen = $pendaftaran->hitungKemajuan();

        return view('pengguna.kemajuan', compact('pendaftaran', 'persen'));
    }

    public function tandaiSesiSelesai(Request $request, Pendaftaran $pendaftaran, SesiBelajar $sesi)
    {
        if ($pendaftaran->pengguna_id !== Auth::id()) abort(403);

        KemajuanAkademik::updateOrCreate(
            ['pendaftaran_id' => $pendaftaran->id, 'sesi_belajar_id' => $sesi->id],
            ['selesai' => true, 'diselesaikan_pada' => now()]
        );

        // Update persentase kemajuan di pendaftaran
        $persen = $pendaftaran->hitungKemajuan();
        $pendaftaran->update(['kemajuan' => $persen]);

        return back()->with('sukses', '✅ Sesi "' . $sesi->judul . '" ditandai selesai!');
    }

    public function profil()
    {
        return view('pengguna.profil', ['pengguna' => Auth::user()]);
    }

    public function perbaruiProfil(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'telepon'   => 'nullable|string|max:20',
            'institusi' => 'nullable|string|max:255',
            'alamat'    => 'nullable|string|max:500',
        ]);

        Auth::user()->update($request->only('nama', 'telepon', 'institusi', 'alamat'));
        return back()->with('sukses', 'Profil berhasil diperbarui.');
    }
}
