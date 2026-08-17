<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\JenisGelar;
use App\Models\Program;
use App\Models\Pendaftaran;
use App\Models\Sertifikat;
use App\Models\Pertemuan;
use App\Models\Kuesioner;
use App\Models\Diskon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KontrollerAdmin extends Controller
{
    // ===== DASBOR =====
    public function dasbor()
    {
        $statistik = [
            'pengguna'    => Pengguna::where('peran', 'pengguna')->count(),
            'program'     => Program::count(),
            'pendaftaran' => Pendaftaran::count(),
            'sertifikat'  => Sertifikat::count(),
            'aktif'       => Pendaftaran::where('status', 'aktif')->count(),
            'selesai'     => Pendaftaran::where('status', 'selesai')->count(),
            'pertemuan'   => Pertemuan::whereIn('status', ['terjadwal', 'berlangsung'])->count(),
            'kuesioner'   => Kuesioner::where('aktif', true)->count(),
            'diskon'      => Diskon::aktif()->count(),
        ];

        $pendaftaranTerbaru = Pendaftaran::with('pengguna', 'program.jenisGelar')
            ->latest()->take(10)->get();
        $statistikGelar     = JenisGelar::withCount(['sertifikat', 'program'])->get();
        $pertemuanMendatang = Pertemuan::with('program.jenisGelar')
            ->where('status', 'terjadwal')
            ->where('dijadwalkan_pada', '>=', now())
            ->orderBy('dijadwalkan_pada')
            ->take(5)->get();

        return view('admin.dasbor', compact(
            'statistik', 'pendaftaranTerbaru',
            'statistikGelar', 'pertemuanMendatang'
        ));
    }

    // ===== PENGGUNA =====
    public function pengguna(Request $request)
    {
        $pengguna = Pengguna::when($request->cari, function ($q) use ($request) {
            $q->where('nama', 'like', '%'.$request->cari.'%')
              ->orWhere('email', 'like', '%'.$request->cari.'%');
        })->when($request->peran, fn($q) => $q->where('peran', $request->peran))
          ->latest()->paginate(15);
        return view('admin.pengguna.daftar', compact('pengguna'));
    }

    public function editPengguna(Pengguna $pengguna)
    {
        return view('admin.pengguna.edit', compact('pengguna'));
    }

    public function perbaruiPengguna(Request $request, Pengguna $pengguna)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'peran' => 'required|in:admin,pengguna',
        ]);
        $pengguna->update([
            'nama'  => $request->nama,
            'peran' => $request->peran,
            'aktif' => $request->boolean('aktif'),
        ]);
        return redirect('/admin/pengguna')->with('sukses', 'Pengguna berhasil diperbarui.');
    }

    public function hapusPengguna(Pengguna $pengguna)
    {
        if ($pengguna->id === auth()->id()) {
            return back()->with('galat', 'Tidak bisa menghapus akun sendiri.');
        }
        $pengguna->delete();
        return back()->with('sukses', 'Pengguna berhasil dihapus.');
    }

    // ===== JENIS GELAR =====
    public function jenisGelar()
    {
        $gelar = JenisGelar::withCount('program')->orderBy('urutan')->get();
        return view('admin.gelar.daftar', compact('gelar'));
    }

    public function buatGelar()
    {
        return view('admin.gelar.buat');
    }

    public function simpanGelar(Request $request)
    {
        $data = $request->validate([
            'kode'             => 'required|unique:jenis_gelar,kode',
            'gelar_singkat'    => 'nullable|string|max:50',
            'nama'             => 'required|string|max:255',
            'kategori'         => 'required|in:sarjana,diploma,vokasi',
            'deskripsi'        => 'nullable|string',
            'syarat'           => 'nullable|string',
            'prospek_karir'    => 'nullable|string',
            'durasi_bulan'     => 'required|integer|min:1',
            'sks_dibutuhkan'   => 'required|integer|min:1',
            'jumlah_semester'  => 'required|integer|min:1',
            'warna'            => 'required|string',
        ]);

        // Proses keunggulan dan mata kuliah inti
        if ($request->filled('keunggulan')) {
            $data['keunggulan'] = array_filter(explode("\n", $request->keunggulan));
        }
        if ($request->filled('mata_kuliah_inti')) {
            $data['mata_kuliah_inti'] = array_filter(explode("\n", $request->mata_kuliah_inti));
        }

        JenisGelar::create($data);
        return redirect('/admin/gelar')->with('sukses', 'Jenis gelar berhasil ditambahkan.');
    }

    public function editGelar(JenisGelar $gelar)
    {
        return view('admin.gelar.edit', compact('gelar'));
    }

    public function perbaruiGelar(Request $request, JenisGelar $gelar)
    {
        $data = $request->validate([
            'gelar_singkat'   => 'nullable|string|max:50',
            'nama'            => 'required|string|max:255',
            'kategori'        => 'required|in:sarjana,diploma,vokasi',
            'deskripsi'       => 'nullable|string',
            'syarat'          => 'nullable|string',
            'prospek_karir'   => 'nullable|string',
            'durasi_bulan'    => 'required|integer|min:1',
            'sks_dibutuhkan'  => 'required|integer|min:1',
            'jumlah_semester' => 'required|integer|min:1',
            'warna'           => 'required|string',
        ]);

        if ($request->filled('keunggulan')) {
            $data['keunggulan'] = array_filter(explode("\n", $request->keunggulan));
        }
        if ($request->filled('mata_kuliah_inti')) {
            $data['mata_kuliah_inti'] = array_filter(explode("\n", $request->mata_kuliah_inti));
        }

        $gelar->update(array_merge($data, ['aktif' => $request->boolean('aktif')]));
        return redirect('/admin/gelar')->with('sukses', 'Gelar berhasil diperbarui.');
    }

    // ===== PROGRAM =====
    public function program()
    {
        $program = Program::with('jenisGelar')->withCount('semester')->latest()->paginate(15);
        return view('admin.program.daftar', compact('program'));
    }

    public function buatProgram()
    {
        $gelar = JenisGelar::aktif()->get();
        return view('admin.program.buat', compact('gelar'));
    }

    public function simpanProgram(Request $request)
    {
        $data = $request->validate([
            'jenis_gelar_id' => 'required|exists:jenis_gelar,id',
            'nama'           => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'kurikulum'      => 'nullable|string',
            'tujuan'         => 'nullable|string',
            'harga'          => 'required|numeric|min:0',
            'maks_peserta'   => 'required|integer|min:0',
            'unggulan'       => 'boolean',
        ]);
        $data['slug']    = Str::slug($data['nama']);
        $data['unggulan']= $request->boolean('unggulan');
        Program::create($data);
        return redirect('/admin/program')->with('sukses', 'Program berhasil ditambahkan.');
    }

    public function editProgram(Program $program)
    {
        $gelar = JenisGelar::aktif()->get();
        return view('admin.program.edit', compact('program', 'gelar'));
    }

    public function perbaruiProgram(Request $request, Program $program)
    {
        $data = $request->validate([
            'jenis_gelar_id' => 'required|exists:jenis_gelar,id',
            'nama'           => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'kurikulum'      => 'nullable|string',
            'tujuan'         => 'nullable|string',
            'harga'          => 'required|numeric|min:0',
            'maks_peserta'   => 'required|integer|min:0',
            'unggulan'       => 'boolean',
        ]);
        $program->update(array_merge($data, [
            'aktif'   => $request->boolean('aktif'),
            'unggulan'=> $request->boolean('unggulan'),
        ]));
        return redirect('/admin/program')->with('sukses', 'Program berhasil diperbarui.');
    }

    // ===== PENDAFTARAN =====
    public function pendaftaran(Request $request)
    {
        $pendaftaran = Pendaftaran::with('pengguna', 'program.jenisGelar')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()->paginate(15);
        return view('admin.pendaftaran.daftar', compact('pendaftaran'));
    }

    public function perbaruiPendaftaran(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate(['status' => 'required|in:menunggu,aktif,selesai,batal']);
        $statusLama = $pendaftaran->status;
        $pendaftaran->update(['status' => $request->status]);

        if ($request->status === 'selesai' && $statusLama !== 'selesai' && !$pendaftaran->sertifikat) {
            // Hitung IPK dari kemajuan akademik
            $nilaiRata = $pendaftaran->kemajuanAkademik()
                ->whereNotNull('nilai')->avg('nilai');

            $predikat = 'Memuaskan';
            if ($nilaiRata >= 90) $predikat = 'Dengan Pujian (Cumlaude)';
            elseif ($nilaiRata >= 80) $predikat = 'Sangat Memuaskan';

            Sertifikat::create([
                'pendaftaran_id'  => $pendaftaran->id,
                'pengguna_id'     => $pendaftaran->pengguna_id,
                'jenis_gelar_id'  => $pendaftaran->program->jenis_gelar_id,
                'nama_tercetak'   => $pendaftaran->pengguna->nama,
                'tanggal_terbit'  => now()->toDateString(),
                'ttd_nama'        => 'Rektor Kampus Virtual',
                'ttd_jabatan'     => 'Pimpinan Kampus Virtual Indonesia',
                'ipk'             => $nilaiRata ? round($nilaiRata / 25, 2) : 3.00,
                'predikat'        => $predikat,
            ]);
        }

        return back()->with('sukses', 'Status pendaftaran diperbarui.');
    }

    // ===== SERTIFIKAT =====
    public function sertifikat()
    {
        $sertifikat = Sertifikat::with('pengguna', 'jenisGelar', 'pendaftaran.program')
            ->latest()->paginate(15);
        return view('admin.sertifikat.daftar', compact('sertifikat'));
    }

    public function cetakSertifikat(Sertifikat $sertifikat)
    {
        $sertifikat->load(['pengguna', 'jenisGelar', 'pendaftaran.program']);
        return view('admin.sertifikat.cetak', compact('sertifikat'));
    }

    // ===== KEMAJUAN AKADEMIK =====
    public function kemajuanAkademik(Request $request)
    {
        $pendaftaran = Pendaftaran::with([
            'pengguna', 'program.jenisGelar',
            'kemajuanAkademik',
        ])->where('status', 'aktif')
          ->when($request->program_id, fn($q) => $q->where('program_id', $request->program_id))
          ->paginate(15);

        $program = Program::aktif()->with('jenisGelar')->get();
        return view('admin.kemajuan.daftar', compact('pendaftaran', 'program'));
    }
}
