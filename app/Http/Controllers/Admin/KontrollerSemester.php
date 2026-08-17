<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\SesiBelajar;
use App\Models\Program;
use Illuminate\Http\Request;

class KontrollerSemester extends Controller
{
    public function daftar(Request $request)
    {
        $semester = Semester::with(['program.jenisGelar'])
            ->withCount('sesiBelajar')
            ->when($request->program_id, fn($q) => $q->where('program_id', $request->program_id))
            ->orderBy('program_id')->orderBy('nomor')
            ->paginate(20);

        $program = Program::aktif()->with('jenisGelar')->get();
        return view('admin.semester.daftar', compact('semester', 'program'));
    }

    public function buat()
    {
        $program = Program::aktif()->with('jenisGelar')->get();
        return view('admin.semester.buat', compact('program'));
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'program_id'      => 'required|exists:program,id',
            'nomor'           => 'required|integer|min:1',
            'nama'            => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'jumlah_sks'      => 'required|integer|min:0',
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        Semester::create(array_merge($data, ['aktif' => true]));
        return redirect('/admin/semester')->with('sukses', 'Semester berhasil ditambahkan.');
    }

    public function tampil(Semester $semester)
    {
        $semester->load(['program.jenisGelar', 'sesiBelajar.pertemuan', 'sesiBelajar.kuesioner']);
        return view('admin.semester.tampil', compact('semester'));
    }

    public function edit(Semester $semester)
    {
        $program = Program::aktif()->with('jenisGelar')->get();
        return view('admin.semester.edit', compact('semester', 'program'));
    }

    public function perbarui(Request $request, Semester $semester)
    {
        $data = $request->validate([
            'nama'            => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'jumlah_sks'      => 'required|integer|min:0',
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'aktif'           => 'boolean',
        ]);
        $semester->update(array_merge($data, ['aktif' => $request->boolean('aktif')]));
        return redirect('/admin/semester')->with('sukses', 'Semester diperbarui.');
    }

    public function hapus(Semester $semester)
    {
        $semester->delete();
        return back()->with('sukses', 'Semester dihapus.');
    }

    // ===== SESI BELAJAR =====
    public function buatSesi(Semester $semester)
    {
        return view('admin.semester.buat-sesi', compact('semester'));
    }

    public function simpanSesi(Request $request, Semester $semester)
    {
        $data = $request->validate([
            'pertemuan_ke' => 'required|integer|min:1',
            'judul'        => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'materi'       => 'nullable|string',
            'mulai_pada'   => 'required|date',
            'selesai_pada' => 'required|date|after:mulai_pada',
            'durasi_menit' => 'required|integer|min:15',
            'tipe'         => 'required|in:online,rekaman,mandiri',
        ]);

        SesiBelajar::create(array_merge($data, [
            'semester_id' => $semester->id,
            'aktif'       => true,
        ]));

        return redirect('/admin/semester/' . $semester->id)
            ->with('sukses', 'Sesi belajar ditambahkan!');
    }

    public function hapusSesi(SesiBelajar $sesi)
    {
        $semesterId = $sesi->semester_id;
        $sesi->delete();
        return redirect('/admin/semester/' . $semesterId)
            ->with('sukses', 'Sesi dihapus.');
    }
}
