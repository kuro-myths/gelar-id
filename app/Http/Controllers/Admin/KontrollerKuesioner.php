<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kuesioner;
use App\Models\Pertanyaan;
use App\Models\Program;
use App\Models\SesiBelajar;
use App\Models\ResponsKuesioner;
use Illuminate\Http\Request;

class KontrollerKuesioner extends Controller
{
    public function daftar()
    {
        $kuesioner = Kuesioner::with(['program.jenisGelar', 'sesiBelajar'])
            ->withCount(['pertanyaan', 'respons'])
            ->latest()
            ->paginate(15);
        return view('admin.kuesioner.daftar', compact('kuesioner'));
    }

    public function buat()
    {
        $program = Program::aktif()->with('jenisGelar')->get();
        $sesi    = SesiBelajar::with('semester.program')->get();
        return view('admin.kuesioner.buat', compact('program', 'sesi'));
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'judul'             => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'program_id'        => 'nullable|exists:program,id',
            'sesi_belajar_id'   => 'nullable|exists:sesi_belajar,id',
            'tipe'              => 'required|in:pra_kelas,pasca_kelas,kepuasan,ujian,umum',
            'dibuka_pada'       => 'nullable|date',
            'ditutup_pada'      => 'nullable|date|after_or_equal:dibuka_pada',
            'batas_waktu_menit' => 'required|integer|min:0',
            'wajib'             => 'boolean',
            'acak_soal'         => 'boolean',
        ]);

        $data['wajib']     = $request->boolean('wajib');
        $data['acak_soal'] = $request->boolean('acak_soal');
        $data['aktif']     = true;

        $kuesioner = Kuesioner::create($data);
        return redirect('/admin/kuesioner/' . $kuesioner->id . '/pertanyaan')
            ->with('sukses', 'Kuesioner dibuat! Sekarang tambahkan pertanyaan.');
    }

    public function tampil(Kuesioner $kuesioner)
    {
        $kuesioner->load(['program', 'sesiBelajar', 'pertanyaan']);
        $respons   = ResponsKuesioner::with('pengguna')
            ->where('kuesioner_id', $kuesioner->id)
            ->where('selesai', true)
            ->latest()
            ->paginate(15);
        return view('admin.kuesioner.tampil', compact('kuesioner', 'respons'));
    }

    public function pertanyaan(Kuesioner $kuesioner)
    {
        $kuesioner->load('pertanyaan');
        return view('admin.kuesioner.pertanyaan', compact('kuesioner'));
    }

    public function simpanPertanyaan(Request $request, Kuesioner $kuesioner)
    {
        $data = $request->validate([
            'teks_pertanyaan' => 'required|string',
            'tipe'            => 'required|in:pilihan_ganda,esai,benar_salah,skala,centang',
            'opsi'            => 'nullable|array',
            'opsi.*'          => 'nullable|string|max:255',
            'wajib'           => 'boolean',
            'bobot'           => 'required|integer|min:0|max:100',
        ]);

        $urutan = $kuesioner->pertanyaan()->max('urutan') + 1;

        Pertanyaan::create([
            'kuesioner_id'    => $kuesioner->id,
            'urutan'          => $urutan,
            'teks_pertanyaan' => $data['teks_pertanyaan'],
            'tipe'            => $data['tipe'],
            'opsi'            => !empty($data['opsi']) ? array_filter($data['opsi']) : null,
            'wajib'           => $request->boolean('wajib'),
            'bobot'           => $data['bobot'],
        ]);

        return back()->with('sukses', 'Pertanyaan ditambahkan!');
    }

    public function hapusPertanyaan(Pertanyaan $pertanyaan)
    {
        $kuesionerId = $pertanyaan->kuesioner_id;
        $pertanyaan->delete();
        return redirect('/admin/kuesioner/' . $kuesionerId . '/pertanyaan')
            ->with('sukses', 'Pertanyaan dihapus.');
    }

    public function toggleAktif(Kuesioner $kuesioner)
    {
        $kuesioner->update(['aktif' => !$kuesioner->aktif]);
        return back()->with('sukses', 'Status kuesioner diperbarui.');
    }

    public function hapus(Kuesioner $kuesioner)
    {
        $kuesioner->delete();
        return back()->with('sukses', 'Kuesioner dihapus.');
    }

    public function hasilDetail(ResponsKuesioner $respons)
    {
        $respons->load(['kuesioner.pertanyaan', 'jawaban.pertanyaan', 'pengguna']);
        return view('admin.kuesioner.hasil-detail', compact('respons'));
    }
}
