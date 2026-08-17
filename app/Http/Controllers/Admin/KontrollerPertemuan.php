<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\Program;
use App\Models\SesiBelajar;
use App\Models\PesertaPertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontrollerPertemuan extends Controller
{
    public function daftar(Request $request)
    {
        $pertemuan = Pertemuan::with(['program.jenisGelar', 'pembuat', 'peserta'])
            ->when($request->program_id, fn($q) => $q->where('program_id', $request->program_id))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest('dijadwalkan_pada')
            ->paginate(15);

        $program = Program::aktif()->with('jenisGelar')->get();
        return view('admin.pertemuan.daftar', compact('pertemuan', 'program'));
    }

    public function buat()
    {
        $program    = Program::aktif()->with('jenisGelar')->get();
        $sesiDaftar = SesiBelajar::with('semester.program')->get();
        return view('admin.pertemuan.buat', compact('program', 'sesiDaftar'));
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'program_id'       => 'required|exists:program,id',
            'sesi_belajar_id'  => 'nullable|exists:sesi_belajar,id',
            'judul'            => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'platform'         => 'required|in:zoom,meet,teams,internal',
            'tautan_gabung'    => 'nullable|url',
            'kata_sandi'       => 'nullable|string|max:50',
            'dijadwalkan_pada' => 'required|date',
            'durasi_menit'     => 'required|integer|min:15|max:480',
            'maks_peserta'     => 'required|integer|min:1',
            'rekam_otomatis'   => 'boolean',
            'catatan'          => 'nullable|string',
        ]);

        $data['dibuat_oleh']   = Auth::id();
        $data['rekam_otomatis']= $request->boolean('rekam_otomatis');

        Pertemuan::create($data);
        return redirect('/admin/pertemuan')->with('sukses', 'Pertemuan berhasil dijadwalkan!');
    }

    public function tampil(Pertemuan $pertemuan)
    {
        $pertemuan->load(['program.jenisGelar', 'sesiBelajar.semester', 'pembuat', 'peserta.pengguna']);
        return view('admin.pertemuan.tampil', compact('pertemuan'));
    }

    public function edit(Pertemuan $pertemuan)
    {
        $program    = Program::aktif()->with('jenisGelar')->get();
        $sesiDaftar = SesiBelajar::with('semester.program')->get();
        return view('admin.pertemuan.edit', compact('pertemuan', 'program', 'sesiDaftar'));
    }

    public function perbarui(Request $request, Pertemuan $pertemuan)
    {
        $data = $request->validate([
            'judul'            => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'platform'         => 'required|in:zoom,meet,teams,internal',
            'tautan_gabung'    => 'nullable|url',
            'kata_sandi'       => 'nullable|string|max:50',
            'dijadwalkan_pada' => 'required|date',
            'durasi_menit'     => 'required|integer|min:15|max:480',
            'maks_peserta'     => 'required|integer|min:1',
            'status'           => 'required|in:terjadwal,berlangsung,selesai,batal',
            'tautan_rekaman'   => 'nullable|url',
            'catatan'          => 'nullable|string',
        ]);

        $pertemuan->update($data);
        return redirect('/admin/pertemuan')->with('sukses', 'Pertemuan berhasil diperbarui.');
    }

    public function mulai(Pertemuan $pertemuan)
    {
        $pertemuan->update(['status' => 'berlangsung']);
        return back()->with('sukses', '🔴 Pertemuan dimulai!');
    }

    public function selesai(Pertemuan $pertemuan)
    {
        $pertemuan->update(['status' => 'selesai']);
        return back()->with('sukses', '✅ Pertemuan selesai.');
    }

    public function hapus(Pertemuan $pertemuan)
    {
        $pertemuan->delete();
        return back()->with('sukses', 'Pertemuan dihapus.');
    }

    public function daftarPeserta(Pertemuan $pertemuan)
    {
        $pertemuan->load(['peserta.pengguna', 'program']);
        return view('admin.pertemuan.peserta', compact('pertemuan'));
    }

    public function tandaiHadir(Request $request, Pertemuan $pertemuan)
    {
        $request->validate(['pengguna_id' => 'required|exists:pengguna,id']);

        PesertaPertemuan::updateOrCreate(
            ['pertemuan_id' => $pertemuan->id, 'pengguna_id' => $request->pengguna_id],
            ['hadir' => true, 'bergabung_pada' => now()]
        );

        return back()->with('sukses', 'Kehadiran dicatat.');
    }
}
